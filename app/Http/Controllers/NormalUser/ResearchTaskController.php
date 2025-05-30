<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\ResearchProject;
use App\Models\NormalUser\ResearchTask;
use App\Models\NormalUser\ResearchTeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;





class ResearchTaskController extends Controller
{
    public function create($researchProjectId)
    {
        $researchProject = ResearchProject::where('id',$researchProjectId)->firstOrFail();
        $teamMembers = ResearchTeamMember::where('research_project_id', $researchProject->id)
            ->where('research_team_members.status', '!=', 3) // Exclude team members with status 3
            ->join('users', 'research_team_members.email', '=', 'users.email')
            ->select('research_team_members.id', 'users.name', 'users.email', 'research_team_members.status')
            ->get();

        return view('normal-user.research-collaboration.task.add',compact('researchProject','teamMembers'));
    }


    public function store(Request $request)
    {
        // Fetch project timeline for validation
        $project = ResearchProject::find($request->research_project_id);

        // Validate due date within project timeline
        $request->validate([
            'title' => 'required|string|max:255', // Ensure task title is required and a string
            'research_team_member_id' => 'required', // Ensure valid team member is selected
            'due_date' => 'required|date_format:d-m-Y|after_or_equal:' . Carbon::parse($project->timeline_from)->format('d-m-Y') . '|before_or_equal:' . Carbon::parse($project->timeline_to)->format('d-m-Y'),
            'description' => 'nullable|string', // Description is optional, but must be a string if provided
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // Ensure the attachment is valid
            'status' => 'required|in:1,2,3', // Ensure status is selected and a valid value (1 = Pending, 2 = On Progress, 3 = Completed)
        ], [
            'due_date.after_or_equal' => 'The due date must be on or after ' . Carbon::parse($project->timeline_from)->format('d-m-Y') . '.',
            'due_date.before_or_equal' => 'The due date must be on or before ' . Carbon::parse($project->timeline_to)->format('d-m-Y') . '.',
            'status.in' => 'The selected status is invalid.',
        ]);

        // If no description is provided, set it as an empty string
        if (!$request->has('description') || $request->description === null) {
            $request->merge(['description' => '']);
        }

        // Convert due date to MySQL format
        $request->merge([
            'due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
        ]);

        // Create the task
        ResearchTask::newResearchTask($request);

        // After task creation, update the project status
        ResearchProject::checkAndUpdateProjectStatus($request->research_project_id);

        return back()->with('message', 'New task created successfully');
    }




    public function detail($id)
    {
        $task = ResearchTask::with('teamMember.user')->where('id', $id)->firstOrFail();
        return view('normal-user.research-collaboration.task.detail',compact('task'));
    }

    public function edit($id)
    {
        $task = ResearchTask::with('teamMember.user')->where('id', $id)->firstOrFail();
        $project = $task->project;

        // Get only the team members associated with the project
        $teamMembers = $project->teamMembers;
        return view('normal-user.research-collaboration.task.edit',compact('task','teamMembers'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the project to validate the due date
        $task = ResearchTask::findOrFail($id);
        $project = ResearchProject::find($task->research_project_id);
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255', // Ensure task title is required and a string
            'research_team_member_id' => 'required', // Ensure valid team member is selected
            'due_date' => 'nullable|date_format:d-m-Y|after_or_equal:' . Carbon::parse($project->timeline_from)->format('d-m-Y') . '|before_or_equal:' . Carbon::parse($project->timeline_to)->format('d-m-Y'),
            'description' => 'nullable|string', // Description is optional, but must be a string if provided
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // Ensure the attachment is valid
            'status' => 'required|in:1,2,3', // Ensure status is selected and a valid value (1 = Pending, 2 = On Progress, 3 = Completed)
        ], [
            'due_date.after_or_equal' => 'The due date must be on or after ' . Carbon::parse($project->timeline_from)->format('d-m-Y') . '.',
            'due_date.before_or_equal' => 'The due date must be on or before ' . Carbon::parse($project->timeline_to)->format('d-m-Y') . '.',
            'status.in' => 'The selected status is invalid.',
        ]);

        // If no description is provided, set it as an empty string
        if (!$request->has('description') || $request->description === null) {
            $request->merge(['description' => '']);
        }

        if ($request->has('due_date')) {
            $request->merge([
                'due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d')
            ]);
        }
        $task = ResearchTask::updateResearchTask($request, $id);
        return redirect()->route('normal-user.research-task.detail', ['id' => $id])
            ->with('message', 'Task info updated successfully');
    }

    public function delete($id)
    {
        ResearchTask::deleteResearchTask($id);
        return back()->with('message', 'Task info deleted successfully');
    }
}
