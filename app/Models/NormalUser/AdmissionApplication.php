<?php

namespace App\Models\NormalUser;

use App\Models\University\AdmissionCircular;
use App\Models\University\SubjectCategory;
use App\Models\University\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AdmissionApplication extends Model
{
    private static $admissionApplication, $transcript, $tranExtension, $transcriptName, $directory, $tranUrl, $resume, $resumeExtension, $resumeName, $resumeUrl ,$recom, $recomExtension, $recomName, $recomUrl;

    private static function getTranUrl($transcript)
    {
        self::$tranExtension    = $transcript->getClientOriginalExtension(); //png
        self::$transcriptName    = time().'.'.self::$tranExtension; //123423.png
        self::$directory    = 'upload/admission-application-transcript/';
        $transcript->move(self::$directory, self::$transcriptName);
        self::$tranUrl     = self::$directory.self::$transcriptName;
        return self::$tranUrl;
    }

    private static function getResumeUrl($resume)
    {
        if ($resume) {
            self::$resumeExtension    = $resume->getClientOriginalExtension(); //png
            self::$resumeName    = time().'.'.self::$resumeExtension; //123423.png
            self::$directory    = 'upload/admission-circular-resume/';
            $resume->move(self::$directory, self::$resumeName);
            self::$resumeUrl     = self::$directory.self::$resumeName;
            return self::$resumeUrl;
        }
        return null;
    }

    private static function getRecomUrl($recom)
    {
        if ($recom) {
            self::$recomExtension    = $recom->getClientOriginalExtension(); //png
            self::$recomName    = time().'.'.self::$recomExtension; //123423.png
            self::$directory    = 'upload/admission-circular-recommendation/';
            $recom->move(self::$directory, self::$recomName);
            self::$recomUrl     = self::$directory.self::$recomName;
            return self::$recomUrl;
        }
        return null;
    }

    public static function newAdmissionApplication($request)
    {
        self::$admissionApplication = new AdmissionApplication();
        return self::AdmissionApplicationInfo(self::$admissionApplication, $request,
            self::getTranUrl($request->file('transcript')),
            self::getResumeUrl($request->file('resume')),
            self::getRecomUrl($request->file('recommendation_letter'))
        );

    }

    public static function updateAdmissionApplication($request, $id)
    {
        self::$admissionApplication = AdmissionApplication::where('id', $id)->first();
        self::$admissionApplication->acceptance                 = $request->acceptance ?? 0;
        self::$admissionApplication->save();
    }


    public static function deleteAdmissionApplication($id)
    {
        self::$admissionApplication = AdmissionApplication::where('id', $id)->first();
        self::deleteTranFormFolder(self::$admissionApplication->transcript);
        self::deleteResumeFormFolder(self::$admissionApplication->attachment);
        self::deleteRecomFormFolder(self::$admissionApplication->recommendation_letter);
        self::$admissionApplication->delete();
    }

    private static function deleteTranFormFolder($tranUrl)
    {
        if (file_exists($tranUrl))
        {
            unlink($tranUrl);
        }
    }

    private static function deleteResumeFormFolder($resumeUrl)
    {
        if (file_exists($resumeUrl))
        {
            unlink($resumeUrl);
        }
    }

    private static function deleteRecomFormFolder($recomUrl)
    {
        if (file_exists($recomUrl))
        {
            unlink($recomUrl);
        }
    }

    public static function AdmissionApplicationInfo($admissionApplication, $request, $tranUrl, $resumeUrl, $recomUrl)
    {
        self::$admissionApplication->university_id              = $request->university_id;
        self::$admissionApplication->admission_circular_id      = $request->admission_circular_id;
        self::$admissionApplication->full_name                  = $request->full_name;
        self::$admissionApplication->email                      = $request->email;
        self::$admissionApplication->dob                        = $request->dob;
        self::$admissionApplication->nationality                = $request->nationality;
        self::$admissionApplication->prev_education             = $request->prev_education;
        self::$admissionApplication->gpa                        = $request->gpa;
        self::$admissionApplication->test_scores                = $request->test_scores;
        self::$admissionApplication->subject_category_id        = $request->subject_category_id;
        self::$admissionApplication->start_date                 = $request->start_date. '-01';
        self::$admissionApplication->transcript                 = $tranUrl;

        if ($request->hasFile('resume')) {
            self::$admissionApplication->resume                     = $resumeUrl;
        } else {
            self::$admissionApplication->resume = null;
        }
        if ($request->hasFile('recommendation_letter')) {
            self::$admissionApplication->recommendation_letter      = $recomUrl;
        } else {
            self::$admissionApplication->recommendation_letter = null;
        }

        self::$admissionApplication->acceptance                 = $request->acceptance ?? 0;
        self::$admissionApplication->save();
        return self::$admissionApplication;
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function subjectCategory()
    {
        return $this->belongsTo(SubjectCategory::class);
    }

    public function admissionCircular()
    {
        return $this->belongsTo(AdmissionCircular::class);
    }
}
