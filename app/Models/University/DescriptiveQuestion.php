<?php

namespace App\Models\University;

use App\Models\NormalUser\AssessmentAnswer;
use Illuminate\Database\Eloquent\Model;

class DescriptiveQuestion extends Model
{
    protected $fillable = [
        'descriptive_id',
        'question',
        'correct_answer',
        'status'
    ];

    public static function newQuestionsForDescriptive($descriptiveId, $questionsData)
    {
        foreach ($questionsData as $questionData) {
            self::create([
                'descriptive_id' => $descriptiveId,
                'question' => $questionData['question'],
                'correct_answer' => $questionData['correct_answer'],
                'status' => $questionData['status'],
            ]);
        }
    }

    public static function updateQuestionsForDescriptive($descriptiveId, $questionsData)
    {
        foreach ($questionsData as $questionData) {
            if (!empty($questionData['id'])) {
                // Update existing question
                $question = self::find($questionData['id']);
                if ($question) {
                    $question->update([
                        'descriptive_id' => $descriptiveId,
                        'question' => $questionData['question'],
                        'correct_answer' => $questionData['correct_answer'],
                        'status' => $questionData['status'],
                    ]);
                }
            } else {
                // Create new question
                self::create([
                    'descriptive_id' => $descriptiveId,
                    'question' => $questionData['question'],
                    'correct_answer' => $questionData['correct_answer'],
                    'status' => $questionData['status'],
                ]);
            }
        }
    }

    public static function deleteQuestions($descriptiveId)
    {
        // Get all question IDs associated with the Descriptive
        $questionIds = self::where('descriptive_id', $descriptiveId)->pluck('id')->toArray();

        // Check if there are questions to delete
        if (!empty($questionIds)) {
            self::whereIn('id', $questionIds)->delete();
        }
    }


    public function descriptive()
    {
        return $this->belongsTo(Descriptive::class);
    }

    public function answers()
    {
        return $this->hasMany(AssessmentAnswer::class, 'question_id');
    }
}
