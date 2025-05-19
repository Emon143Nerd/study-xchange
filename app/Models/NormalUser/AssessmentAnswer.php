<?php

namespace App\Models\NormalUser;

use App\Models\University\DescriptiveQuestion;
use Illuminate\Database\Eloquent\Model;

class AssessmentAnswer extends Model
{
    protected $fillable = [
        'assessment_result_id',
        'question_id',
        'answer',
        'is_correct',
    ];

    public function result()
    {
        return $this->belongsTo(AssessmentResult::class, 'assessment_result_id');
    }

    public function assessmentResult()
    {
        return $this->belongsTo(AssessmentResult::class, 'assessment_result_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function descriptiveQuestion()
    {
        return $this->belongsTo(DescriptiveQuestion::class, 'question_id');
    }
}
