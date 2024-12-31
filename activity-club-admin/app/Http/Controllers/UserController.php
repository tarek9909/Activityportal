<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::query();

    if ($request->has('search') && $request->has('column')) {
        $search = $request->input('search');
        $column = $request->input('column');

        // Check if the column exists in the model
        if (in_array($column, ['name', 'email', 'mobile_number'])) {
            $query->where($column, 'like', '%' . $search . '%');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Invalid column selected.');
        }
    }

    $users = $query->paginate(5);
    return view('users.index', compact('users'));
}


    // Show the form for creating a new user
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'mobile_number' => 'required|string|max:15',
            'emergency_number' => 'required|string|max:15',
            'nationality' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048', // Validate the photo
        ]);
    
        // Handle the photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            Log::info('Photo uploaded to: ' . $photoPath); // This logs the storage path
        }
        
        // Create the user and store the path of the photo
        User::create([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'emergency_number' => $request->emergency_number,
            'nationality' => $request->nationality,
            'photo' => $photoPath, // Store the relative path of the photo
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
    
    
    
    


    // Show the form for editing a user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update an existing user in the database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validate the updated data
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'mobile_number' => 'nullable|string|max:15',
            'emergency_number' => 'nullable|string|max:15',
            'nationality' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);
    
        // Handle photo upload if present
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
    
            // Store the new photo
            $photo = $request->file('photo')->store('photos', 'public');
            $user->photo = $photo;
        }
    
        // Only update the password if it's provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Update the user data
        $user->update($request->except(['password', 'photo'])); // Exclude password and photo, they're handled separately
    
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    
    
    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
    
        // Check if the user has associated members
        $members = $user->members;
        
        if ($members->isNotEmpty()) {
            foreach ($members as $member) {
                // Check if the member has any associated guides and delete them
                if ($member->guides()->exists()) {
                    $member->guides()->delete(); // Delete associated guides for the member
                }
                // Delete the member itself
                $member->delete();
            }
        }
    
        // Delete the user's photo if it exists
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }
    
        // Finally, delete the user
        $user->delete();
    
        return redirect()->route('admin.users.index')->with('success', 'User and related records deleted successfully.');
    }
    
}
