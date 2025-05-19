<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class SubjectCategory extends Model
{
    private static $subjectCategory, $image, $extension, $imageName, $directory, $imageUrl;

    private static function getImageUrl($image)
    {
        self::$extension    = $image->getClientOriginalExtension(); //png
        self::$imageName    = time().'.'.self::$extension; //123423.png
        self::$directory    = 'upload/subject-category-image/';
        $image->move(self::$directory, self::$imageName);
        self::$imageUrl     = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newSubjectCategory($request)
    {
        self::$subjectCategory = new SubjectCategory();
        return self::SubjectCategoryInfo(self::$subjectCategory, $request, self::getImageUrl($request->file('image'))
        );
    }

    public static function updateSubjectCategory($request, $slug)
    {
        self::$subjectCategory = SubjectCategory::where('slug', $slug)->first();
        if (self::$image = $request->file('image'))
        {
            self::deleteImageFormFolder(self::$subjectCategory->image);
            self::$imageUrl = self::getImageUrl($request->file('image'));
        }
        else
        {
            self::$imageUrl = self::$subjectCategory->image;
        }
        self::SubjectCategoryInfo(self::$subjectCategory, $request, self::$imageUrl);
    }

    public static function deleteSubjectCategory($slug)
    {
        self::$subjectCategory = SubjectCategory::where('slug', $slug)->first();
        self::deleteImageFormFolder(self::$subjectCategory->image);
        self::$subjectCategory->delete();
    }

    private static function deleteImageFormFolder($imageUrl)
    {
        if (file_exists($imageUrl))
        {
            unlink($imageUrl);
        }
    }
    public static function SubjectCategoryInfo($subjectCategory, $request, $imageUrl)
    {
        self::$subjectCategory->university_id      = $request->university_id;
        self::$subjectCategory->name               = $request->name;
        self::$subjectCategory->slug               = Str::slug($request->name);
        self::$subjectCategory->description        = $request->description;
        self::$subjectCategory->status             = $request->status;
        self::$subjectCategory->image              = $imageUrl;
        self::$subjectCategory->save();
        return self::$subjectCategory;
    }
}
