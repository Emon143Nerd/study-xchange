<?php

namespace App\Http\Controllers\Job;
//
use App\Http\Controllers\Controller;
use App\Models\Job\Company;
use App\Models\Job\JobApplication;
use App\Models\Job\JobCircular;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JobCircularController extends Controller
{
    public function index()
    {
        $userCompany = auth()->user()->company;
        $jobCirculars = JobCircular::where('company_id', $userCompany->id)->get();
        return view('company-user.job-circular.index',compact('jobCirculars','userCompany'));
    }

    public function create()
    {
        $userCompany = auth()->user()->company;
        $companies = Company::where('id', $userCompany->id)
            ->select('id', 'name')
            ->get();
        return view('company-user.job-circular.add',compact('companies'));
    }

    public function store(Request $request)
    {
//return $request;
        $request->merge([
            'application_deadline' => Carbon::parse($request->input('application_deadline'))->format('Y-m-d'),
        ]);

        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirement' => 'required|string',
            'responsibilities' => 'required|string',
            'type' => 'required|string|in:Full Time,Part Time,Remote,Internship',
            'location' => 'required|string|max:255',
            'salary_range' => 'required|string|max:255',
            'application_deadline' => 'required|date|after:today',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $request->merge([
            'application_deadline' => Carbon::parse($request->application_deadline)->format('Y-m-d'),
        ]);
        JobCircular::newJobCircular($request);
        return redirect()->back()->with('message','Job Circular Created Successfully');
    }



    public function edit($id)
    {
        // Fetch the admission circular by slug
        $jobCircular = JobCircular::where('id', $id)
            ->where('company_id', auth()->user()->company->id)
            ->firstOrFail();

        // Get only the user's university
        $userCompany = auth()->user()->company;
        $companies = Company::where('id', $userCompany->id)
            ->select('id', 'name')
            ->get();

        $jobCircular->application_deadline = Carbon::parse($jobCircular->application_deadline)->format('Y-m-d');
        return view('company-user.job-circular.edit',compact('userCompany','companies', 'jobCircular'));
    }

    public function update(Request $request, $id)
    {
//        return $request;
        $request->merge([
            'application_deadline' => Carbon::parse($request->input('application_deadline'))->format('Y-m-d'),
        ]);
        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirement' => 'required|string',
            'responsibilities' => 'required|string',
            'type' => 'required|string|in:Full Time,Part Time,Remote,Internship',
            'location' => 'required|string|max:255',
            'salary_range' => 'required|string|max:255',
            'application_deadline' => 'required|date|after:today',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $jobCircular = JobCircular::findOrFail($id);
        JobCircular::updateJobCircular($request, $jobCircular->id);
        return redirect('/jobs/job-circular/list')->with('message','Company Updated Successfully');
    }

    public function delete($id)
    {
        $jobCircular = JobCircular::findOrFail($id);
        JobCircular::deleteJobCircular($jobCircular->id);
        return redirect('/jobs/job-circular/list')->with('message','Company Deleted Successfully');
    }

    public function jobApplicant()
    {
        $jobApplicants = JobApplication::all();
        return view('company-user.job-application.index',compact('jobApplicants'));
    }


    public function applicantDetail($id)
    {
        // Fetch the job application record using the ID
        $jobApplication = JobApplication::with([
            'user.education',
            'user.skills',
            'user.workExperiences',
            'user.certifications',
            'user.jobPreferences'
        ])->findOrFail($id);

        // Decode JSON fields safely
        $education = $this->safeJsonDecode($jobApplication->education);
        $skills = $this->safeJsonDecode($jobApplication->skill);
        $workExperience = $this->safeJsonDecode($jobApplication->work_experience);
        $certifications = $this->safeJsonDecode($jobApplication->certifications);
        $jobPreference = $this->safeJsonDecode($jobApplication->job_preference);

        // Pass data to the view
        return view('company-user.job-application.detail', [
            'jobApplication' => $jobApplication,
            'education' => $education,
            'skills' => $skills,
            'workExperience' => $workExperience,
            'certifications' => $certifications,
            'jobPreference' => $jobPreference,
        ]);
    }


    // Safe JSON decoding method
    private function safeJsonDecode($json)
    {
        if (is_array($json)) {
            return $json;
        }

        $decoded = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            return [];
        }

        return $decoded;
    }


}
