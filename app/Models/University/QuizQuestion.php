<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'quiz_id',
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct_answer',
        'status'
    ];

    public static function NewQuestionsForQuiz($quizId, $questionsData)
    {
        foreach ($questionsData as $questionData) {
            self::create([
                'quiz_id' => $quizId,
                'question' => $questionData['question'],
                'option1' => $questionData['option1'],
                'option2' => $questionData['option2'],
                'option3' => $questionData['option3'],
                'option4' => $questionData['option4'],
                'correct_answer' => $questionData['correct_answer'],
                'status' => $questionData['status'],
            ]);
        }
    }

    public static function updateQuestionsForQuiz($quizId, $questionsData)
    {
        foreach ($questionsData as $questionData) {
            if (!empty($questionData['id'])) {
                // Update existing question
                $question = self::find($questionData['id']);
                if ($question) {
                    $question->update([
                        'quiz_id' => $quizId,
                        'question' => $questionData['question'],
                        'option1' => $questionData['option1'],
                        'option2' => $questionData['option2'],
                        'option3' => $questionData['option3'],
                        'option4' => $questionData['option4'],
                        'correct_answer' => $questionData['correct_answer'],
                        'status' => $questionData['status'],
                    ]);
                }
            } else {
                // Create new question
                self::create([
                    'quiz_id' => $quizId,
                    'question' => $questionData['question'],
                    'option1' => $questionData['option1'],
                    'option2' => $questionData['option2'],
                    'option3' => $questionData['option3'],
                    'option4' => $questionData['option4'],
                    'correct_answer' => $questionData['correct_answer'],
                    'status' => $questionData['status'],
                ]);
            }
        }
    }

    public static function deleteQuestions($quizId)
    {
        // Get all question IDs associated with the quiz
        $questionIds = self::where('quiz_id', $quizId)->pluck('id')->toArray();

        // Check if there are questions to delete
        if (!empty($questionIds)) {
            self::whereIn('id', $questionIds)->delete();
        }
    }


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

}
