<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\ResearchMeeting;
use App\Models\NormalUser\ResearchMeetingResponse;
use App\Models\NormalUser\ResearchProject;
use App\Models\NormalUser\ResearchTeamMember;
use App\Models\User;
use App\Notifications\MeetingCreatedNotification;
use Illuminate\Http\Request;

class ResearchProjectMeetingController extends Controller
{
//    public function createMeeting(Request $request, $projectId)
//    {
//        $project = ResearchProject::findOrFail($projectId);
//
//        // Validate input
//        $request->validate([
//            'time1' => 'required|date|after:now',
//            'time2' => 'required|date|after:now',
//            'time3' => 'required|date|after:now',
//            'title' => 'required|string|max:255',
//            'meeting_link' => 'nullable|url',
//        ]);
//
//        // Check if a meeting already exists and isn't expired
//        $existingMeeting = ResearchMeeting::where('research_project_id', $project->id)
//            ->whereNull('final_time')
//            ->orWhere('final_time', '>', now())
//            ->first();
//
//        if ($existingMeeting) {
//            return back()->with('error', 'You cannot create a new meeting until the current meeting is finalized or expired.');
//        }
//
//        // Create the meeting
//        $meeting = ResearchMeeting::create([
//            'research_project_id' => $project->id,
//            'created_by' => auth()->id(),
//            'time1' => $request->time1,
//            'time2' => $request->time2,
//            'time3' => $request->time3,
//            'title' => $request->title,
//            'meeting_link' => $request->meeting_link,
//        ]);
//
////        // Notify team members
////        foreach ($project->teamMembers as $member) {
////            $member->notify(new MeetingCreatedNotification($meeting));
////        }
//
//        return back()->with('message', 'Meeting created successfully.');
//    }


    public function createMeeting(Request $request, $projectId)
    {
        \Log::info('Meeting creation attempted', $request->all());  // Add this line for debugging

        try {
            $project = ResearchProject::findOrFail($projectId);

            // Validate input
            $validated = $request->validate([
                'time1' => 'required|date|after:now',
                'time2' => 'required|date|after:now',
                'time3' => 'required|date|after:now',
                'title' => 'required|string|max:255',
                'meeting_link' => 'nullable|url',
            ]);

            // Check if a meeting already exists and isn't expired
            $existingMeeting = ResearchMeeting::where('research_project_id', $project->id)
                ->where(function($query) {
                    $query->whereNull('final_time')
                        ->orWhere('final_time', '>', now());
                })
                ->first();

            if ($existingMeeting) {
                \Log::warning('Attempted to create meeting while one exists', ['existing_meeting' => $existingMeeting]);
                return back()->with('error', 'You cannot create a new meeting until the current meeting is finalized or expired.');
            }

            // Create the meeting
            $meeting = ResearchMeeting::create([
                'research_project_id' => $project->id,
                'created_by' => auth()->id(),
                'time1' => $request->time1,
                'time2' => $request->time2,
                'time3' => $request->time3,
                'title' => $request->title,
                'meeting_link' => $request->meeting_link,
            ]);

            \Log::info('Meeting created successfully', ['meeting' => $meeting]);
            return back()->with('message', 'Meeting created successfully.');

        } catch (\Exception $e) {
            \Log::error('Error creating meeting', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An error occurred while creating the meeting. Please try again.');
        }
    }

    public function respondToMeeting(Request $request, $meetingId)
    {
        $meeting = ResearchMeeting::findOrFail($meetingId);

        // Check if the user has already responded
        $existingResponse = ResearchMeetingResponse::where('meeting_id', $meeting->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingResponse) {
            // If the user has already responded, prevent them from selecting again
            return redirect()->route('some.route')->with('error', 'You have already responded to this meeting.');
        }

        // Validate the selected time
        $request->validate([
            'selected_time' => 'required|in:time1,time2,time3',
        ]);

        // Save the user's response in the database
        ResearchMeetingResponse::create([
            'meeting_id' => $meeting->id,
            'user_id' => auth()->id(),
            'selected_time' => $request->selected_time,
            'responded' => true
        ]);

        // Redirect back with success message
        return back()->with('message', 'Your response has been recorded.');
    }



    public function deleteMeeting($meetingId)
    {
        $meeting = ResearchMeeting::findOrFail($meetingId);

        // Ensure only the project creator can delete the meeting
        if ($meeting->created_by != auth()->id()) {
            return back()->with('error', 'You are not authorized to delete this meeting.');
        }

        $meeting->delete();

//        // Notify team members about the deletion
//        foreach ($meeting->researchProject->teamMembers as $member) {
//            $member->notify(new MeetingDeletedNotification($meeting));
//        }

        return back()->with('message', 'Meeting deleted successfully.');
    }



}
