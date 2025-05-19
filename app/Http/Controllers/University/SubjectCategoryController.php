<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University\SubjectCategory;
use Illuminate\Http\Request;

class SubjectCategoryController extends Controller
{
    public function index()
    {
        $userUniversity = auth()->user()->university;
        $subjectCategories = SubjectCategory::where('university_id', $userUniversity->id)->get();
        return view('university-user.subject-category.index',compact('subjectCategories'));
    }

    public function create()
    {
        return view('university-user.subject-category.add');
    }


    public function store(Request $request)
    {
        // Validation rules for storing a new Subject Category
        $validatedData = $request->validate([
            'university_id'     => 'required|exists:universities,id',  // Ensure the university exists in the database
            'name'               => 'required|string|max:255',  // The name should be unique in the subject_categories table
            'description'        => 'required|string|max:1000',  // Optional description
            'status'             => 'required|boolean',  // Status must be either 0 or 1
            'image'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image should be of a valid type and size
        ]);

        // Store the new Subject Category
        SubjectCategory::newSubjectCategory($request);

        // Redirect back with a success message
        return back()->with('message', 'Subject Category Info created successfully');
    }


    public function edit($slug)
    {
        $subjectCategory = SubjectCategory::where('slug',$slug)->firstOrFail();
        return view('university-user.subject-category.edit',compact('subjectCategory'));
    }


    public function update(Request $request, $slug)
    {
        // Fetch the subject category to update
        $subjectCategory = SubjectCategory::where('slug', $slug)->firstOrFail();

        // Validation rules for updating an existing Subject Category
        $validatedData = $request->validate([
            'university_id'     => 'required|exists:universities,id',  // Ensure the university exists in the database
            'name'               => 'required', 'string', 'max:255',  // Unique name for this subject category (ignores current subject category)
            'description'        => 'required|string|max:1000',  // Optional description
            'status'             => 'required|boolean',  // Status must be either 0 or 1
            'image'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image validation for updates
        ]);

        // Update the subject category with the validated data
        SubjectCategory::updateSubjectCategory($request, $slug);

        // Redirect to the subject category list page with a success message
        return redirect('/subject/category/list')->with('message', 'Subject Category Info Updated successfully');
    }


    public function delete($slug)
    {
        $subjectCategory = SubjectCategory::where('slug',$slug)->firstOrFail();
        SubjectCategory::deleteSubjectCategory($subjectCategory->slug);
        return back()->with('message','Subject Category info deleted successfully');
    }

}
