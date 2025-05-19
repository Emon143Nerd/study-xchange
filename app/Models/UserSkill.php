<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $fillable = [
        'user_id', // Add user_id here
        'skill_name',
        'proficiency_level',
    ];
    private static $userSkill;

    public static function newUserSkill($request)
    {
        self::$userSkill = new UserSkill();
        return self::UserSkillInfo(self::$userSkill, $request);
    }

    public static function updateUserSkill($request, $id)
    {
        self::$userSkill = UserSkill::where('id', $id)->first();
        self::UserSkillInfo(self::$userSkill, $request);
    }

    public static function deleteUserSkill($id)
    {
        self::$userSkill = UserSkill::where('id', $id)->first();
        self::$userSkill->delete();
    }

    public static function UserSkillInfo($userSkill, $request)
    {
        self::$userSkill->user_id               = $request['user_id']; // Use array syntax
        self::$userSkill->skill_name            = $request['skill_name'];
        self::$userSkill->proficiency_level     = $request['proficiency_level'];
        self::$userSkill->status                = 1;
        self::$userSkill->save();

        return self::$userSkill;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills', 'skill_id', 'user_id');
    }


}
