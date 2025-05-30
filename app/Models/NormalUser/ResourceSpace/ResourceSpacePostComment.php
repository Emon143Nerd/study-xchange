<?php

namespace App\Models\NormalUser\ResourceSpace;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ResourceSpacePostComment extends Model
{
    protected $fillable = ['user_id', 'resource_space_post_id', 'comment', 'parent_id', 'status'];
    private static $resourceSpacePostComment;


    public static function newResourceSpacePostComment($request)
    {
        self::$resourceSpacePostComment = new ResourceSpacePostComment();
        return self::ResourceSpacePostCommentInfo(self::$resourceSpacePostComment, $request);
    }

    public static function updateResourceSpacePostComment($request, $id)
    {
        self::$resourceSpacePostComment = ResourceSpacePostComment::where('id', $id)->first();
        if (self::$resourceSpacePostComment) {
            return self::ResourceSpacePostCommentInfo(self::$resourceSpacePostComment, $request);
        }
        return null;
    }

    public static function deleteResourceSpacePostComment($id)
    {
        self::$resourceSpacePostComment = ResourceSpacePostComment::where('id', $id)->first();
        if (self::$resourceSpacePostComment) {
            self::$resourceSpacePostComment->delete();
        }
    }

    public static function ResourceSpacePostCommentInfo($resourceSpacePostComment, $request)
    {
        self::$resourceSpacePostComment->user_id                        = $request->user_id ?? auth()->id();
        self::$resourceSpacePostComment->resource_space_post_id         = $request->resource_space_post_id;
        self::$resourceSpacePostComment->comment                        = $request->comment;
        self::$resourceSpacePostComment->parent_id                      = $request->parent_id ?? null;
        self::$resourceSpacePostComment->status                         = $request->status ?? 1;
        self::$resourceSpacePostComment->save();
        return self::$resourceSpacePostComment;
    }

    // Relationship to the post
    public function post()
    {
        return $this->belongsTo(ResourceSpacePost::class, 'resource_space_post_id');
    }

    // Relationship to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Recursive relationship for nested comments
    public function replies()
    {
        return $this->hasMany(ResourceSpacePostComment::class, 'parent_id')->with('replies');
    }

    // Get the parent comment (if exists)
    public function parent()
    {
        return $this->belongsTo(ResourceSpacePostComment::class, 'parent_id');
    }
}
