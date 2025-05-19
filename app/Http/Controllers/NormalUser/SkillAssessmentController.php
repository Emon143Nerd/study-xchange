<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\AssessmentAnswer;
use App\Models\NormalUser\AssessmentResult;
use App\Models\University\Descriptive;
use App\Models\University\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkillAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get search keyword
        $type = $request->input('type'); // Get question type filter (quiz/descriptive)

        // Fetch quiz questions
        $quizQuestions = DB::table('quiz_questions')
            ->join('quizzes', 'quiz_questions.quiz_id', '=', 'quizzes.id')
            ->join('courses', 'quizzes.course_id', '=', 'courses.id')
            ->join('universities', 'quizzes.university_id', '=', 'universities.id')
            ->select(
                'quiz_questions.quiz_id as id',
                'quizzes.difficulty_level',
                'quizzes.duration',
                'courses.title as course_name',
                'quizzes.title as quiz_title',
                'universities.name as university_name',
                DB::raw('COUNT(quiz_questions.id) as question_count')
            )
            ->where('quizzes.status', 1)
            ->where('quiz_questions.status', 1)
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('courses.title', 'like', "%$search%")
                        ->orWhere('quizzes.title', 'like', "%$search%")
                        ->orWhere('universities.name', 'like', "%$search%");
                });
            })
            ->groupBy('quiz_questions.quiz_id', 'quizzes.difficulty_level', 'quizzes.duration', 'courses.title', 'quizzes.title', 'universities.name')
            ->get()
            ->map(function ($quiz) {
                $quiz->type = 'quiz';
                return $quiz;
            });

        // Fetch descriptive questions
        $descriptiveQuestions = DB::table('descriptive_questions')
            ->join('descriptives', 'descriptive_questions.descriptive_id', '=', 'descriptives.id')
            ->join('courses', 'descriptives.course_id', '=', 'courses.id')
            ->join('universities', 'descriptives.university_id', '=', 'universities.id')
            ->select(
                'descriptive_questions.descriptive_id as id',
                'descriptives.difficulty_level',
                'descriptives.duration',
                'courses.title as course_name',
                'descriptives.title as descriptive_title',
                'universities.name as university_name',
                DB::raw('COUNT(descriptive_questions.id) as question_count')
            )
            ->where('descriptives.status', 1)
            ->where('descriptive_questions.status', 1)
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('courses.title', 'like', "%$search%")
                        ->orWhere('descriptives.title', 'like', "%$search%")
                        ->orWhere('universities.name', 'like', "%$search%");
                });
            })
            ->groupBy('descriptive_questions.descriptive_id', 'descriptives.difficulty_level', 'descriptives.duration', 'courses.title', 'descriptives.title', 'universities.name')
            ->get()
            ->map(function ($question) {
                $question->type = 'descriptive';
                return $question;
            });

        // Merge the quiz and descriptive questions
        $allQuestions = $quizQuestions->merge($descriptiveQuestions)
            ->when($type, function ($collection, $type) {
                return $collection->filter(function ($item) use ($type) {
                    return $item->type === $type;
                });
            })
            ->shuffle();

        // Fetch assessment results
        $assessmentResults = DB::table('assessment_results')
            ->leftJoin('quizzes', 'assessment_results.assessment_id', '=', 'quizzes.id')
            ->leftJoin('descriptives', 'assessment_results.assessment_id', '=', 'descriptives.id')
            ->select(
                'assessment_results.id',
                'assessment_results.skill_name',
                'assessment_results.score',
                'assessment_results.accuracy',
                'quizzes.title as quiz_title',
                'descriptives.title as descriptive_title'
            )
            ->where('assessment_results.user_id', auth()->id())
            ->get();

        return view('normal-user.skill-assessment.index', compact('allQuestions', 'assessmentResults'));
    }




    public function showDescriptive($id)
    {
        $descriptive = Descriptive::with('descriptiveQuestions')->findOrFail($id);
        return view('normal-user.skill-assessment.descriptive-detail', compact('descriptive'));
    }


    public function submitDescriptive(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'assessment_id' => 'required|integer',
            'skill_name' => 'required|string|max:255',
            'answers' => 'required|array',
            'answers.*' => 'nullable|string', // Individual answers can be empty
        ]);

        // Store data in the assessment_results table
        $assessmentResult = AssessmentResult::create([
            'user_id' => $validatedData['user_id'],
            'assessment_id' => $validatedData['assessment_id'],
            'question_type' => 2, // 2 for descriptive assessment
            'skill_name' => $validatedData['skill_name'],
            'score' => null, // Will calculate later
            'correct_answers' => 0,
            'start_time' => now(),
            'end_time' => null,
            'wrong_answers' => 0,
            'completed_time' => null,
            'accuracy' => null,
            'feedback' => 'Pending',
        ]);

        // Store answers in assessment_answers table
        foreach ($validatedData['answers'] as $questionId => $answer) {
            // Only insert non-null answers
            if (!is_null($answer)) {
                AssessmentAnswer::create([
                    'assessment_result_id' => $assessmentResult->id,
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'is_correct' => 1, // Default; implement pending-checking logic later
                ]);
            }
        }

        return redirect()->route('normal-user.assessment.descriptive.result', ['id' => $assessmentResult->id])->with('success', 'Assessment submitted successfully!');
    }


    public function showQuiz($id)
    {
        $quiz = Quiz::with('quizQuestions')->findOrFail($id);
        return view('normal-user.skill-assessment.quiz-detail', compact('quiz'));
    }



    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::with('quizQuestions')->findOrFail($id);
        $user = Auth::user();
        $correctAnswers = 0;
        $wrongAnswers = 0;

        // Create the initial assessment result
        $assessmentResult = AssessmentResult::create([
            'user_id' => $user->id,
            'assessment_id' => $quiz->id,
            'question_type' => 1,
            'skill_name' => $quiz->Course->title,
            'score' => 0,
            'correct_answers' => 0,
            'wrong_answers' => 0,
            'accuracy' => 0,
            'start_time' => now(),
            'end_time' => null,
        ]);

        // Process each question and store answers
        foreach ($quiz->quizQuestions as $question) {
            $userAnswer = $request->input("question_{$question->id}");

            // Check if an answer was provided
            if ($userAnswer !== null) {
                $isCorrect = ($userAnswer === $question->correct_answer);

                if ($isCorrect) {
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;
                }

                // Store the user's answer
                AssessmentAnswer::create([
                    'assessment_result_id' => $assessmentResult->id,
                    'question_id' => $question->id,
                    'answer' => $userAnswer,
                    'is_correct' => $isCorrect ? 1 : 0,
                ]);
            } else {
                // Store the record for unanswered questions
                AssessmentAnswer::create([
                    'assessment_result_id' => $assessmentResult->id,
                    'question_id' => $question->id,
                    'answer' => '', // Provide a default value instead of null
                    'is_correct' => 0,
                ]);

            }
        }

        $totalQuestions = $quiz->quizQuestions->count();
        $accuracy = ($totalQuestions > 0) ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

        // Update the assessment result with final calculations
        $assessmentResult->update([
            'score' => $correctAnswers,
            'correct_answers' => $correctAnswers,
            'wrong_answers' => $wrongAnswers,
            'accuracy' => $accuracy,
            'end_time' => now(),
        ]);

        return redirect()->route('normal-user.assessment.quiz.result', $assessmentResult->id)
            ->with('success', 'Quiz submitted successfully!');
    }



    public function descriptiveResult($id)
    {
        $result = AssessmentResult::with([
            'assessmentAnswers.descriptiveQuestion', // Eager load the descriptive questions
            'assessment.descriptiveQuestions', // Load all questions from the descriptive assessment
        ])
            ->findOrFail($id);

        return view('normal-user.skill-assessment.descriptive-result', compact('result'));
    }


    public function quizResult($id)
    {
        $result = AssessmentResult::with([
            'assessmentAnswers.question',
            'user'
        ])->findOrFail($id);

        // Get the quiz details
        $quiz = Quiz::with('quizQuestions')->findOrFail($result->assessment_id);

        return view('normal-user.skill-assessment.quiz-result', compact('result', 'quiz'));
    }



    public function assessmentDetail($id)
    {
        $result = AssessmentResult::findOrFail($id);

        // Check if the assessment result is for a Quiz or Descriptive
        if ($result->question_type === 1) {
            // It's a Quiz
            $quiz = Quiz::with('quizQuestions')->findOrFail($result->assessment_id);

            return view('normal-user.skill-assessment.quiz-result', [
                'result' => $result,
                'assessmentResult' => $result,
                'quiz' => $quiz
            ]);
        } elseif ($result->question_type === 2) {
            // It's a Descriptive assessment
            return view('normal-user.skill-assessment.descriptive-result', [
                'result' => $result,
                'assessmentResult' => $result,
            ]);
        }

        // Handle the case where no matching assessment is found
        return abort(404, 'Assessment type not found.');
    }

}
