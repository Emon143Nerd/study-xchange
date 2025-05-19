<?php

namespace App\Models\NormalUser;

use App\Models\NormalUser\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionVote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id', 'vote'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
