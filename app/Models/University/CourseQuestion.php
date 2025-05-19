<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseQuestion extends Model
{
    private static $courseQuestion, $image, $extension, $imageName, $directory, $imageUrl;

    private static function getImageUrl($image)
    {
        if ($image && $image->hasFile('image')) {
            self::$extension = $image->getClientOriginalExtension(); //png
            self::$imageName = time() . '.' . self::$extension; //123423.png
            self::$directory = 'upload/course-question-image/';
            $image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
            return self::$imageUrl;
        } else {
            self::$imageUrl = null;
            return self::$imageUrl;
        }
    }

    public static function newCourseQuestion($request)
    {
        self::$courseQuestion = new CourseQuestion();
        return self::CourseQuestionInfo(self::$courseQuestion, $request, self::getImageUrl($request->file('image'))
        );
    }

    public static function updateCourseQuestion($request, $id)
    {
        self::$courseQuestion = CourseQuestion::where('id', $id)->first();
        if (self::$image = $request->file('image'))
        {
            self::deleteImageFormFolder(self::$courseQuestion->image);
            self::$imageUrl = self::getImageUrl($request->file('image'));
        }
        else
        {
            self::$imageUrl = self::$courseQuestion->image;
        }
        self::CourseQuestionInfo(self::$courseQuestion, $request, self::$imageUrl);
    }

    public static function deleteCourseQuestion($id)
    {
        // Find the JobCircular
        self::$courseQuestion = CourseQuestion::findOrFail($id);

        // Delete the JobCircular image if it exists
        if (self::$courseQuestion->image && file_exists(public_path(self::$courseQuestion->image))) {
            unlink(public_path(self::$courseQuestion->image));
        }

        // Finally, delete the JobCircular
        self::$courseQuestion->delete();
    }

    public static function CourseQuestionInfo($courseQuestion, $request, $imageUrl)
    {
        self::$courseQuestion->university_id       = $request->university_id;
        self::$courseQuestion->course_id           = $request->course_id;
        self::$courseQuestion->question_type       = $request->question_type;
        self::$courseQuestion->difficulty_level    = $request->difficulty_level;
        self::$courseQuestion->question            = $request->question;
        self::$courseQuestion->answer              = $request->answer ?? null;
        self::$courseQuestion->explanation         = $request->explanation ?? null;
        self::$courseQuestion->duration            = $request->duration;
        self::$courseQuestion->status              = $request->status;
        self::$courseQuestion->image               = $imageUrl;
        self::$courseQuestion->save();
        return self::$courseQuestion;
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }
}
