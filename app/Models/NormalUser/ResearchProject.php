<?php

namespace App\Models\NormalUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;



class ResearchProject extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'department',
        'description',
        'objective',
        'timeline_from',
        'timeline_to',
        'attachment',
        'status', // Add this field
        'created_by'
    ];
    private static $researchProject, $image, $extension, $imageName, $directory, $imageUrl;

    public static function getImageUrl($image)
    {
        if ($image) {
            try {
                self::$extension = $image->getClientOriginalExtension(); //png
                self::$imageName = time() . '.' . self::$extension; // 123423.png
                self::$directory = 'upload/ResearchProject-image/';

                // Check if the directory exists, otherwise create it
                if (!file_exists(self::$directory)) {
                    mkdir(self::$directory, 0775, true);
                }

                // Attempt to move the image to the server
                $image->move(self::$directory, self::$imageName);
                self::$imageUrl = self::$directory . self::$imageName;

                // Return the correct image URL
                return self::$imageUrl;
            } catch (\Exception $e) {
                \Log::error('Error uploading image: ' . $e->getMessage());
                return null; // Handle the exception appropriately
            }
        }

        return null; // Return null if no image is uploaded
    }

    public static function newResearchProject($request)
    {
        self::$researchProject = new ResearchProject();

        // Handle image upload if exists
        $imageUrl = $request->hasFile('attachment') ? self::getImageUrl($request->file('attachment')) : null;

        return self::ResearchProjectInfo(self::$researchProject, $request, $imageUrl);
    }


    public static function updateResearchProject($request, $id)
    {
        self::$researchProject = ResearchProject::where('id', $id)->first();
        if (self::$image = $request->file('attachment'))
        {
            self::deleteImageFormFolder(self::$researchProject->image);
            self::$imageUrl = self::getImageUrl($request->file('attachment'));
        }
        else
        {
            self::$imageUrl = self::$researchProject->image;
        }
        self::ResearchProjectInfo(self::$researchProject, $request, self::$imageUrl);
    }

    public static function deleteResearchProject($id)
    {
        self::$researchProject = ResearchProject::where('id', $id)->first();
        self::deleteImageFormFolder(self::$researchProject->image);
        self::$researchProject->delete();
    }

    private static function deleteImageFormFolder($imageUrl)
    {
        if (file_exists($imageUrl))
        {
            unlink($imageUrl);
        }
    }

    public static function ResearchProjectInfo($researchProject, $request, $imageUrl)
    {
        self::$researchProject->title = $request->title;
        self::$researchProject->created_by = $request->created_by;
        self::$researchProject->slug = Str::slug($request->title);
        self::$researchProject->department = $request->department;
        self::$researchProject->description = $request->description;
        self::$researchProject->objective = $request->objective;
        self::$researchProject->timeline_from = $request->timeline_from;
        self::$researchProject->timeline_to = $request->timeline_to;
        self::$researchProject->status = $request->status;

        // Save the image URL in the attachment column
        if ($imageUrl) {
            self::$researchProject->attachment = $imageUrl;
        }

        self::$researchProject->save();

        return self::$researchProject;
    }


    public static function checkAndUpdateProjectStatus($projectId)
    {
        $project = ResearchProject::with('tasks')->find($projectId);

        // If no tasks exist, set project status to Pending (1)
        if ($project->tasks->isEmpty()) {
            $project->update(['status' => 1]);
            return;
        }

        // If at least one task exists, set project status to Ongoing (2)
        $project->update(['status' => 2]);

        // If all tasks are completed, set project status to Completed (3)
        if ($project->tasks->every(fn($task) => $task->status == 3)) {
            $project->update(['status' => 3]);
        }
        // If any task is Pending or In Progress, set project status to Ongoing (2)
        elseif ($project->tasks->contains(fn($task) => in_array($task->status, [1, 2]))) {
            $project->update(['status' => 2]);
        }
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function teamMembers()
    {
        return $this->hasMany(ResearchTeamMember::class, 'research_project_id');
    }

    public function tasks()
    {
        return $this->hasMany(ResearchTask::class);
    }

    public function projectRequests()
    {
        return $this->hasMany(ResearchProjectRequest::class);
    }
}
