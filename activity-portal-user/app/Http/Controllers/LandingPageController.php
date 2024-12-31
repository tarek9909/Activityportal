<?php

namespace App\Http\Controllers;

use App\Models\AboutUs; // Import the AboutUs model
use App\Models\Event;   // Import the Event model
use Illuminate\Http\Request;
use App\Models\Guide; // Import the Guide model
use App\Models\Member; // Import the Member model
use App\Models\User;
class LandingPageController extends Controller
{
    public function index()
    {
        // Fetch the first record from the about_us table using Eloquent
        $aboutUs = AboutUs::first();

        // Fetch up to 4 published events from the 'events' table
        $events = Event::where('is_published', 1)
                       ->latest()
                       ->take(4)
                       ->get();

        // Fetch all guides along with their associated users
        $guides = Guide::with(['member' => function($query) {
            $query->with('user'); // Get the user associated with the member
        }])->take(3)->get();

        // Pass the data to the view
        return view('landing.index', [
            'aboutUs' => $aboutUs,
            'events' => $events,
            'guides' => $guides
        ]);
    }
    
}
