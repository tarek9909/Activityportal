<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        // Fetch all guides along with associated member and user information
        $guides = Guide::with('member.user')->get();

        // Pass the guides to the view
        return view('guides.index', compact('guides'));
    }
    public function show($id)
    {
        // Fetch the guide by ID, along with the associated member and user information
        $guide = Guide::with('member.user')->findOrFail($id);

        // Pass the guide details to the view
        return view('guides.show', compact('guide'));
    }
}
