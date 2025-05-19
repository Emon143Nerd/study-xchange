<?php

namespace App\Models\NormalUser;

use App\Models\University\Descriptive;
use App\Models\University\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    protected $fillable = [
        'user_id',
        'assessment_id',
        'question_type',
        'skill_name',
        'score',
        'start_time',
        'end_time',
        'correct_answers',
        'wrong_answers',
        'completed_time',
        'accuracy',
    ];

    public function answers()
    {
        return $this->hasMany(AssessmentAnswer::class, 'assessment_result_id');
    }

    public function assessmentAnswers()
    {
        return $this->hasMany(AssessmentAnswer::class, 'assessment_result_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Descriptive::class, 'assessment_id');
    }

    public function quizAssessment()
    {
        return $this->belongsTo(Quiz::class, 'assessment_id');
    }


}

