<?php

namespace App\Models\NormalUser;

use App\Models\NormalUser\QuestionVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    private static $question, $image, $imageName, $directory, $extension, $imageUrl;
    protected $fillable = ['user_id', 'title', 'description', 'tags', 'image', 'status'];

    public static function newQuestion($request)
    {
        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/question-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$question                         = new Question();
        self::$question->user_id                = $request->user_id;
        self::$question->title                  = $request->title;
        self::$question->description            = $request->description;
        self::$question->image                  = self::$imageUrl;
        self::$question->status                 = $request->status ?? 1;
        self::$question->save();
        return self::$question;
    }

    public static function updateQuestion($request, $id)
    {
        self::$question = Question::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$question->image)))
            {
                unlink(self::$question->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/question-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$question->image;
        }
        self::$question->user_id                = $request->user_id;
        self::$question->title                  = $request->title;
        self::$question->description            = $request->description;
        self::$question->image                  = self::$imageUrl;
        self::$question->status                 = $request->status ?? 1;
        self::$question->save();
        return self::$question;
    }

    public static function deleteQuestion($id)
    {
        // Find the question
        self::$question = Question::findOrFail($id);

        // Delete associated question tags
        QuestionTag::where('question_id', $id)->delete();

        // Delete the question image if it exists
        if (self::$question->image && file_exists(public_path(self::$question->image))) {
            unlink(public_path(self::$question->image));
        }

        // Finally, delete the question
        self::$question->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'question_tags', 'question_id', 'tag_id');
    }

    public function questionComments()
    {
        return $this->hasMany(QuestionComment::class);
    }

    public function votes()
    {
        return $this->hasMany(QuestionVote::class);
    }

    public function upvotes()
    {
        return $this->votes()->where('vote', 1);
    }

    public function downvotes()
    {
        return $this->votes()->where('vote', 0);
    }

    public function voteByUser($userId, $voteType)
    {
        $existingVote = $this->votes()->where('user_id', $userId)->first();

        if ($existingVote) {
            // If the student has already voted, and the new vote is the same, delete the vote
            if ($existingVote->vote == $voteType) {
                $existingVote->delete();
            } else {
                // Otherwise, update the vote
                $existingVote->update(['vote' => $voteType]);
            }
        } else {
            // If no vote exists, create a new one
            $this->votes()->create([
                'user_id' => $userId,
                'vote' => $voteType,
            ]);
        }
    }

}
