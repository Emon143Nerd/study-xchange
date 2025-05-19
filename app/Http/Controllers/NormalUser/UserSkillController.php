<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\UserSkill;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    public function store(Request $request)
    {
        $customMessages = [
            'skill.*.skill_name.required' => 'Each skill must have a name.',
            'skill.*.skill_name.string' => 'The skill name must be a valid string.',
            'skill.*.skill_name.max' => 'The skill name cannot exceed 255 characters.',
            'skill.*.proficiency_level.required' => 'Please provide a proficiency level for each skill.',
            'skill.*.proficiency_level.integer' => 'The proficiency level must be a valid number.',
            'skill.*.proficiency_level.between' => 'The proficiency level must be between 1 and 3.',
        ];

        // Use a named error bag for skill form validation
        $request->validate([
            'skill' => 'array',
            'skill.*.skill_name' => 'required|string|max:255',
            'skill.*.proficiency_level' => 'required|integer|between:1,3',
            'skill.*.delete' => 'nullable|boolean',
            'skill.*.id' => 'nullable|integer|exists:user_skills,id',
        ], $customMessages, [], 'skillForm');

        foreach ($request->skill as $skillData) {
            // Check if the skill name exists in the incoming data
            if (!isset($skillData['skill_name'])) {
                continue; // Skip this entry if 'skill_name' doesn't exist
            }

            // Check if this skill is marked for deletion
            if (isset($skillData['delete']) && $skillData['delete'] == 1) {
                if (isset($skillData['id'])) {
                    $skill = UserSkill::find($skillData['id']);
                    if ($skill) {
                        $skill->delete();
                    }
                }
            } else {
                // Create or update the skill entry
                UserSkill::updateOrCreate(
                    ['id' => $skillData['id'] ?? null], // Use ID if exists, or create new
                    [
                        'user_id' => $skillData['user_id'],
                        'skill_name' => $skillData['skill_name'],
                        'proficiency_level' => $skillData['proficiency_level'],
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Education details saved successfully.');
    }


}
