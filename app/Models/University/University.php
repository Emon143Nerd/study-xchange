<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class University extends Model
{
    private static $university, $image, $extension, $imageName, $directory, $imageUrl;

    private static function getImageUrl($image)
    {
        self::$extension    = $image->getClientOriginalExtension(); //png
        self::$imageName    = time().'.'.self::$extension; //123423.png
        self::$directory    = 'upload/university-image/';
        $image->move(self::$directory, self::$imageName);
        self::$imageUrl     = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newUniversity($request)
    {
        self::$university = new University();
        return self::UniversityInfo(self::$university, $request, self::getImageUrl($request->file('image'))
        );
    }

    public static function updateUniversity($request, $slug)
    {
        self::$university = University::where('slug', $slug)->first();
        if (self::$image = $request->file('image'))
        {
            self::deleteImageFormFolder(self::$university->image);
            self::$imageUrl = self::getImageUrl($request->file('image'));
        }
        else
        {
            self::$imageUrl = self::$university->image;
        }
        self::UniversityInfo(self::$university, $request, self::$imageUrl);
    }

    public static function deleteUniversity($slug)
    {
        self::$university = University::where('slug', $slug)->first();
        self::deleteImageFormFolder(self::$university->image);
        self::$university->delete();
    }

    private static function deleteImageFormFolder($imageUrl)
    {
        if (file_exists($imageUrl))
        {
            unlink($imageUrl);
        }
    }
    public static function UniversityInfo($university, $request, $imageUrl)
    {
        self::$university->user_id              = $request->user_id;
        self::$university->name                 = $request->name;
        self::$university->slug                 = Str::slug($request->name);
        self::$university->description          = $request->description;
        self::$university->university_type      = $request->university_type;
        self::$university->rank                 = $request->rank;
        self::$university->tuition_fees         = $request->tuition_fees;
        self::$university->campus_facilities    = $request->campus_facilities;
        self::$university->scholarships         = $request->scholarships;
        self::$university->placement_records    = $request->placement_records;
        self::$university->residence_facilities = $request->residence_facilities;
        self::$university->food_facilities      = $request->food_facilities;
        self::$university->avg_living_cost      = $request->avg_living_cost;
        self::$university->status               = $request->status;
        self::$university->image                = $imageUrl;
        self::$university->save();
        return self::$university;
    }

    public function admissionCirculars()
    {
        return $this->hasMany(AdmissionCircular::class);
    }
}
