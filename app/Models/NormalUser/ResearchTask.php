<?php

namespace App\Models\NormalUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class ResearchTask extends Model
{
    private static $researchTask, $image, $extension, $imageName, $directory, $imageUrl;

    public static function getImageUrl($image)
    {
        if ($image) {
            try {
                self::$extension    = $image->getClientOriginalExtension(); //png
                self::$imageName    = time().'.'.self::$extension; //123423.png
                self::$directory    = 'upload/ResearchTask-image/';

                // Check if the directory exists, otherwise create it
                if (!file_exists(self::$directory)) {
                    mkdir(self::$directory, 0775, true);
                }

                // Attempt to move the image
                $image->move(self::$directory, self::$imageName);
                self::$imageUrl     = self::$directory.self::$imageName;
                return self::$imageUrl;
            } catch (\Exception $e) {
                \Log::error('Error uploading image: '.$e->getMessage());
                return null; // Handle the exception appropriately
            }
        }
        return null;
    }

//    public static function newResearchTask($request)
//    {
//        self::$researchTask  = new ResearchTask();
//        $imageUrl = $request->hasFile('attachment') ? self::getImageUrl($request->file('attachment')) : null;
//        return self::ResearchTaskInfo(self::$researchTask, $request, self::getImageUrl($request->file('attachment')));
//    }

    public static function newResearchTask($request)
    {
        self::$researchTask = new ResearchTask();

        // Get image URL if an image is uploaded
        $imageUrl = $request->hasFile('attachment') ? self::getImageUrl($request->file('attachment')) : null;

        return self::ResearchTaskInfo(self::$researchTask, $request, $imageUrl);
    }


    public static function updateResearchTask($request, $id)
    {
        self::$researchTask = ResearchTask::where('id', $id)->first();
        if (self::$image = $request->file('attachment'))
        {
            self::deleteImageFormFolder(self::$researchTask->image);
            self::$imageUrl = self::getImageUrl($request->file('attachment'));
        }
        else
        {
            self::$imageUrl = self::$researchTask->image;
        }
        self::$researchTask->title                          = $request->title;
        self::$researchTask->slug                           = Str::slug($request->title);
        self::$researchTask->research_team_member_id        = $request->research_team_member_id;
        self::$researchTask->description                    = $request->description;
        self::$researchTask->due_date                       = $request->due_date;
        self::$researchTask->status                         = $request->status;

        if (self::$imageUrl) {
            self::$researchTask->attachment = self::$imageUrl;
        }

        $saved = self::$researchTask->save();

        // Check if all tasks are completed and update project status
        if ($saved) {
            ResearchProject::checkAndUpdateProjectStatus(self::$researchTask->research_project_id);
        }

        return $saved;
    }

    public static function deleteResearchTask($id)
    {
        self::$researchTask = ResearchTask::where('id', $id)->first();
        self::deleteImageFormFolder(self::$researchTask->image);
        self::$researchTask->delete();
    }

    private static function deleteImageFormFolder($imageUrl)
    {
        if (file_exists($imageUrl))
        {
            unlink($imageUrl);
        }
    }
//    public static function ResearchTaskInfo($researchTask, $request, $imageUrl)
//    {
//        self::$researchTask->research_project_id            = $request->research_project_id;
//        self::$researchTask->research_team_member_id        = $request->research_team_member_id;
//        self::$researchTask->title                          = $request->title;
//        self::$researchTask->slug                           = Str::slug($request->title);
//        self::$researchTask->description                    = $request->description;
//        self::$researchTask->due_date                       = $request->due_date;
//        self::$researchTask->status                         = $request->status;
//        if ($imageUrl) {
//            self::$researchTask->attachment                 = $imageUrl;
//        }
//        self::$researchTask->save();
//        return self::$researchTask;
//    }
    public static function ResearchTaskInfo($researchTask, $request, $imageUrl)
    {
        self::$researchTask->research_project_id = $request->research_project_id;
        self::$researchTask->research_team_member_id = $request->research_team_member_id;
        self::$researchTask->title = $request->title;
        self::$researchTask->slug = Str::slug($request->title);
        self::$researchTask->description = $request->description;
        self::$researchTask->due_date = $request->due_date;
        self::$researchTask->status = $request->status;

        // Save the image URL if provided
        if ($imageUrl) {
            self::$researchTask->attachment = $imageUrl;
        }

        self::$researchTask->save();
        return self::$researchTask;
    }


    public function project()
    {
        return $this->belongsTo(ResearchProject::class, 'research_project_id');
    }

    public function teamMember()
    {
        return $this->belongsTo(ResearchTeamMember::class, 'research_team_member_id');
    }

}
