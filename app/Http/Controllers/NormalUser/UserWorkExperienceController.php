<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\UserWorkExperience;
use Illuminate\Http\Request;


class UserWorkExperienceController extends Controller
{
    // Store new work experience
    public function store(Request $request)
    {
        $customMessages = [
            'work_experience.*.company_name.required' => 'The company name is required for each work experience.',
            'work_experience.*.company_name.string' => 'The company name must be a valid string.',
            'work_experience.*.company_name.max' => 'The company name cannot exceed 255 characters.',
            'work_experience.*.job_title.required' => 'The job title is required for each work experience.',
            'work_experience.*.job_title.string' => 'The job title must be a valid string.',
            'work_experience.*.job_title.max' => 'The job title cannot exceed 255 characters.',
            'work_experience.*.start_date.required' => 'The start date is required for each work experience.',
            'work_experience.*.start_date.date' => 'The start date must be a valid date.',
            'work_experience.*.end_date.required' => 'The end date is required for each work experience.',
            'work_experience.*.end_date.date' => 'The end date must be a valid date.',
            'work_experience.*.description.required' => 'The description is required for each work experience.',
            'work_experience.*.description.string' => 'The description must be a valid string.',
        ];

        // Validate the incoming data for work experience
        $request->validate([
            'work_experience' => 'array',
            'work_experience.*.company_name' => 'required|string|max:255',
            'work_experience.*.job_title' => 'required|string|max:255',
            'work_experience.*.start_date' => 'required|date',
            'work_experience.*.end_date' => 'required|date',
            'work_experience.*.description' => 'required|string',
            'work_experience.*.delete' => 'nullable|boolean', // For deletion check
            'work_experience.*.id' => 'nullable|integer|exists:user_work_experiences,id', // For updating existing records
        ], $customMessages);

        foreach ($request->work_experience as $experienceData) {
            // Check if the company_name exists in the incoming data
            if (!isset($experienceData['company_name'])) {
                continue; // Skip this entry if 'company_name' doesn't exist
            }

            // Check if this work experience is marked for deletion
            if (isset($experienceData['delete']) && $experienceData['delete'] == 1) {
                if (isset($experienceData['id'])) {
                    $workExperience = UserWorkExperience::find($experienceData['id']);
                    if ($workExperience) {
                        $workExperience->delete();
                    }
                }
            } else {
                // Create or update the work experience entry
                UserWorkExperience::updateOrCreate(
                    ['id' => $experienceData['id'] ?? null], // Use ID if exists, or create new
                    [
                        'user_id' => $experienceData['user_id'],
                        'company_name' => $experienceData['company_name'],
                        'job_title' => $experienceData['job_title'],
                        'start_date' => $experienceData['start_date'],
                        'end_date' => $experienceData['end_date'],
                        'description' => $experienceData['description'],
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Work experiences saved successfully.');
    }
}
