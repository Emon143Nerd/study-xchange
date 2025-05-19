<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\AssessmentAnswer;
use App\Models\NormalUser\AssessmentResult;
use App\Models\University\Course;
use App\Models\University\Descriptive;
use App\Models\University\DescriptiveQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DescriptiveController extends Controller
{
    public function index()
    {
        $userUniversity = auth()->user()->university;
        $descriptives = Descriptive::where('university_id', $userUniversity->id)->get();
        return view('university-user.course-question.descriptive.index',compact('descriptives'));
    }

    public function create()
    {
        $userUniversity = auth()->user()->university;
        $universityId = $userUniversity->id;
        $courses = Course::where('university_id', $userUniversity->id)
            ->select('id', 'title')
            ->get();
        return view('university-user.course-question.descriptive.add',compact('universityId','courses'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|exists:universities,id',
            'course_id' => 'required|exists:courses,id',
            'question_type' => 'required|in:1,2',
            'difficulty_level' => 'required|in:1,2,3',
            'duration' => 'nullable|integer|min:1',
            'title' => 'required|string',
            'status' => 'required|in:1,0',
            'questions.*.question' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.status' => 'required|in:1,0',
        ]);

        $descriptive = Descriptive::newDescriptive($request);
        DescriptiveQuestion::newQuestionsForDescriptive($descriptive->id, $request->questions);
        return redirect('/course-descriptive-question/list')->with('message', 'Descriptive Question created successfully');
    }

    public function edit($id)
    {
        $userUniversity = auth()->user()->university;
        $universityId = $userUniversity->id;
        $courses = Course::where('university_id', $userUniversity->id)
            ->select('id', 'title')
            ->get();

        $descriptive = Descriptive::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();

        // Return the edit view with the necessary data
        return view('university-user.course-question.descriptive.edit', compact( 'courses','universityId', 'descriptive'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'university_id' => 'required|exists:universities,id',
            'course_id' => 'required|exists:courses,id',
            'question_type' => 'required|in:1,2',
            'difficulty_level' => 'required|in:1,2,3',
            'duration' => 'nullable|integer|min:1',
            'status' => 'required|in:1,0',
            'questions.*.question' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.status' => 'required|in:1,0',
        ]);

        $descriptive = Descriptive::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();

        // Handle deleted questions first
        if ($request->has('deleted_questions') && !empty($request->deleted_questions)) {
            $deletedIds = explode(',', $request->deleted_questions);
            DescriptiveQuestion::whereIn('id', $deletedIds)->delete();
        }

        // Update the quiz
        $descriptive = Descriptive::updateDescriptive($request, $descriptive->id);

        // Update remaining questions
        if ($request->has('questions')) {
            DescriptiveQuestion::updateQuestionsForDescriptive($descriptive->id, $request->questions);
        }

        return redirect('/course-descriptive-question/list')->with('message', 'Descriptive Question updated successfully');
    }


    public function delete($id)
    {
        $descriptive = Descriptive::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();

        DescriptiveQuestion::deleteQuestions($descriptive->id);
        Descriptive::deleteDescriptive($descriptive->id);

        return redirect('/course-descriptive-question/list')->with('message', 'Descriptive and its questions deleted successfully');
    }

    public function studentDescriptiveResponses()
    {
        $userUniversity = auth()->user()->university;

        // Fetch only descriptive responses
        $descriptiveResponses = DB::table('assessment_results')
            ->join('descriptives', function($join) {
                $join->on('assessment_results.assessment_id', '=', 'descriptives.id')
                    ->where('assessment_results.question_type', '=', 2); // Ensure we only get descriptive types
            })
            ->join('users', 'assessment_results.user_id', '=', 'users.id')
            ->where('descriptives.university_id', $userUniversity->id)
            ->select(
                'assessment_results.id as assessment_result_id',
                'assessment_results.user_id',
                'assessment_results.skill_name',
                'assessment_results.score',
                'assessment_results.accuracy',
                'users.name as user_name',
                DB::raw('"Descriptive" as response_type')
            )
            ->distinct()
            ->get();

        return view('university-user.course-question.descriptive.descriptive-response', [
            'responses' => $descriptiveResponses
        ]);
    }



    public function studentDescriptiveResponseEdit($assessmentResultId)
    {
        // Fetch the assessment result with related answers
        $assessmentResult = AssessmentResult::with([
            'assessmentAnswers' => function($query) {
                $query->orderBy('id', 'asc');
            }
        ])->findOrFail($assessmentResultId);

        // Fetch the descriptive assessment and its questions
        $descriptive = Descriptive::with(['descriptiveQuestions' => function($query) {
            $query->where('status', 1);
        }])->findOrFail($assessmentResult->assessment_id);

        // Fetch detailed response information
        $responseDetails = DB::table('assessment_results as ar')
            ->join('assessment_answers as aa', 'aa.assessment_result_id', '=', 'ar.id')
            ->join('descriptive_questions as dq', 'aa.question_id', '=', 'dq.id')
            ->join('descriptives as d', 'dq.descriptive_id', '=', 'd.id')
            ->where('ar.id', $assessmentResultId)
            ->select(
                'ar.id as assessment_result_id',
                'ar.skill_name',
                'ar.score',
                'ar.correct_answers',
                'ar.wrong_answers',
                'ar.completed_time',
                'ar.accuracy',
                'aa.id as answer_id',
                'aa.answer as user_answer',
                'aa.is_correct',
                'dq.id as question_id',
                'dq.question as question_text',
                'dq.correct_answer'
            )
            ->get();

        if ($responseDetails->isEmpty()) {
            abort(404, "No response details found.");
        }

        return view('university-user.course-question.descriptive.edit-descriptive-response',
            compact('responseDetails', 'assessmentResult', 'descriptive')
        );
    }



    public function studentDescriptiveResponseUpdate(Request $request, $assessmentResultId)
    {
        // Validate the request
        $request->validate([
            'is_correct' => 'required|array',
            'is_correct.*' => 'required|boolean',
            'score' => 'required|numeric|min:0',
            'feedback' => 'required|string'
        ]);

        DB::transaction(function() use ($request, $assessmentResultId) {
            // Update individual answers
            foreach ($request->is_correct as $questionId => $isCorrect) {
                AssessmentAnswer::where('assessment_result_id', $assessmentResultId)
                    ->where('question_id', $questionId)
                    ->update([
                        'is_correct' => $isCorrect
                    ]);
            }

            // Calculate totals
            $correctAnswers = count(array_filter($request->is_correct, fn($value) => $value == 1));
            $totalQuestions = count($request->is_correct);
            $wrongAnswers = $totalQuestions - $correctAnswers;
            $accuracy = ($totalQuestions > 0) ? ($correctAnswers / $totalQuestions) * 100 : 0;

            // Update assessment result
            AssessmentResult::where('id', $assessmentResultId)->update([
                'score' => $request->score,
                'correct_answers' => $correctAnswers,
                'wrong_answers' => $wrongAnswers,
                'accuracy' => $accuracy,
                'feedback' => $request->feedback
            ]);
        });

        return redirect()
            ->back()
            ->with('success', 'Assessment response updated successfully.');
    }


}
