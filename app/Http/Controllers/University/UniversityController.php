<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University\SubjectCategory;
use App\Models\University\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::where('user_id', auth()->id())->get();
        return view('university-user.university.index',compact('universities'));
    }

    public function create()
    {
        return view('university-user.university.add');
    }


    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'user_id'            => 'required|exists:users,id',
            'name'               => 'required|string|max:255|unique:universities,name',  // Unique name for the university
            'description'        => 'required|string|max:1000',
            'university_type'    => 'required|in:public,private',
            'rank'               => 'required|integer|min:1',
            'tuition_fees'       => 'required|string|min:0',
            'campus_facilities'  => 'required|string|max:1000',
            'scholarships'       => 'required|string|max:1000',
            'placement_records'  => 'required|string|max:1000',
            'residence_facilities' => 'required|string|max:1000',
            'food_facilities'    => 'required|string|max:1000',
            'avg_living_cost'    => 'required|string|min:0',
            'status'             => 'required|boolean',
            'image'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proceed to store the university data
        University::newUniversity($request);

        return back()->with('message', 'University Info created successfully');
    }


    public function edit($slug)
    {
        $university = University::where('slug',$slug)->firstOrFail();
        return view('university-user.university.edit',compact('university'));
    }


    public function update(Request $request, $slug)
    {
        // Fetch the university to update
        $university = University::where('slug', $slug)->firstOrFail();

        // Validation rules
        $validatedData = $request->validate([
            'user_id'            => 'required|exists:users,id',
            'name'               => ['required', 'string', 'max:255', 'unique:universities,name,' . $university->id],  // Unique name for the university, except the current one
            'description'        => 'required|string|max:1000',
            'university_type'    => 'required|in:public,private',
            'rank'               => 'required|integer|min:1',
            'tuition_fees'       => 'required|string|min:0',
            'campus_facilities'  => 'required|string|max:1000',
            'scholarships'       => 'required|string|max:1000',
            'placement_records'  => 'required|string|max:1000',
            'residence_facilities' => 'required|string|max:1000',
            'food_facilities'    => 'required|string|max:1000',
            'avg_living_cost'    => 'required|string|min:0',
            'status'             => 'required|boolean',
            'image'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proceed to update the university data
        University::updateUniversity($request, $slug);

        return redirect('/university/list')->with('message', 'University Info updated successfully');
    }


    public function delete($slug)
    {
        $university = University::where('slug',$slug)->firstOrFail();
        University::deleteUniversity($university->slug);
        return back()->with('message','University info deleted successfully');
    }
}
