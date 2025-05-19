<?php

namespace App\Http\Controllers;

use App\Models\Job\JobCircular;
use App\Models\NormalUser\Question;
use App\Models\NormalUser\ResourceSpace\ResourceSpace;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePost;
use App\Models\University\AdmissionCircular;
use App\Models\User;
use App\Models\UserCertification;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Fetch counts for the statistics
        $userCount = User::count();
        $questionCount = Question::count();
        $resourceSpaceCount = ResourceSpace::count();
        $jobCircularCount = JobCircular::count();

        // Retrieve authenticated user data
        $user = auth()->user();

        $certifications = UserCertification::where('user_id', $user->id)->get();
        $educations = $user->educations; // Assuming a relationship exists
        $skills = $user->skills; // Assuming a relationship exists
        $workExperiences = $user->workExperiences; // Assuming a relationship exists
        $achievements = $user->achievements; // Assuming a relationship exists

        // Get all your random items as before
        $randomResourceSpaces = ResourceSpace::where('type', 1)
            ->inRandomOrder()
//            ->limit(4)
            ->get()
            ->map(function ($resourceSpace) {
                $resourceSpace->postCount = ResourceSpacePost::where('resource_space_id', $resourceSpace->id)->count();
                $resourceSpace->memberCount = DB::table('resource_space_users')->where('resource_space_id', $resourceSpace->id)->count();
                $resourceSpace->type = 'resource_space';
                return $resourceSpace;
            });

        $randomAdmissionCirculars = AdmissionCircular::with('university:id,name')
            ->select('id', 'university_id', 'title', 'description', 'start_date', 'image', 'slug')
            ->inRandomOrder()
//            ->limit(4)
            ->get()
            ->map(function ($item) {
                $item->type = 'admission';
                return $item;
            });

        $randomQuestions = Question::with('tags')
            ->inRandomOrder()
//            ->limit(4)
            ->get()
            ->map(function ($item) {
                $item->type = 'question';
                return $item;
            });

        $userId = auth()->id();
        $userEmail = auth()->user()->email;

        $randomJobs = JobCircular::inRandomOrder()
//            ->limit(4)
            ->get()
            ->map(function ($item) {
                $item->type = 'job';
                return $item;
            });

        // Combine all items into a single collection
        $allItems = collect([])
            ->concat($randomResourceSpaces)
            ->concat($randomAdmissionCirculars)
            ->concat($randomQuestions)
            ->concat($randomJobs);

        // Shuffle the combined collection
        $shuffledItems = $allItems->shuffle();

        return view('normal-user.home.index', compact(
            'shuffledItems',
            'userCount',
            'questionCount',
            'resourceSpaceCount',
            'jobCircularCount',
            'certifications',
            'educations',
            'skills',
            'workExperiences',
            'achievements',
            'user',
        ));
    }


    public static function getUserNotifications($userId)
    {
        return self::where('user_id', $userId)
            ->where('status', 1) // Show only pending requests
            ->with('project')
            ->get();
    }



//    public static function getUserNotifications($userId)
//    {
//        // Fetch project join notifications (previous feature)
//        $projectNotifications = self::where('user_id', $userId)
//            ->where('status', 1) // Show only pending requests
//            ->with('project') // Ensure relationship is defined in your model
//            ->get();
//
//        // Fetch resource space join notifications
//        $resourceSpaceNotifications = ResourceSpaceJoiningRequest::whereHas('resourceSpace', function ($query) use ($userId) {
//            $query->where('user_id', $userId); // Only resource spaces managed by this user
//        })
//            ->where('status', 'pending') // Only show pending requests
//            ->with(['resourceSpace', 'user']) // Include related resource space and user
//            ->get();
//
//        // Merge both project and resource space notifications
//        return $projectNotifications->merge($resourceSpaceNotifications);
//    }


}
