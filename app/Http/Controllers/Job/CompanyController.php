<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Job\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('user_id', auth()->id())->get();
        return view('company-user.company.index',compact('companies'));
    }

    public function create()
    {
        return view('company-user.company.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'=> 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'about' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // optional image validation
        ]);

        Company::newCompany($request);
        return redirect()->back()->with('message','Company Created Successfully');
    }

    public function edit($id)
    {
        $company = Company::where('id',$id)->firstOrFail();
        return view('company-user.company.edit',compact('company'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'industry' => 'required|string',
            'location' => 'required|string|max:255',
            'about' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $company = Company::findOrFail($id);
        Company::updateCompany($request, $company->id);
        return redirect('/jobs/company/list')->with('message','Company Updated Successfully');
    }

    public function delete($id)
    {
        $company = Company::findOrFail($id);
        Company::deleteCompany($id);
        return redirect('/jobs/company/list')->with('message','Company deleted Successfully');
    }
}
