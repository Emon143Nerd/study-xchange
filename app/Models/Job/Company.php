<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    private static $company, $image, $imageName, $directory, $extension, $imageUrl;
    protected $fillable = ['user_id', 'name', 'industry', 'location', 'about', 'image', 'status'];

    public static function newCompany($request)
    {
        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/Company-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$company                         = new Company();
        self::$company->user_id                = $request->user_id;
        self::$company->name                   = $request->name;
        self::$company->industry               = $request->industry;
        self::$company->location               = $request->location;
        self::$company->about                  = $request->about;
        self::$company->image                  = self::$imageUrl;
        self::$company->status                 = $request->status ?? 1;
        self::$company->save();
        return self::$company;
    }

    public static function updateCompany($request, $id)
    {
        self::$company = Company::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$company->image)))
            {
                unlink(self::$company->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/Company-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$company->image;
        }
        self::$company->user_id                = $request->user_id;
        self::$company->name                   = $request->name;
        self::$company->industry               = $request->industry;
        self::$company->location               = $request->location;
        self::$company->about                  = $request->about;
        self::$company->image                  = self::$imageUrl;
        self::$company->status                 = $request->status ?? 1;
        self::$company->save();
        return self::$company;
    }

    public static function deleteCompany($id)
    {
        // Find the Company
        self::$company = Company::findOrFail($id);

        // Delete the Company image if it exists
        if (self::$company->image && file_exists(public_path(self::$company->image))) {
            unlink(public_path(self::$company->image));
        }

        // Finally, delete the Company
        self::$company->delete();
    }
}
