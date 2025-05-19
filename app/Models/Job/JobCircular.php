<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;

class JobCircular extends Model
{
    private static $jobCircular, $image, $imageName, $directory, $extension, $imageUrl;
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'requirement',
        'responsibilities',
        'type',
        'location',
        'salary_range',
        'application_deadline',
        'image',
        'status'
    ];
    public static function newJobCircular($request)
    {
        $applicationDeadline = \Carbon\Carbon::parse($request->application_deadline);

        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/JobCircular-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$jobCircular                              = new JobCircular();
        self::$jobCircular->company_id                  = $request->company_id;
        self::$jobCircular->title                       = $request->title;
        self::$jobCircular->description                 = $request->description;
        self::$jobCircular->requirement                 = $request->requirement;
        self::$jobCircular->responsibilities            = $request->responsibilities;
        self::$jobCircular->type                        = $request->type;
        self::$jobCircular->location                    = $request->location;
        self::$jobCircular->salary_range                = $request->salary_range;
        self::$jobCircular->application_deadline        = $request->application_deadline;
        self::$jobCircular->image                       = self::$imageUrl;
        self::$jobCircular->status                      = $request->status ?? 1;
        self::$jobCircular->save();
        return self::$jobCircular;
    }

    public static function updateJobCircular($request, $id)
    {
        self::$jobCircular = JobCircular::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$jobCircular->image)))
            {
                unlink(self::$jobCircular->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/JobCircular-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$jobCircular->image;
        }
        self::$jobCircular->company_id                  = $request->company_id;
        self::$jobCircular->title                       = $request->title;
        self::$jobCircular->description                 = $request->description;
        self::$jobCircular->requirement                 = $request->requirement;
        self::$jobCircular->responsibilities            = $request->responsibilities;
        self::$jobCircular->type                        = $request->type;
        self::$jobCircular->location                    = $request->location;
        self::$jobCircular->salary_range                = $request->salary_range;
        self::$jobCircular->application_deadline        = $request->application_deadline;
        self::$jobCircular->image                       = self::$imageUrl;
        self::$jobCircular->status                      = $request->status ?? 1;
        self::$jobCircular->save();
        return self::$jobCircular;
    }

    public static function deleteJobCircular($id)
    {
        // Find the JobCircular
        self::$jobCircular = JobCircular::findOrFail($id);

        // Delete the JobCircular image if it exists
        if (self::$jobCircular->image && file_exists(public_path(self::$jobCircular->image))) {
            unlink(public_path(self::$jobCircular->image));
        }

        // Finally, delete the JobCircular
        self::$jobCircular->delete();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobApplication()
    {
        return $this->hasMany(JobApplication::class);
    }
}
