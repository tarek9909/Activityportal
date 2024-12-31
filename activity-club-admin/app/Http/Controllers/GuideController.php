<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    // Display a listing of the guides
    public function index(Request $request)
{
    $query = Guide::with(['member.user', 'event']); // Start the query with eager loading

    // Check if there's a search input and column provided
    if ($request->has('search') && $request->has('column')) {
        $search = $request->input('search');
        $column = $request->input('column');

        if ($column == 'event_id') {
            $query->whereHas('event', function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        } else {
            $query->whereHas('member.user', function($q) use ($column, $search) {
                $q->where($column, 'LIKE', '%' . $search . '%');
            });
        }
    }

    // Paginate the results, limiting to 5 per page
    $guides = $query->paginate(5);

    return view('guides.index', compact('guides'));
}


    // Show the form to create a new guide


    // Store a new guide in the database
    public function create()
    {
        $events = Event::all(); // Load all events for dropdown
        return view('guides.create', compact('events'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'event_id' => 'required|exists:events,id',
            'joining_date' => 'required|date',
            'profession' => 'required|string|max:255',
        ]);
    
        // Check if the guide for this member and event already exists
        $existingGuide = Guide::where('member_id', $request->member_id)
                              ->where('event_id', $request->event_id)
                              ->first();
    
        if ($existingGuide) {
            // Redirect back with an error if the guide already exists
            return redirect()->back()->withErrors(['error' => 'This member is already a guide for this event.']);
        }
    
        // Create the new guide
        Guide::create([
            'member_id' => $request->member_id,
            'event_id' => $request->event_id,
            'joining_date' => $request->joining_date,
            'profession' => $request->profession,
        ]);
    
        return redirect()->route('admin.guides.index')->with('success', 'Guide created successfully.');
    }
    
    // Delete the guide from the database
    public function destroy($id)
    {
        $guide = Guide::findOrFail($id);
        $guide->delete();

        return redirect()->route('admin.guides.index')->with('success', 'Guide deleted successfully.');
    }
    public function getMembersByEvent($eventId)
    {
        $members = Member::where('event_id', $eventId)->with('user')->get();
        return response()->json($members); // Return members as JSON for AJAX to populate the dropdown
    }

    // Fetch detailed information about the selected member
    public function getMemberInfo($memberId)
    {
        $member = Member::with('user')->findOrFail($memberId);
        return response()->json($member); // Return the member's information as JSON
    }
}
