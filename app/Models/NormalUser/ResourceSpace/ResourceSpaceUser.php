<?php

namespace App\Models\NormalUser\ResourceSpace;

use Illuminate\Database\Eloquent\Model;

class ResourceSpaceUser extends Model
{
    protected $fillable = [
        'user_id',
        'resource_space_id',
    ];
}
