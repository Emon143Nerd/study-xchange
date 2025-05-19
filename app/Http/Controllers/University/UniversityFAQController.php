<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University\SubjectCategory;
use App\Models\University\University;
use App\Models\University\UniversityFAQ;
use Illuminate\Http\Request;
class UniversityFAQController extends Controller
{
    public function index()
    {
        $userUniversity = auth()->user()->university;
        $universityFAQs = UniversityFAQ::where('university_id', $userUniversity->id)->get();
        return view('university-user.FAQ.index',compact('universityFAQs'));
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
        return view('university-user.FAQ.add',compact('subjectCategories','universities'));
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'university_id'        => 'required|exists:universities,id',  // Ensure the university exists in the universities table
            'subject_category_id'  => 'required|exists:subject_categories,id',  // Ensure the subject category exists in the subject_categories table
            'question'             => 'required|string|max:255',  // The question should be a required string with a max length of 255 characters
            'answer'               => 'required|string',  // The answer should be a required string (no max length in this case)
            'status'               => 'required|boolean',  // Status must be a boolean (0 or 1)
        ]);
        UniversityFAQ::newUniversityFAQ($request);
        return redirect()->back()->with('message','University FAQ created successfully');
    }

    public function edit($id)
    {
        $userUniversity = auth()->user()->university;
        $universities = University::where('id', $userUniversity->id)
            ->select('id', 'slug', 'name')
            ->get();

        // Fetch the specific FAQ and validate if it belongs to the user's university
        $universityFAQ = UniversityFAQ::where('id', $id)
            ->where('university_id', $userUniversity->id)
            ->firstOrFail();

        // Fetch subject categories for the user's university
        $subjectCategories = SubjectCategory::where('university_id', $userUniversity->id)
            ->select('id', 'slug', 'name')
            ->get();

        return view('university-user.FAQ.edit', compact('universityFAQ', 'subjectCategories', 'universities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_category_id' => 'required|exists:subject_categories,id',
            'question'            => 'required|string|max:255',
            'answer'              => 'required|string',
            'status'              => 'required|boolean',
        ]);

        $userUniversity = auth()->user()->university;

        // Fetch and update the specific FAQ
        $universityFAQ = UniversityFAQ::where('id', $id)
            ->firstOrFail();

        UniversityFAQ::updateUniversityFAQ($request, $universityFAQ->id);

        return redirect()->route('university-user.FAQ.index')->with('message', 'University FAQ updated successfully');
    }

    public function delete($id)
    {

    }
}
