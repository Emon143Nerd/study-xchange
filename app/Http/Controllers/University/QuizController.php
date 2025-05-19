<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\AssessmentAnswer;
use App\Models\NormalUser\AssessmentResult;
use App\Models\University\Course;
use App\Models\University\CourseQuestion;
use App\Models\University\Descriptive;
use App\Models\University\Quiz;
use App\Models\University\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $userUniversity = auth()->user()->university;
        $quizzes = Quiz::where('university_id', $userUniversity->id)->get();
        return view('university-user.course-question.quiz.index',compact('quizzes'));
    }

    public function create()
    {
        $userUniversity = auth()->user()->university;
        $universityId = $userUniversity->id;
        $courses = Course::where('university_id', $userUniversity->id)
            ->select('id', 'title')
            ->get();
        return view('university-user.course-question.quiz.add',compact('universityId','courses'));
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
            'questions.*.option1' => 'required|string',
            'questions.*.option2' => 'required|string',
            'questions.*.option3' => 'required|string',
            'questions.*.option4' => 'required|string',
            'questions.*.correct_answer' => 'required|in:Option 1,Option 2,Option 3,Option 4',
            'questions.*.status' => 'required|in:1,0',
        ]);
        $quiz = Quiz::newQuiz($request);
        QuizQuestion::NewQuestionsForQuiz($quiz->id, $request->questions);
        return redirect('/course-quiz-question/list')->with('message', 'Quiz Question created successfully');
    }

    public function edit($id)
    {
        $userUniversity = auth()->user()->university;
        $universityId = $userUniversity->id;
        $courses = Course::where('university_id', $userUniversity->id)
            ->select('id', 'title')
            ->get();

        $quiz = Quiz::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();

        // Return the edit view with the necessary data
        return view('university-user.course-question.quiz.edit', compact( 'courses','universityId', 'quiz'));
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
            'questions.*.option1' => 'required|string',
            'questions.*.option2' => 'required|string',
            'questions.*.option3' => 'required|string',
            'questions.*.option4' => 'required|string',
            'questions.*.correct_answer' => 'required|in:Option 1,Option 2,Option 3,Option 4',
            'questions.*.status' => 'required|in:1,0',
        ]);

        $quiz = Quiz::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();

        // Handle deleted questions first
        if ($request->has('deleted_questions') && !empty($request->deleted_questions)) {
            $deletedIds = explode(',', $request->deleted_questions);
            QuizQuestion::whereIn('id', $deletedIds)->delete();
        }

        // Update the quiz
        $quiz = Quiz::updateQuiz($request, $quiz->id);

        // Update remaining questions
        if ($request->has('questions')) {
            QuizQuestion::updateQuestionsForQuiz($quiz->id, $request->questions);
        }

        return redirect('/course-quiz-question/list')->with('message', 'Quiz Question updated successfully');
    }


    public function delete($id)
    {
        $quiz = Quiz::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();

        QuizQuestion::deleteQuestions($quiz->id);
        Quiz::deleteQuiz($quiz->id);

        return redirect('/course-quiz-question/list')->with('message', 'Quiz and its questions deleted successfully');
    }

    public function studentQuizResponses()
    {
        $userUniversity = auth()->user()->university;

        $quizResponses = AssessmentResult::join('users', 'assessment_results.user_id', '=', 'users.id')
            ->join('quizzes', 'assessment_results.assessment_id', '=', 'quizzes.id')
            ->where('quizzes.university_id', $userUniversity->id)
            ->where('assessment_results.question_type', 1)
            ->select(
                'assessment_results.id as assessment_result_id',
                'assessment_results.user_id',
                'assessment_results.skill_name',
                'assessment_results.score',
                'assessment_results.accuracy',
                'users.name as user_name',
                DB::raw("'Quiz' as type")
            )
            ->get();

        return view('university-user.course-question.quiz.quiz-response', compact('quizResponses'));
    }





    public function studentQuizResponseEdit($assessmentResultId)
    {
        // Fetch the assessment result with related answers
        $assessmentResult = AssessmentResult::with([
            'assessmentAnswers' => function($query) {
                $query->orderBy('id', 'asc');
            }
        ])->findOrFail($assessmentResultId);

        // Fetch the quiz and its questions
        $quiz = Quiz::with(['quizQuestions' => function($query) {
            $query->where('status', 1);
        }])->findOrFail($assessmentResult->assessment_id);

        // Fetch detailed response information
        $responseDetails = DB::table('assessment_results as ar')
            ->join('assessment_answers as aa', 'aa.assessment_result_id', '=', 'ar.id')
            ->join('quiz_questions as qq', 'aa.question_id', '=', 'qq.id')
            ->join('quizzes as q', 'qq.quiz_id', '=', 'q.id')
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
                'qq.id as question_id',
                'qq.question as question_text',
                'qq.correct_answer'
            )
            ->get();

        if ($responseDetails->isEmpty()) {
            abort(404, "No response details found.");
        }

        return view('university-user.course-question.quiz.edit-quiz-response',
            compact('responseDetails', 'assessmentResult', 'quiz')
        );
    }




    public function studentQuizResponseUpdate(Request $request, $assessmentResultId)
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
            ->with('success', 'Quiz response updated successfully.');
    }


}
