<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;

use App\Models\NormalUser\Question;
use App\Models\NormalUser\QuestionTag;
use App\Models\NormalUser\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    private static $question;

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch questions matching the query in title, description, or tag name
        $questions = Question::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhereHas('tags', function ($tagQuery) use ($query) {
                $tagQuery->where('tags', 'like', "%{$query}%");
            })
            ->with('tags') // Include related tags
            ->get();

        return view('normal-user.question.index', compact('questions', 'query'));
    }

    public function index()
    {
        return $this->filter('trending'); // Default filter to trending
    }

    public function filter($type)
    {
        // Fetch the top 5 questions based on hit count for the sidebar
        $popularQuestions = Question::orderBy('hit_count', 'desc')->take(5)->get();

        // Filter questions based on the filter type
        if ($type === 'trending') {
            $questions = Question::orderBy('hit_count', 'desc')->paginate(10); // Add pagination
        } elseif ($type === 'monthly') {
            $questions = Question::where('created_at', '>=', Carbon::now()->subMonth())
                ->orderBy('created_at', 'desc')
                ->paginate(10); // Add pagination
        } else {
            $questions = Question::orderBy('created_at', 'desc')->paginate(10); // Default filter
        }

        return view('normal-user.question.index', compact('questions', 'type', 'popularQuestions'));
    }




    public function vote(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        // Get the authenticated user's ID
        $userId = auth()->id(); // Default guard
        // OR if using a specific guard:
        // $userId = Auth::guard('user')->id();

        if (!$userId) {
            Log::warning('No authenticated user found when voting', ['question_id' => $id]);
            return redirect()->back()->withErrors(['message' => 'You need to be logged in to vote.']);
        }

        $question->voteByUser($userId, $request->vote);
        Log::info('Vote recorded', ['user_id' => $userId, 'question_id' => $id, 'vote' => $request->vote]);

        return redirect()->back();
    }


    public function store(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string', // Make tags optional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Make image optional
        ], [
            'title.required' => 'The title is mandatory.',
            'description.required' => 'The description cannot be empty.',
            'image.image' => 'The uploaded file must be an image.',
        ]);

        // Create the new question if validation passes
        self::$question = Question::newQuestion($request);

        // Process and associate the tags using the Tag model if tags are provided
        if (!empty($request->tags)) {
            $tagNames = explode(',', $request->tags);
            QuestionTag::newQuestionTags(self::$question->id, $tagNames);
        }

        return redirect()->route('normal-user.question.index')->with('message', 'Question created successfully!');
    }



    public function detail($id)
    {
        // Fetch the current question
        $question = Question::findOrFail($id);
        $question->increment('hit_count'); // Increment the hit count

        // Get tags of the current question
        $tagIds = $question->tags()->pluck('tags.id');

        // Fetch related questions
        $relatedQuestions = Question::where(function ($query) use ($question, $tagIds) {
            $query->where('title', 'like', '%' . $question->title . '%') // Similarity in title
            ->orWhere('description', 'like', '%' . $question->description . '%') // Similarity in description
            ->orWhereHas('tags', function ($tagQuery) use ($tagIds) {
                $tagQuery->whereIn('tags.id', $tagIds); // Matching tags
            });
        })
            ->where('id', '!=', $id) // Exclude the current question
            ->inRandomOrder() // Randomize the results
            ->limit(5) // Limit the number of related questions
            ->get();

        // Pass data to the view
        return view('normal-user.question.detail', compact('question', 'relatedQuestions'));
    }


    public function edit($id)
    {
        $question = Question::where('id', $id)->with('tags')->firstOrFail();
        // Sanitize the description
        $description = $question->description;
        // Remove empty <p> tags
        $description = preg_replace('/<p>\s*<\/p>/', '', $description);

        return view('normal-user.question.detail',compact('question', 'description'));
    }


    public function update(Request $request, $id)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the question details
        $question = Question::updateQuestion($request, $id);

        // Handle tags input
        $newTagNames = array_filter(
            explode(',', $request->input('tags', '')),
            fn($tag) => trim($tag) !== '' // Filter out blank tags
        );

        $newTagIds = Tag::newTag($newTagNames);

        // Get currently attached tags
        $currentTagIds = $question->tags()->pluck('tag_id')->toArray();

        // Tags to remove
        $tagsToRemove = array_diff($currentTagIds, $newTagIds);

        // Tags to add
        $tagsToAdd = array_diff($newTagIds, $currentTagIds);

        // Detach removed tags
        if (!empty($tagsToRemove)) {
            $question->tags()->detach($tagsToRemove);
        }

        // Attach new tags
        if (!empty($tagsToAdd)) {
            $question->tags()->attach($tagsToAdd);
        }

//        return redirect()->route('normal-user.question.index')->with('message', 'Question updated successfully!');
        return redirect()->back()->with('message', 'Question updated successfully!');
    }




    public function delete($id)
    {
        Question::deleteQuestion($id);

        return redirect()->route('normal-user.question.index')->with('message', 'Question info deleted successfully');
    }

}
