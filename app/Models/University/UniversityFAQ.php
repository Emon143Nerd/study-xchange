<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UniversityFAQ extends Model
{
    private static $universityFAQ;

    public static function newUniversityFAQ($request)
    {
        self::$universityFAQ = new UniversityFAQ();
        return self::UniversityInfo(self::$universityFAQ, $request);
    }

    public static function updateUniversityFAQ($request, $id)
    {
        self::$universityFAQ = UniversityFAQ::where('id', $id)->first();
        self::UniversityInfo(self::$universityFAQ, $request);
    }

    public static function deleteUniversityFAQ($id)
    {
        self::$universityFAQ = UniversityFAQ::where('id', $id)->first();
        self::$universityFAQ->delete();
    }

    public static function UniversityInfo($universityFAQ, $request)
    {
        $universityFAQ->university_id           = $request->university_id; // Use input() to safely get the value
        $universityFAQ->subject_category_id     = $request->subject_category_id;
        $universityFAQ->question                = $request->question;
        $universityFAQ->answer                  = $request->answer;
        $universityFAQ->status                  = $request->status;
        $universityFAQ->save();

        return $universityFAQ;
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function subjectCategory()
    {
        return $this->belongsTo(SubjectCategory::class);
    }
}
