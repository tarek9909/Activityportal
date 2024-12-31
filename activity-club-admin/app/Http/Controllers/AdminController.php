<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Admin dashboard and Manage Admins
    public function index()
    {
        return view('admin.index'); // Render the admin dashboard with buttons only
    }
    
    public function manage(Request $request)
    {
        $query = Admin::query(); // Create an initial query
    
        // Fetch the search term and column from the request
        $search = $request->input('search');
        $column = $request->input('column');
    
        // If there is a search query, filter the admins
        if ($search && $column) {
            $query->where($column, 'LIKE', '%' . $search . '%');
        }
    
        // Paginate the results
        $admins = $query->paginate(5); // Paginate with 5 results per page
    
        // Return the manage view with the paginated admins
        return view('admin.manage', compact('admins'));
    }
    
    
    // Show the form to create a new admin
    public function create()
    {
        return view('admin.create');
    }

    // Store a new admin in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create the new admin and hash the password
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
    }

    // Show form to edit an existing admin
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    // Update an existing admin in the database
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed', // Password is optional
        ]);

        // Update the admin data (only hash the password if it's provided)
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    // Delete an admin from the database
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
}
