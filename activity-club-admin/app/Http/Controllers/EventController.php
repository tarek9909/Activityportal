<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Lookup; // Assuming categories are stored in Lookup table
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display a listing of the events
    public function index(Request $request)
{
    $query = Event::query(); // Start with a base query

    // Fetch the search term and column from the request
    $search = $request->input('search');
    $column = $request->input('column');

    // Query the events table, filtering by the selected column if search term is provided
    if ($search && $column) {
        if ($column == 'category_id') {
            $query->whereHas('category', function($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        } else {
            $query->where($column, 'LIKE', '%' . $search . '%');
        }
    }

    // Paginate the results, limit to 5 events per page
    $events = $query->paginate(5);

    return view('events.index', compact('events'));
}


    // Show the form to create a new event
// For create method
public function create()
{
    // Fetch event categories from the 'lookups' table where 'code' is 'event_category'
    $categories = Lookup::where('code', 'event_category')->get(); 

    // Pass the categories to the create view
    return view('events.create', compact('categories'));
}


// For edit method
public function edit($id)
{
    $event = Event::findOrFail($id); // Find the event by ID
    $categories = Lookup::where('code', 'event_category')->get(); // Fetch categories from Lookup table
    return view('events.edit', compact('event', 'categories'));
}


public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:lookups,id',
        'destination' => 'required|string',
        'date_from' => 'required|date',
        'date_to' => 'required|date',
        'cost' => 'required|numeric',
        'max_seats' => 'required|integer|min:1',
        'is_published' => 'required|boolean',
        'status' => 'required|in:planned,ongoing,completed,canceled',
    ]);

    // Create the new event with max seats and publish status
    Event::create($request->all());

    return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
}

public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);

    // Validate the updated data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:lookups,id',
        'destination' => 'required|string',
        'date_from' => 'required|date',
        'date_to' => 'required|date',
        'cost' => 'required|numeric',
        'max_seats' => 'required|integer|min:1',
        'is_published' => 'required|boolean',
        'status' => 'required|in:planned,ongoing,completed,canceled',
    ]);

    // Update the event
    $event->update($request->all());

    return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
}

    // Delete an event from the database
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete(); // Delete the event

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
