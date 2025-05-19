<?php

namespace App\Models\University;

use App\Models\NormalUser\AdmissionApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AdmissionCircular extends Model
{
    private static $admissionCircular, $image, $imgExtension, $imageName, $directory, $imageUrl, $fileExtension, $file, $fileName, $fileUrl;

    private static function getImageUrl($image)
    {
        self::$imgExtension    = $image->getClientOriginalExtension(); //png
        self::$imageName    = time().'.'.self::$imgExtension; //123423.png
        self::$directory    = 'upload/admission-circular-image/';
        $image->move(self::$directory, self::$imageName);
        self::$imageUrl     = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    private static function getFileUrl($file)
    {
        self::$fileExtension    = $file->getClientOriginalExtension(); //png
        self::$fileName    = time().'.'.self::$fileExtension; //123423.png
        self::$directory    = 'upload/admission-circular-file/';
        $file->move(self::$directory, self::$fileName);
        self::$fileUrl     = self::$directory.self::$fileName;
        return self::$fileUrl;
    }

    public static function newAdmissionCircular($request)
    {
        self::$admissionCircular = new AdmissionCircular();
        return self::AdmissionCircularInfo(self::$admissionCircular, $request,
            self::getImageUrl($request->file('image')),
            self::getFileUrl($request->file('attachment'))
        );
    }

    public static function updateAdmissionCircular($request, $slug)
    {
        self::$admissionCircular = AdmissionCircular::where('slug', $slug)->first();
        if (self::$image = $request->file('image'))
        {
            self::deleteImageFormFolder(self::$admissionCircular->image);
            self::$imageUrl = self::getImageUrl($request->file('image'));
        }
        else
        {
            self::$imageUrl = self::$admissionCircular->image;
        }

        if (self::$fileUrl = $request->file('attachment'))
        {
            self::deleteFileFormFolder(self::$admissionCircular->attachment);
            self::$fileUrl = self::getFileUrl($request->file('attachment'));
        }
        else
        {
            self::$fileUrl = self::$admissionCircular->attachment;
        }
        self::AdmissionCircularInfo(self::$admissionCircular, $request, self::$imageUrl, self::$fileUrl);
    }

    public static function deleteAdmissionCircular($slug)
    {
        self::$admissionCircular = AdmissionCircular::where('slug', $slug)->first();
        self::deleteImageFormFolder(self::$admissionCircular->image);
        self::deleteFileFormFolder(self::$admissionCircular->attachment);
        self::$admissionCircular->delete();
    }

    private static function deleteImageFormFolder($imageUrl)
    {
        if (file_exists($imageUrl))
        {
            unlink($imageUrl);
        }
    }

    private static function deleteFileFormFolder($fileUrl)
    {
        if (file_exists($fileUrl))
        {
            unlink($fileUrl);
        }
    }
    public static function AdmissionCircularInfo($admissionCircular, $request, $imageUrl, $fileUrl)
    {
        self::$admissionCircular->university_id         = $request->university_id;
        self::$admissionCircular->subject_category_id   = $request->subject_category_id;
        self::$admissionCircular->title                 = $request->title;
        self::$admissionCircular->slug                  = Str::slug($request->title);
        self::$admissionCircular->description           = $request->description;
        self::$admissionCircular->total_fees            = $request->total_fees;
        self::$admissionCircular->min_gpa_req           = $request->min_gpa_req;
        self::$admissionCircular->start_date            = Carbon::parse($request->start_date)->format('Y-m-d');
        self::$admissionCircular->end_date              = Carbon::parse($request->end_date)->format('Y-m-d');
        self::$admissionCircular->status                = $request->status;
        self::$admissionCircular->image                 = $imageUrl;
        self::$admissionCircular->attachment            = $fileUrl;
        self::$admissionCircular->save();
        return self::$admissionCircular;
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function subjectCategory()
    {
        return $this->belongsTo(SubjectCategory::class);
    }

    public function admissionApplication()
    {
        return $this->hasMany(AdmissionApplication::class);
    }
}
