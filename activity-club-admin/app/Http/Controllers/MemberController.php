<?php

namespace App\Http\Controllers;
use App\Models\Guide;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with('user', 'event'); // Start a query with eager loading
    
        $search = $request->input('search');
        $column = $request->input('column');
    
        // Apply search and filtering logic
        if ($search && $column) {
            if ($column == 'event') {
                // Search by event name
                $query->whereHas('event', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
            } else {
                // Search by user columns (name or email)
                $query->whereHas('user', function ($q) use ($column, $search) {
                    $q->where($column, 'LIKE', '%' . $search . '%');
                });
            }
        }
    
        // Paginate the results (limit to 5 members per page)
        $members = $query->paginate(5);
    
        return view('members.index', compact('members'));
    }
    

    // Show the form to create a new member
    public function create()
    {
        $users = User::all(); // Fetch all users
        $events = Event::all(); // Fetch all events
        return view('members.create', compact('users', 'events')); // Pass users and events to the view
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure user_id exists in users table
            'event_id' => 'required|exists:events,id', // Ensure event_id exists in events table
            'joining_date' => 'required|date',
        ]);
    
        // Fetch the event to check enrollment limits
        $eventToJoin = Event::findOrFail($request->event_id);
    
        // Check if the number of enrolled users is less than the max_seats
        if ($eventToJoin->enrolled_users >= $eventToJoin->max_seats) {
            return redirect()->back()->withErrors(['This event has reached its maximum capacity.']);
        }
    
        // Check if the user is already enrolled in the selected event
        $existingMember = Member::where('user_id', $request->user_id)
                                ->where('event_id', $request->event_id)
                                ->exists();
    
        if ($existingMember) {
            return redirect()->back()->withErrors(['The user is already a member of this event.']);
        }
    
        // Check for date conflicts with other events the user is a member of
        $conflictingMember = Member::where('user_id', $request->user_id)
                                   ->whereHas('event', function ($query) use ($eventToJoin) {
                                       $query->whereBetween('date_from', [$eventToJoin->date_from, $eventToJoin->date_to])
                                             ->orWhereBetween('date_to', [$eventToJoin->date_from, $eventToJoin->date_to])
                                             ->orWhere(function ($query) use ($eventToJoin) {
                                                 $query->where('date_from', '<=', $eventToJoin->date_from)
                                                       ->where('date_to', '>=', $eventToJoin->date_to);
                                             });
                                   })
                                   ->exists();
    
        if ($conflictingMember) {
            return redirect()->back()->withErrors(['The user is already a member of an event that conflicts with the selected event dates.']);
        }
    
        // If no conflicts, create the member and link it to the selected user and event
        Member::create([
            'user_id' => $request->user_id,  // Link to the selected user
            'event_id' => $request->event_id, // Link to the selected event
            'joining_date' => $request->joining_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Insert into event_user table (enroll user in the event)
        DB::table('event_user')->insert([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Update the enrolled_users count for the event
        $eventToJoin->increment('enrolled_users');
    
        return redirect()->route('admin.members.index')->with('success', 'Member created and enrolled successfully.');
    }
    
    



    // Show the form to edit an existing member
    public function edit($id)
    {
        $member = Member::with('user')->findOrFail($id); // Fetch member with associated user data
        return view('members.edit', compact('member')); // Pass the member to the edit view
    }

    // Update an existing member in the database
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);  // Find the member
        $user = $member->user;  // Fetch the associated user
    
        // Validate the updated data
        $request->validate([
            // User fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            // Member-specific fields
            'joining_date' => 'required|date',
            'mobile_number' => 'required|string|max:15',
            'emergency_number' => 'required|string|max:15',
            'profession' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);
    
        // Update the user data (only hash the password if it's provided)
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);
    
        // Handle photo upload if present
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('photos', 'public');
            $member->photo = $photo;  // Update photo if a new one is uploaded
        }
    
        // Update the member data
        $member->update([
            'joining_date' => $request->joining_date,
            'mobile_number' => $request->mobile_number,
            'emergency_number' => $request->emergency_number,
            'profession' => $request->profession,
            'nationality' => $request->nationality,
        ]);
    
        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully.');
    }
    

   // Delete a member from the database
   public function destroy($id)
   {
       $member = Member::findOrFail($id);  // Find the member

       // Check if the member is a guide
       $guides = Guide::where('member_id', $member->id)->get();

       // If the member is a guide, delete the guide records
       if ($guides->isNotEmpty()) {
           foreach ($guides as $guide) {
               $guide->delete();  // Delete the guide
           }
       }

       // Finally, delete the member itself
       $member->delete();

       return redirect()->route('admin.members.index')->with('success', 'Member and related guide(s) deleted successfully.');
   }
}
