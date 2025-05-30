<?php

namespace App\Models\Job;
//
use App\Models\User;
use App\Models\UserCertification;
use App\Models\UserEducation;
use App\Models\UserJobPreference;
use App\Models\UserSkill;
use App\Models\UserWorkExperience;
use Illuminate\Database\Eloquent\Model;
//
class JobApplication extends Model
{
    private static $jobApplication, $image, $imageName, $directory, $extension, $imageUrl;
    protected $fillable = [
        'job_circular_id',
        'user_id',
        'name',
        'phone',
        'email',
        'education',
        'skill',
        'work_experience',
        'certifications',
        'job_preference',
        'resume',
        'image',
        'status'
    ];
    public static function newJobApplication($request)
    {
        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/JobApplication-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$jobApplication                               = new JobApplication();
        self::$jobApplication->job_circular_id              = $request->job_circular_id;
        self::$jobApplication->user_id                      = $request->user_id;
        self::$jobApplication->name                         = $request->name;
        self::$jobApplication->phone                        = $request->phone;
        self::$jobApplication->email                        = $request->email;

        self::$jobApplication->education                    = $request->has('education') ? json_encode($request->education) : null;
        self::$jobApplication->skill                        = $request->has('skill') ? json_encode($request->skill) : null;
        self::$jobApplication->work_experience              = $request->has('work_experience') ? json_encode($request->work_experience) : null;
        self::$jobApplication->certifications               = $request->has('certifications') ? json_encode($request->certifications) : null;
        self::$jobApplication->job_preference               = $request->has('job_preference') ? json_encode($request->job_preference) : null;


        self::$jobApplication->resume                       = $request->resume ?? null;
        self::$jobApplication->image                        = self::$imageUrl;
        self::$jobApplication->status                       = $request->status ?? 0;
        self::$jobApplication->save();
        return self::$jobApplication;
    }

    public static function updateJobApplication($request, $id)
    {
        self::$jobApplication = JobApplication::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$jobApplication->image)))
            {
                unlink(self::$jobApplication->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/JobApplication-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$jobApplication->image;
        }
        self::$jobApplication->job_circular_id              = $request->job_circular_id;
        self::$jobApplication->user_id                      = $request->user_id;
        self::$jobApplication->name                         = $request->name;
        self::$jobApplication->phone                        = $request->phone;
        self::$jobApplication->email                        = $request->email;

        self::$jobApplication->education                    = $request->has('education') ? json_encode($request->education) : null;
        self::$jobApplication->skill                        = $request->has('skill') ? json_encode($request->skill) : null;
        self::$jobApplication->work_experience              = $request->has('work_experience') ? json_encode($request->work_experience) : null;
        self::$jobApplication->certifications               = $request->has('certifications') ? json_encode($request->certifications) : null;
        self::$jobApplication->job_preference               = $request->has('job_preference') ? json_encode($request->job_preference) : null;

        self::$jobApplication->resume                       = $request->resume ?? null;
        self::$jobApplication->image                       = self::$imageUrl;
        self::$jobApplication->status                      = $request->status ?? 0;
        self::$jobApplication->save();
        return self::$jobApplication;
    }

    public static function deleteJobApplication($id)
    {
        // Find the JobApplication
        self::$jobApplication = JobApplication::findOrFail($id);

        // Delete the JobApplication image if it exists
        if (self::$jobApplication->image && file_exists(public_path(self::$jobApplication->image))) {
            unlink(public_path(self::$jobApplication->image));
        }

        // Finally, delete the JobApplication
        self::$jobApplication->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Alternatively, if you want to keep existing relationships
    public function education()
    {
        return $this->hasMany(UserEducation::class, 'user_id', 'user_id');
    }

    public function skills()
    {
        return $this->hasMany(UserSkill::class, 'user_id', 'user_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(UserWorkExperience::class, 'user_id', 'user_id');
    }

    public function certifications()
    {
        return $this->hasMany(UserCertification::class, 'user_id', 'user_id');
    }

    public function jobPreferences()
    {
        return $this->hasMany(UserJobPreference::class, 'user_id', 'user_id');
    }

    // Mutators and Accessors for JSON fields
    public function getEducationAttribute($value)
    {
        return $this->safeJsonDecode($value);
    }

    public function getSkillAttribute($value)
    {
        return $this->safeJsonDecode($value);
    }

    public function getWorkExperienceAttribute($value)
    {
        return $this->safeJsonDecode($value);
    }

    public function getCertificationsAttribute($value)
    {
        return $this->safeJsonDecode($value);
    }

    public function getJobPreferenceAttribute($value)
    {
        return $this->safeJsonDecode($value);
    }

    // Safe JSON decoding method
    private function safeJsonDecode($json)
    {
        if (is_array($json)) {
            return $json;
        }

        $decoded = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            return [];
        }

        return $decoded;
    }

}
