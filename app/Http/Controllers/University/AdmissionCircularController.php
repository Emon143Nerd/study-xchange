<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\AdmissionApplication;
use App\Models\University\AdmissionCircular;
use App\Models\University\SubjectCategory;
use App\Models\University\University;
use Illuminate\Http\Request;

class AdmissionCircularController extends Controller
{
    public function index()
    {
        $userUniversity = auth()->user()->university;
        $admissionCirculars = AdmissionCircular::where('university_id', $userUniversity->id)->get();
        return view('university-user.admission-circular.index',compact('admissionCirculars'));
    }

    public function create()
    {
        $userUniversity = auth()->user()->university;

        $universities = University::where('id', $userUniversity->id)
            ->select('id', 'slug', 'name')
            ->get();

        // Fetch subject categories for the user's university
        $subjectCategories = SubjectCategory::where('university_id', $userUniversity->id)
            ->select('id', 'slug', 'name')
            ->get();
        return view('university-user.admission-circular.add',compact('universities','subjectCategories'));
    }

    public function store(Request $request)
    {

        // Validation
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'subject_category_id' => 'required|exists:subject_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_fees' => 'required|string|min:0',
            'min_gpa_req' => 'required|numeric|min:0|max:4.0',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        AdmissionCircular::newAdmissionCircular($request);
        return back()->with('message','Admission Circular Info created successfully');
    }

    public function edit($slug)
    {
        // Fetch the admission circular by slug
        $admissionCircular = AdmissionCircular::where('slug', $slug)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();

        // Get only the user's university
        $userUniversity = auth()->user()->university;
        $universities = University::where('id', $userUniversity->id)
            ->select('id', 'slug', 'name')
            ->get();

        // Fetch subject categories for the user's university
        $subjectCategories = SubjectCategory::where('university_id', $userUniversity->id)
            ->select('id', 'slug', 'name')
            ->get();
        return view('university-user.admission-circular.edit',compact('admissionCircular','universities','subjectCategories'));
    }

    public function update(Request $request, $slug)
    {
        // Validation
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'subject_category_id' => 'required|exists:subject_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_fees' => 'required|string|min:0',
            'min_gpa_req' => 'required|numeric|min:0|max:4.0',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        $admissionCircular = AdmissionCircular::where('slug', $slug)->firstOrFail();
        AdmissionCircular::updateAdmissionCircular($request, $admissionCircular->slug);
        return redirect('/circular/list')->with('message','Admission Circular Info updated successfully');
    }

    public function delete($slug)
    {
        $admissionCircular = AdmissionCircular::where('slug', $slug)->firstOrFail();
        AdmissionCircular::deleteAdmissionCircular($admissionCircular->slug);
        return redirect('/circular/list')->with('message','Admission Circular Info deleted successfully');
    }

    public function applicant()
    {
        $userUniversity = auth()->user()->university;
        $applicants = AdmissionApplication::where('university_id', $userUniversity->id)->get();
        return view('university-user.admission-circular.applicants',compact('applicants'));
    }

    public function applicantDetail($id)
    {
        $userUniversity = auth()->user()->university;

        // Fetch the applicant details
        $applicant = AdmissionApplication::where('id', $id)
            ->where('university_id', $userUniversity->id)
            ->firstOrFail();

        // Fetch subject categories associated with the user's university
        $subjectCategories = SubjectCategory::where('university_id', $userUniversity->id)->get();

        return view('university-user.admission-circular.applicants-detail', compact('applicant', 'subjectCategories'));
    }

    public function updateApplicant(Request $request, $id)
    {
        // Get the current university of the logged-in user
        $userUniversity = auth()->user()->university;

        // Validate the request inputs
        $request->validate([
            'acceptance' => 'required|boolean',
        ]);

        // Fetch the applicant details
        $applicant = AdmissionApplication::where('id', $id)
            ->where('university_id', $userUniversity->id) // Ensure the applicant belongs to the current user's university
            ->firstOrFail();

        // Update the applicant details using the model method
        AdmissionApplication::updateAdmissionApplication($request, $id);

        // Redirect with a success message
        return redirect()->route('university-user.applicants.index')
            ->with('message', 'Applicant details updated successfully.');
    }

}
