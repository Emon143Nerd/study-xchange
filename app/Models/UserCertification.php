<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCertification extends Model
{
    protected $fillable = [
        'user_id', // Add user_id here
        'certification_name',
        'issuing_organization',
        'issue_date',
        'expiration_date',
        'image',
    ];
    private static $userCertificate, $image, $imageName, $directory, $extension, $imageUrl;

    public static function newUserCertification($request)
    {
        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/UserCertification-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$userCertificate                              = new UserCertification();
        self::$userCertificate->user_id                     = $request['user_id'];
        self::$userCertificate->certification_name          = $request['certification_name'];
        self::$userCertificate->issuing_organization        = $request['issuing_organization'];
        self::$userCertificate->issue_date                  = $request['issue_date'];
        self::$userCertificate->expiration_date             = $request['expiration_date'];
        self::$userCertificate->image                       = self::$imageUrl;
        self::$userCertificate->status                      = $request->status ?? 1;
        self::$userCertificate->save();
        return self::$userCertificate;
    }

    public static function updateUserCertification($request, $id)
    {
        self::$userCertificate = UserCertification::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$userCertificate->image)))
            {
                unlink(self::$userCertificate->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/UserCertification-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$userCertificate->image;
        }
        self::$userCertificate->user_id                     = $request['user_id'];
        self::$userCertificate->certification_name          = $request['certification_name'];
        self::$userCertificate->issuing_organization        = $request['issuing_organization'];
        self::$userCertificate->issue_date                  = $request['issue_date'];
        self::$userCertificate->expiration_date             = $request['expiration_date'];
        self::$userCertificate->image                       = self::$imageUrl;
        self::$userCertificate->status                      = $request->status ?? 1;
        self::$userCertificate->save();
        return self::$userCertificate;
    }

    public static function deleteUserCertification($id)
    {
        // Find the UserCertification
        self::$userCertificate = UserCertification::findOrFail($id);

        // Delete the UserCertification image if it exists
        if (self::$userCertificate->image && file_exists(public_path(self::$userCertificate->image))) {
            unlink(public_path(self::$userCertificate->image));
        }

        // Finally, delete the UserCertification
        self::$userCertificate->delete();
    }
}
