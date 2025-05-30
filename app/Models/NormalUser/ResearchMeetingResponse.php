<?php

namespace App\Models\NormalUser;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchMeetingResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'user_id',
        'selected_time',
    ];
//    public static function finalizeMeeting($meetingId)
//    {
//        $meeting = ResearchMeeting::findOrFail($meetingId);
//
//        $teamMembers = ResearchTeamMember::where('research_project_id', $meeting->research_project_id)
//            ->where('status', 2)
//            ->where('email', '!=', User::find(ResearchProject::find($meeting->research_project_id)->created_by)->email)
//            ->get();
//
//        $totalResponses = ResearchMeetingResponse::where('meeting_id', $meeting->id)->count();
//
//        if ($totalResponses >= $teamMembers->count()) {
//            $time1Count = ResearchMeetingResponse::where('meeting_id', $meeting->id)
//                ->where('selected_time', 'time1')
//                ->count();
//            $time2Count = ResearchMeetingResponse::where('meeting_id', $meeting->id)
//                ->where('selected_time', 'time2')
//                ->count();
//            $time3Count = ResearchMeetingResponse::where('meeting_id', $meeting->id)
//                ->where('selected_time', 'time3')
//                ->count();
//
//            $maxVotes = max($time1Count, $time2Count, $time3Count);
//
//            $finalTime = match ($maxVotes) {
//                $time1Count => $meeting->time1,
//                $time2Count => $meeting->time2,
//                default => $meeting->time3,
//            };
//
//            $meeting->update(['final_time' => $finalTime]);
//
//            return true;
//        }
//
//        return false;
//    }

    public static function finalizeMeeting($meetingId)
    {
        $meeting = ResearchMeeting::findOrFail($meetingId);

        // Fetch the creator of the meeting
        $meetingCreatorId = $meeting->created_by;

        // Fetch team members except the project creator
        $teamMembers = ResearchTeamMember::where('research_project_id', $meeting->research_project_id)
            ->where('status', 2)
            ->where('email', '!=', User::find(ResearchProject::find($meeting->research_project_id)->created_by)->email)
            ->get();

        // Count total responses
        $totalResponses = ResearchMeetingResponse::where('meeting_id', $meeting->id)->count();

        if ($totalResponses >= $teamMembers->count()) {
            // Count responses for each time option
            $time1Count = ResearchMeetingResponse::where('meeting_id', $meeting->id)
                ->where('selected_time', 'time1')
                ->count();
            $time2Count = ResearchMeetingResponse::where('meeting_id', $meeting->id)
                ->where('selected_time', 'time2')
                ->count();
            $time3Count = ResearchMeetingResponse::where('meeting_id', $meeting->id)
                ->where('selected_time', 'time3')
                ->count();

            // Get the maximum votes and check for tie
            $votes = [
                'time1' => $time1Count,
                'time2' => $time2Count,
                'time3' => $time3Count,
            ];
            $maxVotes = max($votes);

            // Find the times with the maximum votes
            $timesWithMaxVotes = array_keys($votes, $maxVotes);

            // If there's a tie, finalize based on the meeting creator's preference
            if (count($timesWithMaxVotes) > 1) {
                $finalTimeKey = null;

                // Check which time the meeting creator selected
                $creatorResponse = ResearchMeetingResponse::where('meeting_id', $meeting->id)
                    ->where('user_id', $meetingCreatorId)
                    ->first();

                if ($creatorResponse) {
                    $finalTimeKey = $creatorResponse->selected_time;
                } else {
                    // Default to the first time in case the creator hasn't responded
                    $finalTimeKey = $timesWithMaxVotes[0];
                }

                $finalTime = $meeting->$finalTimeKey;
            } else {
                // No tie, finalize with the time having the most votes
                $finalTimeKey = array_search($maxVotes, $votes);
                $finalTime = $meeting->$finalTimeKey;
            }

            // Update the meeting with the finalized time
            $meeting->update(['final_time' => $finalTime]);

            return true;
        }

        return false;
    }


    public function meeting()
    {
        return $this->belongsTo(ResearchMeeting::class, 'meeting_id');
    }
}
