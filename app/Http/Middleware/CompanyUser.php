<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CompanyUser
{
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
            return redirect()->route('university-user.dashboard');
        }
        //Normal User
        elseif ($userRole == 3){
            return $next($request);
        }
        elseif ($userRole == 4){
            return $next($request);
        }
    }

}
