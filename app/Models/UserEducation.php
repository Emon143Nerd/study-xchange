<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserEducation extends Model
{
    protected $fillable = [
        'user_id', // Add user_id here
        'institution_name',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'grade',
        'description',
    ];
    private static $userEducation;

    public static function newUserEducation($request)
    {
        self::$userEducation = new UserEducation();
        return self::UserEducationInfo(self::$userEducation, $request);
    }

    public static function updateUserEducation($request, $id)
    {
        self::$userEducation = UserEducation::where('id', $id)->first();
        self::UserEducationInfo(self::$userEducation, $request);
    }

    public static function deleteUserEducation($id)
    {
        self::$userEducation = UserEducation::where('id', $id)->first();
        self::$userEducation->delete();
    }

    public static function UserEducationInfo($userEducation, $request)
    {
        self::$userEducation->user_id               = $request['user_id']; // Use array syntax
        self::$userEducation->institution_name      = $request['institution_name'];
        self::$userEducation->degree                = $request['degree'];
        self::$userEducation->field_of_study        = $request['field_of_study'];
        self::$userEducation->start_date            = $request['start_date'];
        self::$userEducation->end_date              = $request['end_date'];
        self::$userEducation->grade                 = $request['grade'];
        self::$userEducation->description           = $request['description'];
        self::$userEducation->status                = 1;
        self::$userEducation->save();

        return self::$userEducation;
    }

}
