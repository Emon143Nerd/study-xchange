<?php

namespace App\Models\NormalUser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'created_by',
        'title',
        'meeting_link',
        'time1',
        'time2',
        'time3',
        'final_time',
    ];

    public function responses()
    {
        return $this->hasMany(ResearchMeetingResponse::class, 'meeting_id');
    }

    public function isExpired()
    {
        return $this->final_time && now()->greaterThan(\Carbon\Carbon::parse($this->final_time)->addHours(2));
    }
}
