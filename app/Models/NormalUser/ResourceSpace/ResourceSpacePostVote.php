<?php

namespace App\Models\NormalUser\ResourceSpace;

use Illuminate\Database\Eloquent\Model;

class ResourceSpacePostVote extends Model
{
    protected $fillable = ['user_id', 'resource_space_post_id', 'vote_type'];

    public function post()
    {
        return $this->belongsTo(ResourceSpacePost::class, 'resource_space_post_id');
    }

}
