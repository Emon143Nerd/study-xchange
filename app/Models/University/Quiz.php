<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'university_id',
        'course_id',
        'question_type',
        'difficulty_level',
        'duration',
        'status'
    ];

    private static $quiz;

    public static function newQuiz($request)
    {
        self::$quiz = new Quiz();
        return self::QuizInfo(self::$quiz, $request);
    }

    public static function updateQuiz($request, $id)
    {
        self::$quiz = Quiz::where('id', $id)->first();
        return self::QuizInfo(self::$quiz, $request);
    }

    public static function deleteQuiz($id)
    {
        $quiz = self::findOrFail($id);
        $quiz->delete();
    }


    private static function QuizInfo($quiz, $request)
    {
        self::$quiz->university_id = $request->university_id;
        self::$quiz->course_id = $request->course_id;
        self::$quiz->question_type = $request->question_type;
        self::$quiz->difficulty_level = $request->difficulty_level;
        self::$quiz->duration = $request->duration;
        self::$quiz->title = $request->title;
        self::$quiz->status = $request->status;
        self::$quiz->save();
        return self::$quiz;
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }
}
