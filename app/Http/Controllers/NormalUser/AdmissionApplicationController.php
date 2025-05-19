<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\AdmissionApplication;
use App\Models\University\University;
use Illuminate\Http\Request;
use App\Models\University\AdmissionCircular;

class AdmissionApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gpa' => 'required|numeric',
            'admission_circular_id' => 'required|integer',
            'university_id' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admission_applications,email',
            'dob' => 'required|date',
            'nationality' => 'required|string|max:255',
            'prev_education' => 'required|string|max:255',
            'subject_category_id' => 'required|integer',
            'start_date' => 'required|date',
            'transcript' => 'nullable|file|mimes:pdf,jpeg,png|max:5120', // Optional, only allows PDFs, JPEGs, or PNGs, with a max size of 2MB
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Optional
            'recommendation_letter' => 'nullable|file|mimes:pdf,doc,docx,pdf,jpeg,png|max:5120', // Optional
        ]);


        $admissionCircular = AdmissionCircular::find($request->admission_circular_id);

        if (!$admissionCircular) {
            return redirect()->back()->withErrors(['admission_circular_id' => 'Invalid admission circular ID.']);
        }

        if ($request->gpa < $admissionCircular->min_gpa_req) {
            return redirect()->back()->withErrors(['gpa' => 'Your GPA is below the minimum required GPA for this admission.']);
        }

        AdmissionApplication::newAdmissionApplication($request);
        return back()->with('message', 'Your admission application has been submitted successfully. We will review your application and notify you about the next steps shortly.');
    }



}
