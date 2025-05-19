<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\UserEducation;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;


class UserEducationController extends Controller
{

    public function store(Request $request)
    {
        $customMessages = [
            'education.*.start_date.date' => 'Please enter a valid start date.',
            'education.*.start_date.before_or_equal' => 'The start date cannot be in the future.',
            'education.*.grade.numeric' => 'The grade must be a number.',
            'education.*.grade.max' => 'The grade must not exceed 5.0.',
            'education.*.institution_name.required' => 'The institution name is required.',
            'education.*.degree.required' => 'The degree is required.',
            'education.*.field_of_study.required' => 'The field of study is required.',
            'education.*.start_date.required' => 'The start date is required.',
            'education.*.end_date.date' => 'Please enter a valid end date.',
            'education.*.end_date.after_or_equal' => 'The end date must be on or after the start date.',
        ];

        $request->validate([
            'education.*.institution_name' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.field_of_study' => 'required|string|max:255',
            'education.*.start_date' => 'required|date|before_or_equal:today',
            'education.*.end_date' => 'nullable|date|after_or_equal:education.*.start_date',
            'education.*.grade' => 'nullable|numeric|max:5.0',
            'education.*.description' => 'nullable|string|max:1000',
        ], $customMessages);


        foreach ($request->education as $educationData) {
            // Check if this education is marked for deletion
            if (isset($educationData['delete']) && $educationData['delete'] == 1) {
                if (isset($educationData['id'])) {
                    $education = UserEducation::find($educationData['id']);
                    if ($education) {
                        $education->delete();
                    }
                }
            } else {
                // Create or update the education entry
                UserEducation::updateOrCreate(
                    ['id' => $educationData['id'] ?? null], // Use ID if exists, or create new
                    [
                        'user_id' => $educationData['user_id'],
                        'institution_name' => $educationData['institution_name'],
                        'degree' => $educationData['degree'],
                        'field_of_study' => $educationData['field_of_study'],
                        'start_date' => $educationData['start_date'],
                        'end_date' => $educationData['end_date'],
                        'grade' => $educationData['grade'],
                        'description' => $educationData['description'],
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Education details saved successfully.');
    }

}
