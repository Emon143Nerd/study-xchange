<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\AdmissionApplication;
use App\Models\NormalUser\Question;
use App\Models\University\AdmissionCircular;
use App\Models\University\Course;
use App\Models\University\CourseQuestion;
use App\Models\University\SubjectCategory;
use App\Models\University\University;
use Illuminate\Http\Request;

class CourseQuestionController extends Controller
{
    public function index()
    {
        $userUniversity = auth()->user()->university;
        $courseQuestions = CourseQuestion::where('university_id', $userUniversity->id)->get();
        return view('university-user.course-question.index',compact('courseQuestions'));
    }

    public function create()
    {
        $userUniversity = auth()->user()->university;
        $universityId = $userUniversity->id;
        $courses = Course::where('university_id', $userUniversity->id)
            ->select('id', 'title')
            ->get();
        return view('university-user.course-question.add',compact('universityId','courses'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'course_id' => 'required|exists:courses,id',
            'question_type' => 'required|in:1,2', // 1 for Quizzes, 2 for Descriptive Questions
            'difficulty_level' => 'required|in:1,2,3', // 1 for Beginner, 2 for Intermediate, 3 for Advanced
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'explanation' => 'nullable|string',
            'duration' => 'nullable|integer|min:1', // Duration in minutes, minimum 1
            'status' => 'required|in:1,0', // 1 for Published, 0 for Unpublished
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Max size 2MB
        ]);
        CourseQuestion::newCourseQuestion($request);
        return redirect('/course-question-type/list')->with('message','Question created successfully');
    }

    public function edit($id)
    {
        $userUniversity = auth()->user()->university;
        $universityId = $userUniversity->id;

        // Retrieve the CourseQuestion by ID and ensure it belongs to the correct university
        $courseQuestion = CourseQuestion::where('id', $id)
            ->where('university_id', $universityId)
            ->firstOrFail();

        // Retrieve all courses for the authenticated user's university
        $courses = Course::where('university_id', $universityId)
            ->select('id', 'title')
            ->get();

        // Return the edit view with the necessary data
        return view('university-user.course-question.edit', compact('courseQuestion', 'universityId', 'courses'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'course_id' => 'required|exists:courses,id',
            'question_type' => 'required|in:1,2', // 1 for Quizzes, 2 for Descriptive Questions
            'difficulty_level' => 'required|in:1,2,3', // 1 for Beginner, 2 for Intermediate, 3 for Advanced
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'explanation' => 'nullable|string',
            'duration' => 'nullable|integer|min:1', // Duration in minutes, minimum 1
            'status' => 'required|in:1,0', // 1 for Published, 0 for Unpublished
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Max size 2MB
        ]);
        $courseQuestion = CourseQuestion::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();
        CourseQuestion::updateCourseQuestion($request, $courseQuestion->id);
        return redirect('/course-question-type/list')->with('message','Question updated successfully');
    }

    public function delete($id)
    {
        $courseQuestion = CourseQuestion::where('id', $id)
            ->where('university_id', auth()->user()->university->id)
            ->firstOrFail();
        CourseQuestion::deleteCourseQuestion($courseQuestion->id);
        return redirect('/course-question-type/list')->with('message','Question deleted successfully');
    }

}
