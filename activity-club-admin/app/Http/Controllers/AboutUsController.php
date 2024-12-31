<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    // Display the about_us data
    public function index()
    {
        // Fetch the about_us data (assuming only one record exists)
        $aboutUs = AboutUs::first();
        
        return view('about_us.index', compact('aboutUs'));
    }

    // Update the about_us data
    public function update(Request $request)
    {
        // Validate input data
        $request->validate([
            'brief' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        // Get the first record (since there's likely only one)
        $aboutUs = AboutUs::first();

        // Update the record with new data
        $aboutUs->update([
            'brief' => $request->brief,
            'vision' => $request->vision,
            'mission' => $request->mission,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.about_us.index')->with('success', 'About Us updated successfully.');
    }
}
