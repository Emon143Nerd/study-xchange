<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWorkExperience extends Model
{
    protected $fillable = [
        'user_id', // Add user_id here
        'company_name',
        'job_title',
        'start_date',
        'end_date',
        'description',
    ];
    private static $userWorkExperience;

    public static function UserWorkExperience($request)
    {
        self::$userWorkExperience = new UserSkill();
        return self::UserSkillInfo(self::$userWorkExperience, $request);
    }

    public static function updateUserSkill($request, $id)
    {
        self::$userWorkExperience = UserSkill::where('id', $id)->first();
        self::UserSkillInfo(self::$userWorkExperience, $request);
    }

    public static function deleteUserSkill($id)
    {
        self::$userWorkExperience = UserSkill::where('id', $id)->first();
        self::$userWorkExperience->delete();
    }

    public static function UserSkillInfo($userWorkExperience, $request)
    {
        self::$userWorkExperience->user_id                  = $request['user_id']; // Use array syntax
        self::$userWorkExperience->company_name             = $request['company_name'];
        self::$userWorkExperience->job_title                = $request['job_title'];
        self::$userWorkExperience->start_date               = $request['start_date'];
        self::$userWorkExperience->proficiency_level        = $request['proficiency_level'];
        self::$userWorkExperience->end_date                 = $request['end_date'];
        self::$userWorkExperience->description              = $request['description'];
        self::$userWorkExperience->status                   = 1;
        self::$userWorkExperience->save();

        return self::$userWorkExperience;
    }
}
