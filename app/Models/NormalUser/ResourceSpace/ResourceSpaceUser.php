<?php

namespace App\Models\NormalUser\ResourceSpace;

use Illuminate\Database\Eloquent\Model;

class ResourceSpaceUser extends Model
{
    protected $fillable = [
        'user_id',            // Add this line
        'resource_space_id',  // Keep other attributes as needed
    ];
}
