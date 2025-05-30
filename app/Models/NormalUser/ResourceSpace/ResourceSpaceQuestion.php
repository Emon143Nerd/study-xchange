<?php

namespace App\Models\NormalUser\ResourceSpace;

use Illuminate\Database\Eloquent\Model;

class ResourceSpaceQuestion extends Model
{
    protected $fillable = ['resource_space_id', 'question'];


    public function resourceSpace()
    {
        return $this->belongsTo(ResourceSpace::class);
    }

    public function responses()
    {
        return $this->hasMany(ResourceSpaceJoiningRequest::class, 'question_id');
    }

}
