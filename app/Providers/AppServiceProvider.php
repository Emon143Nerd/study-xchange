<?php

namespace App\Providers;

use App\Models\NormalUser\ResourceSpace\ResourceSpaceJoiningRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\NormalUser\ResearchProjectRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        // Research Project Request Notifications
        View::composer('*', function ($view) {
            // Research Project Notifications
            $notifications = ResearchProjectRequest::with('project')
                ->where('user_id', auth()->id())
                ->where('status', 1)
                ->get();
            $notificationCount = $notifications->count();

            $resourceSpaceNotifications = ResourceSpaceJoiningRequest::with('resourceSpace')
                ->where('resource_space_creator_id', auth()->id()) // Changed from user_id to resource_space_creator_id
                ->where('status', 'pending') // Changed 'status' to match the enum in the migration
                ->get();
            $resourceSpaceNotificationCount = $resourceSpaceNotifications->count();

            // Retrieve user notifications
            if (auth()->check()) {
                // Retrieve user notifications
                $userNotifications = auth()->user()->notifications()->whereNull('read_at')->get();
            } else {
                // Handle the case where no user is logged in
                return redirect()->route('login')->with('error', 'You must be logged in to view notifications.');
            }
            $userNotificationCount = $userNotifications->count();

            // Pass both notification types and counts to the views
            $view->with([
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
                'resourceSpaceNotifications' => $resourceSpaceNotifications,
                'resourceSpaceNotificationCount' => $resourceSpaceNotificationCount,
                'userNotifications' => $userNotifications,
                'userNotificationCount' => $userNotificationCount,
            ]);
        });
    }
}
