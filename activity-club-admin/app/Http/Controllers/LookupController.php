<?php

namespace App\Http\Controllers;

use App\Models\Lookup;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    // Display a listing of the lookups
    public function index(Request $request)
    {
        $query = Lookup::query(); // Initialize a query for the Lookup model
    
        $search = $request->input('search');
        $column = $request->input('column');
    
        // Apply filtering logic if search term and column are provided
        if ($search && $column) {
            $query->where($column, 'LIKE', '%' . $search . '%');
        }
    
        // Paginate the results (limit to 5 per page)
        $lookups = $query->paginate(5);
    
        return view('lookups.index', compact('lookups'));
    }
    

    // Show the form to create a new lookup
    public function create()
    {
        return view('lookups.create'); // Show the create form
    }

    public function store(Request $request)
    {
        // Validate the incoming request with lowercase field names
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);
    
        // Create the new lookup with the validated data
        Lookup::create($request->all());
    
        // Redirect back to the index page with a success message
        return redirect()->route('admin.lookups.index')->with('success', 'Lookup created successfully.');
    }
    
    
    
    

    // Show the form to edit an existing lookup
    public function edit($id)
    {
        $lookup = Lookup::findOrFail($id); // Find the lookup by its ID or throw a 404 error
        return view('lookups.edit', compact('lookup')); // Pass the lookup to the edit view
    }
    
    // Update an existing lookup in the database
    public function update(Request $request, $id)
    {
        $lookup = Lookup::findOrFail($id);
    
        // Validate the request with lowercase field names
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);
    
        // Update the lookup with the validated data
        $lookup->update($request->all());
    
        return redirect()->route('admin.lookups.index')->with('success', 'Lookup updated successfully.');
    }
    

    // Delete a lookup from the database
    public function destroy($id)
    {
        $lookup = Lookup::findOrFail($id);
        $lookup->delete(); // Delete the lookup

        return redirect()->route('admin.lookups.index')->with('success', 'Lookup deleted successfully.');
    }
}
