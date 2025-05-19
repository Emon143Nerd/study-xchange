<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\Job\Company;
use App\Models\Job\JobApplication;
use App\Models\Job\JobCircular;
use App\Models\NormalUser\Question;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobCircular::orderBy('id', 'desc')->get();
        return view('normal-user.job.index',compact('jobs'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search by title
        $jobs = JobCircular::where('title', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'desc')
            ->get();

        return view('normal-user.job.index', compact('jobs'));
    }


    public function detail($id)
    {
        $userEducations = auth()->user()->educations;
        $userSkills = auth()->user()->skills;
        $userWorkExperiences = auth()->user()->workExperiences;
        $userCertifications = auth()->user()->certifications;
        $userJobPreferences = auth()->user()->jobPreferences;

        $jobCircular = JobCircular::where('id', $id)->firstOrFail();

        // Get the company_id related to this job circular
        $companyId = $jobCircular->company_id;

        // Fetch other job circulars from the same company, excluding the current job circular
        $otherJobCirculars = JobCircular::where('company_id', $companyId)
            ->where('id', '!=', $id)  // Exclude the current job circular
            ->get();

        // Get the number of applications for this job circular
        $applicationCount = $jobCircular->jobApplication()->count();

        // Increment the hit count
        $jobCircular->increment('hit_count');
        return view('normal-user.job.detail',compact('jobCircular', 'userEducations', 'userSkills', 'userWorkExperiences', 'userCertifications', 'userJobPreferences', 'otherJobCirculars', 'applicationCount'));
    }

    public function jobApplication(Request $request)
    {
        JobApplication::newJobApplication($request);
        return back()->with('message','Job Application sent Successfully');
    }

    public function company($companyId)
    {
        $company = Company::findOrFail($companyId);
        return view('normal-user.job.company', compact('company'));
    }



}
