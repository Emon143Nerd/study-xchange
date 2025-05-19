<?php

namespace App\Models\NormalUser;

use App\Models\NormalUser\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'question_id', 'answer', 'spam_reports', 'status'];

    public static function newQuestionComment($request)
    {
        self::saveBasicInfo(new QuestionComment(), $request);
    }


    public static function updateQuestionComment($request, $id)
    {
        $comment = QuestionComment::find($id);

        if ($comment) {
            self::saveBasicInfo($comment, $request);
        } else {
            // Handle case where the comment is not found
            return null;
        }
    }


    public static function deleteQuestionComment($id)
    {
        $comment = QuestionComment::find($id);
        $comment->delete();
    }

    private static function saveBasicInfo($comment, $request)
    {
        $comment->user_id           = $request->user_id;
        $comment->question_id       = $request->question_id;
        $comment->answer            = $request->answer;
        $comment->status            = 1; // Assuming you want to set the status to 1 by default
        $comment->save();
    }

    public function reportSpam()
    {
        $this->increment('spam_reports');
        if ($this->spam_reports >= 5) { // Threshold to hide a comment
            $this->update(['status' => 0]); // Set status to hidden
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
