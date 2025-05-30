<?php

namespace App\Models\NormalUser;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ResearchTeamMember extends Model
{

    protected $fillable = [
        'research_project_id',  // Add other fields you want to allow for mass-assignment
        'email',
        'status', // Add status here
    ];
    private static $researchTeamMember;

    public static function newResearchTeamMember($request, $research_project_id)
    {
        foreach ($request->research_team_members as $email) {
            $user = User::where('email', $email)->first(); // Find the user by email

            // Create a new TeamMember instance
            $researchTeamMember                         = new ResearchTeamMember();
            $researchTeamMember->research_project_id    = $research_project_id;
            $researchTeamMember->email                  = $email;
            $researchTeamMember->save(); // Save each team member

            // Create a project request
//            ResearchProjectRequest::newResearchProjectRequest($user->id, $research_project_id);

        }
    }

    public static function updateResearchTeamMember($request, $id)
    {
        self::$researchTeamMember                 = ResearchTeamMember::find($id);
        self::$researchTeamMember->name           = $request->name;
        self::$researchTeamMember->save();
    }

    public static function deleteResearchTeamMember($id)
    {
        self::$researchTeamMember = ResearchTeamMember::find($id);
        self::$researchTeamMember->delete();
    }

    public function project()
    {
        return $this->belongsTo(ResearchProject::class, 'research_project_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

}
