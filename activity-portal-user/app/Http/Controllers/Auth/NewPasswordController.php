<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',              // Must be at least 8 characters
                'regex:/[a-z]/',      // Must contain at least one letter
                'regex:/[0-9]/',      // Must contain at least one number
                'regex:/[@$!%*#?&]/', // Must contain at least one special character
            ],
        ], [
            'password.min' => 'Must be at least 8 characters, contain 1 letter, 1 number, and 1 special character.',
            'password.regex' => 'Must be at least 8 characters, contain 1 letter, 1 number, and 1 special character.',
        ]);
    
        // Attempt to reset the user's password.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
    
                event(new PasswordReset($user));
            }
        );
    
        // Handle the result of the password reset attempt.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
    

}
