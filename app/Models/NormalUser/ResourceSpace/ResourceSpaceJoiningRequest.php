<?php

namespace App\Models\NormalUser\ResourceSpace;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceSpaceJoiningRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'resource_space_id','resource_space_creator_id', 'answers', 'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resourceSpace()
    {
        return $this->belongsTo(ResourceSpace::class, 'resource_space_id');
    }

    public function question()
    {
        return $this->belongsTo(ResourceSpaceQuestion::class, 'question_id');
    }
}
