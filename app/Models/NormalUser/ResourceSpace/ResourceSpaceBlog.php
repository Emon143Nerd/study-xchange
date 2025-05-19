<?php

namespace App\Models\NormalUser\ResourceSpace;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ResourceSpaceBlog extends Model
{
    private static $resourceSpaceBlog, $image, $imageName, $directory, $extension, $imageUrl;
    protected $fillable = ['resource_space_id', 'user_id', 'title', 'description', 'image', 'status','hit_count'];

    public static function newResourceSpaceBlog($request)
    {
        // Check if an image is provided
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time() . '.' . self::$extension;
            self::$directory = 'upload/ResourceSpaceBlog-image/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
        } else {
            // If no image is provided, set a default image or null
            self::$imageUrl = null;
        }

        self::$resourceSpaceBlog                         = new ResourceSpaceBlog();
        self::$resourceSpaceBlog->user_id                = $request->user_id;
        self::$resourceSpaceBlog->resource_space_id      = $request->resource_space_id;
        self::$resourceSpaceBlog->title                  = $request->title;
        self::$resourceSpaceBlog->description            = $request->description;
        self::$resourceSpaceBlog->image                  = self::$imageUrl;
        self::$resourceSpaceBlog->status                 = $request->status ?? 1;
        self::$resourceSpaceBlog->hit_count              = 0;
        self::$resourceSpaceBlog->save();
        return self::$resourceSpaceBlog;
    }

    public static function updateResourceSpaceBlog($request, $id)
    {
        self::$resourceSpaceBlog = ResourceSpaceBlog::find($id);
        if(self::$image = $request->file('image'))
        {
            if(file_exists((self::$resourceSpaceBlog->image)))
            {
                unlink(self::$resourceSpaceBlog->image);
            }
            self::$extension = self::$image->getClientOriginalExtension();
            self::$imageName = time().'.'.self::$extension;
            self::$directory = 'upload/ResourceSpaceBlog-image/';
            self::$image->move(self::$directory,self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
        }
        else
        {
            self::$imageUrl = self::$resourceSpaceBlog->image;
        }
        self::$resourceSpaceBlog->user_id                = $request->user_id;
        self::$resourceSpaceBlog->resource_space_id      = $request->resource_space_id;
        self::$resourceSpaceBlog->title                  = $request->title;
        self::$resourceSpaceBlog->description            = $request->description;
        self::$resourceSpaceBlog->image                  = self::$imageUrl;
        self::$resourceSpaceBlog->status                 = $request->status; // Ensure the status is updated here
//        self::$resourceSpaceBlog->hit_count              = $request->hit_count;
        self::$resourceSpaceBlog->save();
        return self::$resourceSpaceBlog;
    }

    public static function deleteResourceSpaceBlog($id)
    {
        // Find the ResourceSpaceBlog
        self::$resourceSpaceBlog = ResourceSpaceBlog::findOrFail($id);

        // Delete the ResourceSpaceBlog image if it exists
        if (self::$resourceSpaceBlog->image && file_exists(public_path(self::$resourceSpaceBlog->image))) {
            unlink(public_path(self::$resourceSpaceBlog->image));
        }

        // Finally, delete the ResourceSpaceBlog
        self::$resourceSpaceBlog->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function resourceSpace()
    {
        return $this->belongsTo(ResourceSpace::class);
    }
}
