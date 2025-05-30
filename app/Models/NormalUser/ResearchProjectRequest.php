<?php

namespace App\Models\NormalUser;

use Illuminate\Database\Eloquent\Model;



class ResearchProjectRequest extends Model
{
    protected $fillable = [
        'user_id',
        'research_project_id',
        'status',
    ];
    private static $researchProjectRequest;

    public static function newResearchProjectRequest($user_id, $research_project_id)
    {
        self::$researchProjectRequest                       = new ResearchProjectRequest();
        self::$researchProjectRequest->user_id              = $user_id;
        self::$researchProjectRequest->research_project_id  = $research_project_id;
        self::$researchProjectRequest->status               = 1; // Pending
        self::$researchProjectRequest->save();
    }


    public static function updateResearchProjectRequest($request, $id)
    {
        self::$researchProjectRequest                 = ResearchProjectRequest::find($id);
        self::$researchProjectRequest->name           = $request->name;
        self::$researchProjectRequest->save();
    }

    public static function deleteResearchProjectRequest($id)
    {
        self::$researchProjectRequest = ResearchProjectRequest::find($id);
        self::$researchProjectRequest->delete();
    }

    public function project()
    {
        return $this->belongsTo(ResearchProject::class, 'research_project_id');
    }

}
