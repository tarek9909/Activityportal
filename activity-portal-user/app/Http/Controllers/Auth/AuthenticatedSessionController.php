<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt to authenticate using the provided credentials
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // If authentication fails, return a custom error message
            return back()->withErrors([
                'email' => 'Wrong email or password.',
            ])->withInput($request->only('email'));
        }
    
        // If authentication is successful, regenerate the session
        $request->session()->regenerate();
    
        // Redirect to the intended location (or homepage in this case)
        return redirect()->intended('/');
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
