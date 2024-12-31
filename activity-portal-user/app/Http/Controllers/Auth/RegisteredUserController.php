<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the input including the new fields
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum 8 characters
                'regex:/[a-z]/', // At least one letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*#?&]/' // At least one special character
            ],
            'password_confirmation' => 'required|same:password',
            'mobile_number' => 'required|string|max:15',
            'emergency_number' => 'required|string|max:15',
            'nationality' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_pictures', 'public');  // Store in public storage
        }
    
        // Create a new user with the new fields
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'date_of_birth' => $request->date_of_birth,
            'mobile_number' => $request->mobile_number,
            'emergency_number' => $request->emergency_number,
            'nationality' => $request->nationality,
            'photo' => $photoPath,  // Store the photo path
        ]);
    
        // Fire the registered event
        event(new Registered($user));
    
        // Log the user in and redirect
        Auth::login($user);
    
        return redirect()->route('landing.index');  // Adjust to the correct route name for your homepage
    }
    
}
