<?php

namespace App\Http\Controllers\NormalUser\ResourceSpace;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\ResourceSpace\ResourceSpace;
use App\Models\NormalUser\ResourceSpace\ResourceSpaceBlog;
use App\Models\NormalUser\ResourceSpace\ResourceSpaceJoiningRequest;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePost;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePostComment;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePostVote;
use App\Models\NormalUser\ResourceSpace\ResourceSpaceQuestion;
use App\Models\NormalUser\ResourceSpace\ResourceSpaceUser;
use App\Models\User;
use App\Notifications\ResourceSpaceJoinRequestNotification;
use App\Notifications\ResourceSpaceRequestResponseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ResourceSpaceController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the filter type from the request, default to 'public' (type = 1)
        $filterType = $request->query('type', 1); // 1 = public, 2 = private, 3 = premium
        $searchQuery = $request->query('query'); // Search query

        // Fetch resource spaces based on the filter type and search query
        $resourceSpaces = ResourceSpace::where('type', $filterType)
            ->when($searchQuery, function ($query, $searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('posts', function ($query) use ($searchQuery) {
                        $query->where('title', 'like', '%' . $searchQuery . '%');
                    });
            })
            ->get()
            ->map(function ($resourceSpace) {
                $resourceSpace->postCount = ResourceSpacePost::where('resource_space_id', $resourceSpace->id)->count();
                $resourceSpace->memberCount = DB::table('resource_space_users')->where('resource_space_id', $resourceSpace->id)->count();
                return $resourceSpace;
            });

        return view('normal-user.resource-space.index', compact('resourceSpaces', 'filterType', 'searchQuery'));
    }



    public function detail($id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id);

        $isMember = false; // Variable to check if the user is a member

        // Engagement metrics
        $postCount = ResourceSpacePost::where('resource_space_id', $id)->count();
        $blogCount = ResourceSpaceBlog::where('resource_space_id', $id)->count();
        $memberCount = DB::table('resource_space_users')->where('resource_space_id', $id)->count();

        $totalUpvotes = ResourceSpacePostVote::whereIn('resource_space_post_id', function ($query) use ($id) {
            $query->select('id')->from('resource_space_posts')->where('resource_space_id', $id);
        })->where('vote_type', 'upvote')->count();

        $totalDownvotes = ResourceSpacePostVote::whereIn('resource_space_post_id', function ($query) use ($id) {
            $query->select('id')->from('resource_space_posts')->where('resource_space_id', $id);
        })->where('vote_type', 'downvote')->count();

        $totalComments = ResourceSpacePostComment::whereIn('resource_space_post_id', function ($query) use ($id) {
            $query->select('id')->from('resource_space_posts')->where('resource_space_id', $id);
        })->count();

        $totalEngagement = $postCount + $memberCount + $totalUpvotes + $totalDownvotes + $totalComments;

        // Fetch resource space posts and blogs
        $posts = ResourceSpacePost::where('resource_space_id', $id)
            ->with(['comments' => function ($query) {
                $query->whereNull('parent_id')->with('replies');
            }])
            ->latest()
            ->get();

        $blogs = ResourceSpaceBlog::where('resource_space_id', $id)
            ->latest()
            ->get();

        $comments = $posts->flatMap(function ($post) {
            return $post->comments;
        });

        // Check membership and handle view rendering
        if ($resourceSpace->type == 1) {
            $isMember = DB::table('resource_space_users')
                ->where('resource_space_id', $resourceSpace->id)
                ->where('user_id', auth()->id())
                ->exists();
            return view('normal-user.resource-space.detail', compact('resourceSpace', 'isMember', 'posts', 'blogs', 'comments', 'postCount', 'totalEngagement'));
        }

        if ($resourceSpace->user_id == auth()->id()) {
            $isMember = true;
            return view('normal-user.resource-space.detail', compact('resourceSpace', 'isMember', 'posts', 'blogs', 'comments', 'postCount', 'totalEngagement'));
        }

        if ($resourceSpace->type == 2) {
            $joinRequest = ResourceSpaceJoiningRequest::where('user_id', auth()->id())
                ->where('resource_space_id', $resourceSpace->id)
                ->first();

            if (!$joinRequest || $joinRequest->status === 'pending') {
                return redirect()->route('normal-user.resource-space.privateJoinForm', ['id' => $id]);
            }

            if ($joinRequest->status === 'accepted') {
                $isMember = true;
                return view('normal-user.resource-space.detail', compact('resourceSpace', 'isMember', 'posts', 'blogs', 'comments', 'postCount', 'totalEngagement'));
            }

            return redirect()->route('normal-user.resource-space.index')
                ->with('error', 'Your request to join this space was denied.');
        }

        if ($resourceSpace->type == 3) {
            // Premium logic placeholder (e.g., check payment status)
        }

        abort(403, 'Access denied.');
    }


    public function editResourceSpacePost($id)
    {
        // This method is no longer needed as we're directly including the form in the detail page.
        $post = ResourceSpacePost::findOrFail($id);
        return back();
    }


    public function toggleMembership($id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id);

        $userId = auth()->id();

        // Check if the user is already a member
        $isMember = DB::table('resource_space_users')
            ->where('resource_space_id', $resourceSpace->id)
            ->where('user_id', $userId)
            ->exists();

        if ($isMember) {
            // Remove the user from the group
            DB::table('resource_space_users')
                ->where('resource_space_id', $resourceSpace->id)
                ->where('user_id', $userId)
                ->delete();

            // Additional logic for private resource spaces
            if ($resourceSpace->type == 2) {
                // Delete the accepted joining request
                DB::table('resource_space_joining_requests')
                    ->where('resource_space_id', $resourceSpace->id)
                    ->where('user_id', $userId)
                    ->where('status', 'accepted')
                    ->delete();
            }

            return redirect()->route('normal-user.resource-space.index', $id)
                ->with('success', 'You have successfully left the group.');
        } else {
            // Add the user to the group
            DB::table('resource_space_users')->insert([
                'resource_space_id' => $resourceSpace->id,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('normal-user.resource-space.detail', $id)
                ->with('message', 'You have successfully joined the group.');
        }
    }




    public function privateJoinForm($id)
    {
        // Fetch the resource space by ID
        $resourceSpace = ResourceSpace::findOrFail($id);

        // Load questions created by the admin for this resource space
        $questions = $resourceSpace->questions; // Assuming a relationship exists

        return view('normal-user.resource-space.privateJoinForm', compact('resourceSpace', 'questions'));
    }



    public function saveJoinRequest(Request $request, $id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id);

        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string|max:255',
        ]);

        $existingRequest = ResourceSpaceJoiningRequest::where('user_id', auth()->id())
            ->where('resource_space_id', $resourceSpace->id)
            ->first();

        if ($existingRequest) {
            return redirect()->route('normal-user.resource-space.index')
                ->with('error', 'You have already sent a request.');
        }

        $creatorId = $resourceSpace->user_id;

        $joiningRequest = ResourceSpaceJoiningRequest::create([
            'user_id' => auth()->id(),
            'resource_space_id' => $resourceSpace->id,
            'resource_space_creator_id' => $creatorId,
            'answers' => json_encode($validated['answers']),
            'status' => 'pending',
        ]);

        // Notify the creator of the resource space, NOT the requester
        $creator = User::findOrFail($creatorId);
        $creator->notify(new ResourceSpaceJoinRequestNotification($joiningRequest, 'pending'));

        return redirect()->route('normal-user.resource-space.index')
            ->with('message', 'Request sent successfully.');
    }


    public function handleJoinRequest(Request $request, $requestId)
    {
        // Find the specific join request
        $joinRequest = ResourceSpaceJoiningRequest::findOrFail($requestId);

        // Verify only the resource space creator can handle the request
        if (auth()->id() !== $joinRequest->resource_space_creator_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Validate the action (accept or deny)
        $validated = $request->validate([
            'action' => 'required|in:accept,deny',
        ]);

        // Map the action to the correct value
        $action = ($validated['action'] === 'accept') ? 'accepted' : 'denied';

        // Update the join request status
        $joinRequest->update(['status' => $action]);

        // If the request is accepted, add the user to the resource space
        if ($action === 'accepted') {
            ResourceSpaceUser::create([
                'user_id' => $joinRequest->user_id,
                'resource_space_id' => $joinRequest->resource_space_id,
            ]);
        }

        // Notify the requester of the acceptance
        // The creator should not be notified of their own action; notify the requester.
        if (auth()->id() !== $joinRequest->user_id) {
            // Notify the requester of the acceptance or denial
            $joinRequest->user->notify(new ResourceSpaceRequestResponseNotification($action, $joinRequest->resourceSpace->name, $joinRequest->resource_space_creator_id));
        }

        return redirect()->back()->with('message', 'Request handled successfully.');
    }


    public function showResponses($id)
    {
        // Find the resource space
        $resourceSpace = ResourceSpace::findOrFail($id);

        // Check if the authenticated user is a member
        $isMember = ResourceSpaceUser::where('resource_space_id', $id)
            ->where('user_id', auth()->id())
            ->exists();

        if (!$isMember) {
            return redirect()->route('normal-user.resource-space.index')
                ->with('error', 'You are not authorized to view this resource space.');
        }

        // Fetch questions
        $questions = ResourceSpaceQuestion::where('resource_space_id', $id)->get();

        // Fetch join requests with user relationship
        $joinRequests = ResourceSpaceJoiningRequest::where('resource_space_id', $id)
            ->with('user')
            ->get();

        // Group responses by user
        $userResponses = collect();

        foreach ($joinRequests as $joinRequest) {
            $answers = json_decode($joinRequest->answers, true) ?? [];
            $responseData = [
                'user' => $joinRequest->user,
                'answers' => []
            ];

            foreach ($questions as $question) {
                $answer = $answers[$question->id] ?? $answers[(string)$question->id] ?? null;
                if ($answer) {
                    $responseData['answers'][] = [
                        'question' => $question->question,
                        'answer' => $answer
                    ];
                }
            }

            if (!empty($responseData['answers'])) {
                $userResponses->push($responseData);
            }
        }

        // Reverse the user responses to show the latest at the top
        $userResponses = $userResponses->reverse();

        return view('normal-user.resource-space.questionResponses',
            compact('resourceSpace', 'questions', 'userResponses'));
    }





    public function storeResourceQuestion($id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id); // Fetch the resource space by ID
        return view('normal-user.resource-space.resourceQuestion', compact('resourceSpace'));
    }


    public function saveQuestions(Request $request, $id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id);

        // Validate request
        $validated = $request->validate([
            'questions' => 'array|max:7',
            'questions.*' => 'nullable|string|max:255',
        ]);

        // Save questions
        foreach ($validated['questions'] as $question) {
            if ($question) {
                ResourceSpaceQuestion::create([
                    'resource_space_id' => $resourceSpace->id,
                    'question' => $question,
                ]);
            }
        }

        return redirect()->route('normal-user.resource-space.detail', $id)
            ->with('message', 'Questions saved successfully.');
    }


    public function editResourceQuestion($id)
    {
        // Fetch the resource space and its related questions
        $resourceSpace = ResourceSpace::with('questions')->findOrFail($id);
        return view('normal-user.resource-space.editResourceQuestion', compact('resourceSpace'));
    }


    public function updateQuestions(Request $request, $id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id);

        // Validate request
        $validated = $request->validate([
            'questions' => 'array|max:7',
            'questions.*' => 'nullable|string|max:255',
        ]);

        // Clear existing questions before updating
        $resourceSpace->questions()->delete();

        // Save updated questions
        foreach ($validated['questions'] as $question) {
            if ($question) {
                ResourceSpaceQuestion::create([
                    'resource_space_id' => $resourceSpace->id,
                    'question' => $question,
                ]);
            }
        }

        return redirect()->route('normal-user.resource-space.detail', $id)
            ->with('message', 'Questions updated successfully.');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Group name must be present, string, and up to 255 characters
            'type' => 'required|in:1,2,3', // Group type must be one of the specified values
            'description' => 'required|string|max:500', // Group description is required and limited to 500 characters
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image file with specific formats and size limit
            'user_id' => 'required|exists:users,id' // User ID must exist in the users table
        ]);

        ResourceSpace::newResourceSpace($request);
        return redirect()->back()->with('message', 'New Resource Space Created Successfully');
    }


    public function dashboard($id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id);

        // Get engagement data (you can reuse your getEngagement method logic here)
        $engagementData = $this->getEngagement($id);
        // Fetch resource space posts with comments (including nested replies)
        $posts = ResourceSpacePost::where('resource_space_id', $id)
            ->with(['comments' => function ($query) {
                $query->whereNull('parent_id')->with('replies');
            }])
            ->latest()
            ->get();

        // Pass the data to the view
        return view('normal-user.resource-space.resourceSpaceDashboard', [
            'postCount' => $engagementData['post_count'],
            'memberCount' => $engagementData['member_count'],
            'totalUpvotes' => $engagementData['total_upvotes'],
            'totalDownvotes' => $engagementData['total_downvotes'],
            'totalComments' => $engagementData['total_comments'],
            'totalEngagement' => $engagementData['total_engagement'],
            'posts' => $posts,
            'resourceSpace' => $resourceSpace
        ]);
    }

    // Define the getEngagement method
    public function getEngagement($id)
    {
        $resourceSpace = ResourceSpace::findOrFail($id);
        // Count the total posts in the resource space
        $postCount = ResourceSpacePost::where('resource_space_id', $id)->count();

        // Count the total members in the resource space
        $memberCount = DB::table('resource_space_users')->where('resource_space_id', $id)->count();

        // Count the total upvotes and downvotes for all posts in the resource space
        $totalUpvotes = ResourceSpacePostVote::whereIn('resource_space_post_id', function($query) use ($id) {
            $query->select('id')->from('resource_space_posts')->where('resource_space_id', $id);
        })->where('vote_type', 'upvote')->count();

        $totalDownvotes = ResourceSpacePostVote::whereIn('resource_space_post_id', function($query) use ($id) {
            $query->select('id')->from('resource_space_posts')->where('resource_space_id', $id);
        })->where('vote_type', 'downvote')->count();

        // Count the total comments for all posts in the resource space
        $totalComments = ResourceSpacePostComment::whereIn('resource_space_post_id', function($query) use ($id) {
            $query->select('id')->from('resource_space_posts')->where('resource_space_id', $id);
        })->count();

        // Total Engagement
        $totalEngagement = $postCount + $memberCount + $totalUpvotes + $totalDownvotes + $totalComments;


        return [
            'post_count' => $postCount,
            'member_count' => $memberCount,
            'total_upvotes' => $totalUpvotes,
            'total_downvotes' => $totalDownvotes,
            'total_comments' => $totalComments,
            'total_engagement' => $totalEngagement
        ];
    }


    public function delete($id, Request $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Find the resource space
            $resourceSpace = ResourceSpace::findOrFail($id);

            // Check if the current user is the creator
            if ($resourceSpace->user_id !== $request->user()->id) {
                return redirect()->back()->with('error', 'You are not authorized to delete this resource space.');
            }

            // Delete related records
            ResourceSpaceQuestion::where('resource_space_id', $id)->delete();
            ResourceSpaceUser::where('resource_space_id', $id)->delete();
            ResourceSpaceJoiningRequest::where('resource_space_id', $id)->delete();

            // Get related posts and their IDs
            $postIds = ResourceSpacePost::where('resource_space_id', $id)->pluck('id')->toArray();

            // Delete related post votes and comments
            ResourceSpacePostVote::whereIn('resource_space_post_id', $postIds)->delete();
            ResourceSpacePostComment::whereIn('resource_space_post_id', $postIds)->delete();

            // Delete posts
            ResourceSpacePost::where('resource_space_id', $id)->delete();

            // Delete the resource space
            $resourceSpace->delete();

            // Commit the transaction
            DB::commit();

            return redirect('/resource-space/list')->with('message', 'Resource space deleted successfully.');
        } catch (\Exception $e) {
            // Rollback on failure
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete the resource space. ' . $e->getMessage());
        }
    }


}
