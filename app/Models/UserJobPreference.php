<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJobPreference extends Model
{
    protected $fillable = [
        'user_id', // Add user_id here
        'preferred_location',
        'preferred_industry',
        'preferred_job_type',
        'salary_expectation',
    ];
    private static $userJobPreference;

    public static function UserWorkExperience($request)
    {
        self::$userJobPreference = new UserJobPreference();
        return self::UserJobPreferenceInfo(self::$userJobPreference, $request);
    }

    public static function updateUserJobPreference($request, $id)
    {
        self::$userJobPreference = UserJobPreference::where('id', $id)->first();
        self::UserJobPreferenceInfo(self::$userJobPreference, $request);
    }

    public static function deleteUserJobPreference($id)
    {
        self::$userJobPreference = UserJobPreference::where('id', $id)->first();
        self::$userJobPreference->delete();
    }

    public static function UserJobPreferenceInfo($userJobPreference, $request)
    {
        self::$userJobPreference->user_id                   = $request['user_id']; // Use array syntax
        self::$userJobPreference->preferred_location        = $request['preferred_location'];
        self::$userJobPreference->preferred_industry        = $request['preferred_industry'];
        self::$userJobPreference->preferred_job_type        = $request['preferred_job_type'];
        self::$userJobPreference->salary_expectation        = $request['salary_expectation'];
        self::$userJobPreference->status                    = 1;
        self::$userJobPreference->save();

        return self::$userJobPreference;
    }
}
