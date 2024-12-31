<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Show the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'mobile_number' => 'required|string|max:15',
            'emergency_number' => 'nullable|string|max:15',
            'nationality' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Profile picture validation
        ]);

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            // Delete the old profile picture if it exists
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            // Store the new profile picture
            $path = $request->file('photo')->store('profile_pictures', 'public');

            // Update the user's photo path
            $user->photo = $path;
        }

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'mobile_number' => $request->mobile_number,
            'emergency_number' => $request->emergency_number,
            'nationality' => $request->nationality,
        ]);

        return redirect()->back()->with('status', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy()
    {
        $user = Auth::user();

        // Log out the user before deleting their account
        Auth::logout();

        // Delete the user account
        $user->delete();

        return redirect('/')->with('status', 'Account deleted successfully.');
    }
}
