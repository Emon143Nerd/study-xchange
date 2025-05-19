<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;

class Descriptive extends Model
{
    protected $fillable = [
        'university_id',
        'course_id',
        'question_type',
        'difficulty_level',
        'duration',
        'status'
    ];

    private static $descriptive;

    public static function newDescriptive($request)
    {
        self::$descriptive = new Descriptive();
        return self::DescriptiveInfo(self::$descriptive, $request);
    }

    public static function updateDescriptive($request, $id)
    {
        self::$descriptive = Descriptive::where('id', $id)->first();
        return self::DescriptiveInfo(self::$descriptive, $request);
    }

    public static function deleteDescriptive($id)
    {
        $descriptive = self::findOrFail($id);
        $descriptive->delete();
    }


    private static function DescriptiveInfo($descriptive, $request)
    {
        self::$descriptive->university_id = $request->university_id;
        self::$descriptive->course_id = $request->course_id;
        self::$descriptive->question_type = $request->question_type;
        self::$descriptive->difficulty_level = $request->difficulty_level;
        self::$descriptive->duration = $request->duration;
        self::$descriptive->title = $request->title;
        self::$descriptive->status = $request->status;
        self::$descriptive->save();
        return self::$descriptive;
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(DescriptiveQuestion::class);
    }

    public function descriptiveQuestions()
    {
        return $this->hasMany(DescriptiveQuestion::class, 'descriptive_id');
    }
}
