<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = range(4, 21); // User IDs from 4 to 21
        $eventIds = [1, 2, 3, 5]; // Event IDs: 1, 2, 3, and 5

        // Create random enrollments
        foreach ($userIds as $userId) {
            // Randomly assign the user to one or more events
            $eventsForUser = array_rand(array_flip($eventIds), rand(1, 4)); // Enroll in 1 to 4 events

            // Ensure eventsForUser is always an array
            $eventsForUser = is_array($eventsForUser) ? $eventsForUser : [$eventsForUser];

            foreach ($eventsForUser as $eventId) {
                DB::table('event_user')->insert([
                    'user_id' => $userId,
                    'event_id' => $eventId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
