<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    private static $course;

    public static function newCourse($request)
    {
        self::$course = new Course();
        return self::CourseInfo(self::$course, $request);
    }

    public static function updateCourse($request, $id)
    {
        self::$course = Course::where('id', $id)->first();
        self::CourseInfo(self::$course, $request);
    }

    public static function deleteCourse($id)
    {
        self::$course = Course::where('id', $id)->first();
        self::$course->delete();
    }

    public static function CourseInfo($course, $request)
    {
        $course->university_id              = $request->university_id; // Use input() to safely get the value
        $course->title                      = $request->title;
        $course->description                = $request->description;
        $course->status                     = $request->status;
        $course->save();

        return $course;
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function courseQuestion()
    {
        return $this->hasMany(CourseQuestion::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
