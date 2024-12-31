<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Make sure to include this if you're using Auth facade

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Use auth()->user() or Auth::user() to check if the logged-in user is an admin
        if (Auth::check() && Auth::user()->role === 'Admin') {
            return $next($request);
        }

        // Redirect to homepage or any other route if the user is not an admin
        return redirect('/');
    }
}
