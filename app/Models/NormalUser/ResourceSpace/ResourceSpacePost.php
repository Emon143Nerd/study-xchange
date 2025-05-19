<?php

namespace App\Models\NormalUser\ResourceSpace;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ResourceSpacePost extends Model
{
    private static $resourceSpacePost, $image, $imageName, $directory, $extension, $imageUrl;
    protected $fillable = ['resource_space_id', 'user_id', 'title', 'description', 'image', 'status'];

    public static function newResourceSpacePost($request)
    {
        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/ResourceSpacePost-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$resourceSpacePost                         = new ResourceSpacePost();
        self::$resourceSpacePost->user_id                = $request->user_id;
        self::$resourceSpacePost->resource_space_id      = $request->resource_space_id;
        self::$resourceSpacePost->title                  = $request->title;
        self::$resourceSpacePost->description            = $request->description;
        self::$resourceSpacePost->image                  = self::$imageUrl;
        self::$resourceSpacePost->status                 = $request->status ?? 1;
        self::$resourceSpacePost->save();
        return self::$resourceSpacePost;
    }

    public static function updateResourceSpacePost($request, $id)
    {
        self::$resourceSpacePost = ResourceSpacePost::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$resourceSpacePost->image)))
            {
                unlink(self::$resourceSpacePost->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/ResourceSpacePost-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$resourceSpacePost->image;
        }
        self::$resourceSpacePost->user_id                = $request->user_id;
        self::$resourceSpacePost->resource_space_id      = $request->resource_space_id;
        self::$resourceSpacePost->title                  = $request->title;
        self::$resourceSpacePost->description            = $request->description;
        self::$resourceSpacePost->image                  = self::$imageUrl;
        self::$resourceSpacePost->status                 = $request->status; // Ensure the status is updated here
        self::$resourceSpacePost->save();
        return self::$resourceSpacePost;
    }

    public static function deleteResourceSpacePost($id)
    {
        // Find the ResourceSpacePost
        self::$resourceSpacePost = ResourceSpacePost::findOrFail($id);

        // Delete the ResourceSpacePost image if it exists
        if (self::$resourceSpacePost->image && file_exists(public_path(self::$resourceSpacePost->image))) {
            unlink(public_path(self::$resourceSpacePost->image));
        }

        // Finally, delete the ResourceSpacePost
        self::$resourceSpacePost->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(ResourceSpacePostVote::class);
    }


    public function comments()
    {
        return $this->hasMany(ResourceSpacePostComment::class)->whereNull('parent_id');
    }

    public function resourceSpace()
    {
        return $this->belongsTo(ResourceSpace::class);
    }

}
