<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UniversityUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is not logged in
        if(!Auth::check()){
            return redirect('login');
        }
        $userRole = Auth::user()->role;

        //Super Admin
        if ($userRole == 1)
        {
            return redirect()->route('super-admin.dashboard');
        }
        //University User
        elseif ($userRole == 2){
            return $next($request);
        }
        //Normal User
        elseif ($userRole == 3){
            return redirect()->route('normal-user.dashboard');
        }
        elseif ($userRole == 4){
            return redirect()->route('company-user.dashboard');
        }
    }
}
