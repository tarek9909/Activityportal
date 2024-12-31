<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
{
    // Fetch only published events
    $events = Event::where('is_published', 1)->get(); // Fetch only published events

    return view('events.index', compact('events'));
}

    // Show individual event
    public function show($id)
    {
        $event = Event::findOrFail($id); // Fetch event or throw a 404 error
        return view('events.show', ['event' => $event]);
    }

    // Handle event enrollment
    public function enroll(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $userId = Auth::id();
    
        try {
            // 1. Check if the event is ongoing or completed
            if (in_array($event->status, ['ongoing', 'completed'])) {
                return redirect()->back()->withErrors(['You cannot enroll in an event that is already ongoing or completed.']);
            }
    
            // 2. Check if the event has reached the maximum number of participants
            if ($event->enrolled_users >= $event->max_seats) {
                return redirect()->back()->withErrors(['The event is fully booked and cannot accept more participants.']);
            }
    
            // 3. Check if the user is already enrolled in another event with conflicting dates
            $conflictingEvent = DB::table('event_user')
                ->join('events', 'events.id', '=', 'event_user.event_id')
                ->where('event_user.user_id', $userId)
                ->where(function ($query) use ($event) {
                    $query->whereBetween('events.date_from', [$event->date_from, $event->date_to])
                        ->orWhereBetween('events.date_to', [$event->date_from, $event->date_to])
                        ->orWhere(function ($query) use ($event) {
                            $query->where('events.date_from', '<=', $event->date_from)
                                ->where('events.date_to', '>=', $event->date_to);
                        });
                })
                ->exists();
    
            if ($conflictingEvent) {
                return redirect()->back()->withErrors(['You are already enrolled in another event during this time period.']);
            }
    
            // 4. Start transaction
            DB::beginTransaction();
    
            // Insert into the event_user table (enroll user in event)
            $insertResult = DB::table('event_user')->insert([
                'user_id' => $userId,
                'event_id' => $eventId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            if ($insertResult) {
                Log::info("User $userId successfully enrolled in event $eventId");
    
                // Add the user as a member to the members table
                DB::table('members')->insert([
                    'user_id' => $userId,
                    'event_id' => $eventId,
                    'joining_date' => now(), // Use current date as joining date
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                // Recalculate enrolled_users count and update the event
                $enrolledUsersCount = DB::table('event_user')->where('event_id', $eventId)->count();
                $event->enrolled_users = $enrolledUsersCount; // Update the event instance
                $event->save(); // Persist the change
    
                DB::commit(); // Commit the transaction
    
                return redirect()->route('events.index', $eventId)->with('success', 'You have successfully enrolled in the event.');
            } else {
                Log::error("Failed to insert enrollment for user $userId in event $eventId");
    
                // Rollback if insert failed
                DB::rollBack();
    
                return redirect()->back()->withErrors(['Failed to enroll in the event. Please try again later.']);
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
    
            Log::error("Error enrolling user: " . $e->getMessage());
    
            return redirect()->back()->withErrors(['Failed to enroll in the event due to an error: ' . $e->getMessage()]);
        }
    }
    

}
