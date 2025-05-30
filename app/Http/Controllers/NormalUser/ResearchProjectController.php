<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\ResearchMeeting;
use App\Models\NormalUser\ResearchMeetingResponse;
use App\Models\NormalUser\ResearchProject;
use App\Models\NormalUser\ResearchProjectRequest;
use App\Models\NormalUser\ResearchTeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\NormalUser\ResearchTask;




class ResearchProjectController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $userEmail = auth()->user()->email;

        // Fetch all related projects (created by user or as team member excluding status 3)
        $researchProjects = ResearchProject::where('created_by', $userId)
            ->orWhereHas('teamMembers', function ($query) use ($userEmail) {
                $query->where('email', $userEmail)->where('status', '!=', 3);
            })
            ->with(['teamMembers', 'tasks'])
            ->get();

        // Count based on the criteria
        $totalProjects = $researchProjects->count();
        $pendingProjects = $researchProjects->where('status', 1)->count();

        $ongoingProjects = $researchProjects->filter(function ($project) {
            return $project->status == 2 && $project->tasks->whereIn('status', [1, 2])->isNotEmpty();
        })->count();

        $completedProjects = $researchProjects->filter(function ($project) {
            return $project->status == 3 && $project->tasks->isNotEmpty() && $project->tasks->every(function ($task) {
                    return $task->status == 3;
                });
        })->count();


        return view('normal-user.research-collaboration.project.index', compact('researchProjects','totalProjects', 'pendingProjects', 'ongoingProjects', 'completedProjects'));
    }



    public function detail($id)
    {
        // Fetch the research project with its related tasks and team members
        $researchProject = ResearchProject::with('tasks', 'teamMembers.user')->findOrFail($id);

        // Get all team members related to the research project
        $teamMembers = ResearchTeamMember::where('research_project_id', $id)
            ->where('status', 2) // Only accepted members
            ->get();

        // Prepare events for the calendar
        $events = $researchProject->tasks->map(function ($task) {
            return [
                'title' => $task->title,
                'start' => $task->due_date,
                'url' => route('normal-user.research-task.detail', ['id' => $task->id]),
            ];
        });

        // Fetch the meeting
        $meeting = ResearchMeeting::where('research_project_id', $researchProject->id)->first();

        $hasResponded = false;
        $selectedTime = null;
        $responseCounts = [];
        $allMembersResponded = false;

        if ($meeting) {
            // Check if current user has responded
            $hasResponded = ResearchMeetingResponse::where('meeting_id', $meeting->id)
                ->where('user_id', auth()->id())
                ->exists();

            // Get selected time for current user
            if ($hasResponded) {
                $response = ResearchMeetingResponse::where('meeting_id', $meeting->id)
                    ->where('user_id', auth()->id())
                    ->first();

                $selectedTimeKey = $response->selected_time;
                if ($selectedTimeKey) {
                    $selectedTime = \Carbon\Carbon::parse($meeting->$selectedTimeKey)->format('M d, Y h:i A');
                }
            }

            // Calculate response counts
            $responseCounts = [
                'time1' => ResearchMeetingResponse::where('meeting_id', $meeting->id)->where('selected_time', 'time1')->count(),
                'time2' => ResearchMeetingResponse::where('meeting_id', $meeting->id)->where('selected_time', 'time2')->count(),
                'time3' => ResearchMeetingResponse::where('meeting_id', $meeting->id)->where('selected_time', 'time3')->count(),
            ];

            // Count all team members associated with the project
            $teamMemberCount = $teamMembers->count(); // Include all team members, including the creator
            // Count the responses received for the meeting
            $responseCount = ResearchMeetingResponse::where('meeting_id', $meeting->id)->count();
            // Check if all members have responded
            $allMembersResponded = ($responseCount >= $teamMemberCount);


            // If all members have responded and meeting isn't finalized yet, finalize it

            if ($allMembersResponded && !$meeting->final_time) {
                ResearchMeetingResponse::finalizeMeeting($meeting->id);
            }
        }

        return view('normal-user.research-collaboration.project.detail', compact(
            'researchProject',
            'teamMembers',
            'events',
            'meeting',
            'hasResponded',
            'selectedTime',
            'responseCounts',
            'allMembersResponded'
        ));
    }






    public function create()
    {
        $researchProject = new ResearchProject(); // Empty instance
        return view('normal-user.research-collaboration.project.add', compact('researchProject'));
    }



    public function store(Request $request)
    {
        // Custom error messages
        $messages = [
            'research_team_members.required' => 'At least one team member is required.',
            'research_team_members.*.exists' => 'The email :input does not belong to any registered user.',
            'title.required' => 'The project title is required.',
            'department.required' => 'The department is required.',
            'objective.required' => 'The project objective is required.',
            'timeline_from.required' => 'The start date is required.',
            'timeline_to.required' => 'The end date is required.',
            'timeline_to.after_or_equal' => 'The end date must be after or equal to the start date.',
            'research_team_members.*.email' => 'Each team member must have a valid email.',
            'attachment.mimes' => 'The attachment must be a file of type: pdf, jpg, jpeg, png.',
        ];

        // Validate inputs
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'objective' => 'required|string|max:255',
                'timeline_from' => 'required|date_format:d-m-Y',
                'timeline_to' => 'required|date_format:d-m-Y|after_or_equal:timeline_from',
                'research_team_members' => 'required|array|min:1', // Ensure at least one team member is provided
                'research_team_members.*' => 'email|exists:users,email', // Ensure email exists
                'description' => 'nullable|string',
                'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Adjust file types if needed
                'status' => 'required|in:1,2,3', // Ensure status is provided and valid
            ],
            $messages
        );


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Convert dates to MySQL format
        $request->merge([
            'timeline_from' => Carbon::createFromFormat('d-m-Y', $request->timeline_from)->format('Y-m-d'),
            'timeline_to' => Carbon::createFromFormat('d-m-Y', $request->timeline_to)->format('Y-m-d'),
            'status' => $request->status ?? 1, // Default to "Pending" if not provided
        ]);

        // Create the new project
        $researchProject = ResearchProject::newResearchProject($request);

        // Pass the authenticated user ID to the ResearchProjectRequest method
        foreach ($request->research_team_members as $email) {
            $user = User::where('email', $email)->first(); // Get the user by email

            if ($user) {
                // Create a request for each team member
                ResearchProjectRequest::newResearchProjectRequest($user->id, $researchProject->id);
            }
        }

        // Add team members (this method no longer creates a duplicate request)
        ResearchTeamMember::newResearchTeamMember($request, $researchProject->id);

        return redirect('/research/project/list')->with('message', 'New project created successfully');
    }


    public function respondToRequest(Request $request, $id)
    {
        $projectRequest = ResearchProjectRequest::find($id);

        if (!$projectRequest || $projectRequest->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        $status = $request->input('status'); // 2 = Accepted, 3 = Rejected

        // Update project request status
        $projectRequest->update(['status' => $status]);

        // Fetch the team member record
        $teamMember = ResearchTeamMember::where('research_project_id', $projectRequest->research_project_id)
            ->where('email', auth()->user()->email)
            ->first();

        if (!$teamMember) {
            // Log or notify if the team member is not found
            \Log::error('Team member not found for project', [
                'research_project_id' => $projectRequest->research_project_id,
                'user_email' => auth()->user()->email,
            ]);
            return redirect()->back()->with('error', 'Team member record not found.');
        }

        // Update the team member's status
        $teamMember->update(['status' => $status]);

        return redirect()->back()->with('message', $status == 2 ? 'Request accepted.' : 'Request rejected.');
    }


    public function edit($id)
    {
        $researchProject = ResearchProject::with('teamMembers.user')->findOrFail($id);
        $users = User::where('role', 3)->get(); // Fetch all normal users if needed for team selection
        return view('normal-user.research-collaboration.project.edit', compact('researchProject', 'users'));
    }


    public function update(Request $request, $id)
    {
        // Fetch the project for validation
        $project = ResearchProject::where('id', $id)->firstOrFail();

        $messages = [
            'title.required' => 'The project title is required.',
            'department.required' => 'The department is required.',
            'objective.required' => 'The project objective is required.',
            'timeline_from.required' => 'The start date is required.',
            'timeline_to.required' => 'The end date is required.',
            'timeline_to.after_or_equal' => 'The end date must be after or equal to the start date.',
            'research_team_members.required' => 'At least one team member is required.',
            'research_team_members.*.exists' => 'The email :input does not belong to any registered user.',
            'research_team_members.*.email' => 'Each team member must have a valid email address.',
        ];

        // Validate inputs
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'objective' => 'required|string|max:255',
                'timeline_from' => 'required|date_format:d-m-Y',
                'timeline_to' => 'required|date_format:d-m-Y|after_or_equal:timeline_from',
                'research_team_members' => 'required|array|min:1', // Ensure at least one team member is provided
                'research_team_members.*' => 'email|exists:users,email', // Ensure email exists
                'description' => 'nullable|string',
                'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ],
            $messages
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Convert dates to MySQL format
        $request->merge([
            'timeline_from' => Carbon::createFromFormat('d-m-Y', $request->timeline_from)->format('Y-m-d'),
            'timeline_to' => Carbon::createFromFormat('d-m-Y', $request->timeline_to)->format('Y-m-d'),
        ]);

        // Update project details using model method
        ResearchProject::updateResearchProject($request, $id);

        // Get current team members' emails
        $currentTeamMembers = ResearchTeamMember::where('research_project_id', $project->id)
            ->pluck('email')
            ->toArray();

        // New team members from the form
        $newTeamMembers = $request->research_team_members ?? [];

        // Determine members to add and remove
        $membersToAdd = array_diff($newTeamMembers, $currentTeamMembers);
        $membersToRemove = array_diff($currentTeamMembers, $newTeamMembers);

        // Add new team members
        foreach ($membersToAdd as $email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                // Create a new project request for new members
                ResearchProjectRequest::newResearchProjectRequest($user->id, $project->id);

                // Add the new team member
                ResearchTeamMember::create([
                    'research_project_id' => $project->id,
                    'email' => $email,
                    'status' => 1, // Default status for a new member
                ]);
            }
        }

        // Remove team members and their associated project requests
        foreach ($membersToRemove as $email) {
            // Fetch the user by email
            $user = User::where('email', $email)->first();

            if ($user) {
                // Delete project request for the removed team member
                ResearchProjectRequest::where('user_id', $user->id)
                    ->where('research_project_id', $project->id)
                    ->delete();

                // Remove the team member from the project
                ResearchTeamMember::where('email', $email)
                    ->where('research_project_id', $project->id)
                    ->delete();
            }
        }

        return redirect()->route('normal-user.research-project.index')->with('message', 'Project updated successfully');
    }



    public function delete($id)
    {
        // Find the project by ID
        $project = ResearchProject::with('tasks', 'teamMembers', 'projectRequests')->findOrFail($id);

        // Delete related tasks
        foreach ($project->tasks as $task) {
            ResearchTask::deleteResearchTask($task->id); // Assuming the task deletion method uses slug
        }

        // Delete related team members and requests
        foreach ($project->teamMembers as $teamMember) {
            ResearchTeamMember::deleteResearchTeamMember($teamMember->id);
        }

        foreach ($project->projectRequests as $request) {
            ResearchProjectRequest::deleteResearchProjectRequest($request->id);
        }

        // Finally, delete the project
        ResearchProject::deleteResearchProject($id);

        return redirect()->route('normal-user.research-project.index')->with('message', 'Project deleted successfully');
    }




}
