<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\UserJobPreference;
use Illuminate\Http\Request;


class UserJobPreferenceController extends Controller
{
    // Save or update company-user preferences
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'preferences' => 'array',
            'preferences.*.preferred_location' => 'required|string|max:255',
            'preferences.*.preferred_industry' => 'required|string|max:255',
            'preferences.*.preferred_job_type' => 'required|string|in:Full Time,Part Time,Remote,Internship',
            'preferences.*.salary_expectation' => 'required|integer|min:0',
            'preferences.*.delete' => 'nullable|boolean',
            'preferences.*.id' => 'nullable|integer|exists:user_job_preferences,id',
        ], [
            'preferences.*.preferred_location.required' => 'The preferred location is required.',
            'preferences.*.preferred_industry.required' => 'The preferred industry is required.',
            'preferences.*.preferred_job_type.required' => 'The preferred job type is required.',
            'preferences.*.preferred_job_type.in' => 'The preferred job type must be one of the following: Full time, Part time, Remote, Internship.',
            'preferences.*.salary_expectation.required' => 'The salary expectation is required.',
            'preferences.*.salary_expectation.min' => 'The salary expectation must be at least 0.',
            'preferences.*.delete.boolean' => 'The delete flag must be a boolean.',
            'preferences.*.id.exists' => 'The ID must be a valid existing preference record for updating.',
        ]);
        foreach ($request->preferences as $preferenceData) {
            if (!isset($preferenceData['preferred_location'])) {
                continue;
            }

            if (isset($preferenceData['delete']) && $preferenceData['delete'] == 1) {
                if (isset($preferenceData['id'])) {
                    $userJobPreference = UserJobPreference::find($preferenceData['id']);
                    if ($userJobPreference) {
                        $userJobPreference->delete();
                    }
                }
            } else {
                UserJobPreference::updateOrCreate(
                    ['id' => $preferenceData['id'] ?? null],
                    [
                        'user_id' => auth()->id(),
                        'preferred_location' => $preferenceData['preferred_location'],
                        'preferred_industry' => $preferenceData['preferred_industry'],
                        'preferred_job_type' => $preferenceData['preferred_job_type'], // Ensure exact match
                        'salary_expectation' => $preferenceData['salary_expectation'],
                        'status' => 1,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Job preferences saved successfully!');
    }

}
