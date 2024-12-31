<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        // Fetch the first record from the about_us table
        $aboutUs = AboutUs::first();

        // Return the view with the fetched data
        return view('aboutUs.index', ['aboutUs' => $aboutUs]);
    }
}
