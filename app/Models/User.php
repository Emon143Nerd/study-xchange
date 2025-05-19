<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Job\Company;
use App\Models\NormalUser\ResearchProject;
use App\Models\NormalUser\ResourceSpace\ResourceSpaceJoiningRequest;
use App\Models\University\University;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    private static $user, $image, $extension, $imageName, $directory, $imageUrl;

    private static function getImageUrl($image)
    {
        self::$extension    = $image->getClientOriginalExtension();
        self::$imageName    = time().'.'.self::$extension;
        self::$directory    = 'user/category-image/';
        $image->move(self::$directory, self::$imageName);
        self::$imageUrl     = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function updateUser($request, $id)
    {
        self::$user = User::find($id);
        if (self::$image = $request->file('image'))
        {
            self::deleteImageFromFolder(self::$user->image);
            self::$imageUrl = self::getImageUrl($request->file('image'));
        }
        else
        {
            self::$imageUrl = self::$user->image;
        }
        self::updateUserInfo(self::$user, $request, self::$imageUrl);
    }

    private static function deleteImageFromFolder($imageUrl)
    {
        if (file_exists($imageUrl))
        {
            unlink($imageUrl);
        }
    }

    private static function updateUserInfo($user, $request, $imageUrl)
    {
        $user->name               = $request->name;
        $user->email              = $request->email;
        $user->gender             = $request->gender;
        $user->date_of_birth      = $request->date_of_birth;
        $user->location           = $request->location;
        // Only update password if a new one is provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->image              = $imageUrl;
        $user->save();
    }

    public function university()
    {
        return $this->hasOne(University::class, 'user_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function educations()
    {
        return $this->hasMany(UserEducation::class);
    }


    public function skills() {
        return $this->hasMany(UserSkill::class);
    }

    public function workExperiences() {
        return $this->hasMany(UserWorkExperience::class);
    }

    public function certifications() {
        return $this->hasMany(UserCertification::class);
    }

    public function jobPreferences()
    {
        return $this->hasMany(UserJobPreference::class); // Adjust according to your model's actual name
    }

    public function resourceSpaceJoinRequests()
    {
        return $this->hasMany(ResourceSpaceJoiningRequest::class);
    }

    public function education()
    {
        return $this->hasMany(UserEducation::class, 'user_id');
    }


}
