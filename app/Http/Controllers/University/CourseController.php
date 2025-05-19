<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University\Course;
use App\Models\University\University;
use App\Models\University\UniversityFAQ;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $userUniversity = auth()->user()->university;
        $courses = Course::where('university_id', $userUniversity->id)->get();
        return view('university-user.course.index',compact('courses','userUniversity'));
    }

    public function create()
    {
        $userUniversity = auth()->user()->university;

        $universityId = $userUniversity->id;
        return view('university-user.course..add',compact('universityId'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'university_id'         => 'required|exists:universities,id',  // Ensure the university exists in the universities table
            'title'                 => 'required|string|max:255',  // The question should be a required string with a max length of 255 characters
            'description'           => 'required|string',  // The answer should be a required string (no max length in this case)
            'status'                => 'required|boolean',  // Status must be a boolean (0 or 1)
        ]);
        Course::newCourse($request);
        return redirect('/course/list')->with('message','Course created successfully');
    }

    public function edit($id)
    {
        $userUniversity = auth()->user()->university;
        $universities = University::where('id', $userUniversity->id)
            ->select('id', 'name')
            ->get();
        $universityId = $userUniversity->id;
        $course = Course::where('id', $id)
            ->where('university_id', $userUniversity->id)
            ->firstOrFail();
        return view('university-user.course.edit', compact('universityId','userUniversity', 'universities', 'course'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'university_id'         => 'required|exists:universities,id',  // Ensure the university exists in the universities table
            'title'                 => 'required|string|max:255',  // The question should be a required string with a max length of 255 characters
            'description'           => 'required|string',  // The answer should be a required string (no max length in this case)
            'status'                => 'required|boolean',  // Status must be a boolean (0 or 1)
        ]);
        Course::updateCourse($request, $id);
        return redirect('/course/list')->with('message','Course Update successfully');
    }

    public function delete($id)
    {
        $userUniversity = auth()->user()->university;
        $course = Course::where('id', $id)
            ->where('university_id', $userUniversity->id)
            ->firstOrFail();
        Course::deleteCourse($course->id);
        return back()->with('message','Course Update successfully');
    }
}
