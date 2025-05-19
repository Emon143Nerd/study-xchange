<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCertification;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $certifications = UserCertification::where('user_id', auth()->id())->get();
        $userEducations = auth()->user()->educations;
        $userSkills = auth()->user()->skills;
        $workExperiences = auth()->user()->workExperiences;
        $userJobPreferences = auth()->user()->jobPreferences;
        return view('normal-user.edit-profile.index',compact('user','userEducations', 'userSkills', 'workExperiences', 'userJobPreferences','certifications'));
    }


    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        User::updateUser($request, $user->id);
        return back()->with('message','Personal information updated successfully');
    }

    public function activity($id)
    {
        $user = User::find($id);
        return view('normal-user.edit-profile.activity',compact('user'));
    }
}
