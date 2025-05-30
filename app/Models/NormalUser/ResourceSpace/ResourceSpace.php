<?php

namespace App\Models\NormalUser\ResourceSpace;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ResourceSpace extends Model
{
    private static $resourceSpace, $image, $imageName, $directory, $extension, $imageUrl;
    protected $fillable = ['user_id', 'name', 'description', 'type', 'image', 'status'];


    public static function newResourceSpace($request)
    {
        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/ResourceSpace-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$resourceSpace                         = new ResourceSpace();
        self::$resourceSpace->user_id                = $request->user_id;
        self::$resourceSpace->name                   = $request->name;
        self::$resourceSpace->description            = $request->description;
        self::$resourceSpace->type                   = $request->type;
        self::$resourceSpace->image                  = self::$imageUrl;
        self::$resourceSpace->status                 = 1;
        self::$resourceSpace->save();

        // Automatically add the creator as a member
        ResourceSpaceUser::create([
            'resource_space_id' => self::$resourceSpace->id,
            'user_id' => $request->user_id,
        ]);

        return self::$resourceSpace;
    }

    public static function updateResourceSpace($request, $id)
    {
        self::$resourceSpace = ResourceSpace::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$resourceSpace->image)))
            {
                unlink(self::$resourceSpace->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/ResourceSpace-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$resourceSpace->image;
        }
        self::$resourceSpace->user_id                = $request->user_id;
        self::$resourceSpace->name                   = $request->name;
        self::$resourceSpace->description            = $request->description;
        self::$resourceSpace->type                   = $request->type;
        self::$resourceSpace->image                  = self::$imageUrl;
        self::$resourceSpace->status                 = $request->status ?? 1;
        self::$resourceSpace->save();
        return self::$resourceSpace;
    }

    public static function deleteResourceSpace($id)
    {
        // Find the ResourceSpace
        self::$resourceSpace = ResourceSpace::findOrFail($id);

        // Delete the ResourceSpace image if it exists
        if (self::$resourceSpace->image && file_exists(public_path(self::$resourceSpace->image))) {
            unlink(public_path(self::$resourceSpace->image));
        }

        // Finally, delete the ResourceSpace
        self::$resourceSpace->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(ResourceSpaceQuestion::class);
    }

    public function joiningRequests()
    {
        return $this->hasMany(ResourceSpaceJoiningRequest::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resourceSpaceUsers()
    {
        return $this->hasMany(ResourceSpaceUser::class, 'resource_space_id');
    }

    public function posts()
    {
        return $this->hasMany(ResourceSpacePost::class);
    }


    public function users()
    {
        return $this->hasMany(ResourceSpaceUser::class, 'resource_space_id');
    }


}
