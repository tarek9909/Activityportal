<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert multiple members with user_id and event_id associations
        DB::table('members')->insert([
            [
                'user_id' => 1, // Assuming this is the ID of the first user
                'event_id' => 1, // Assuming this is the ID of the first event
                'joining_date' => Carbon::now()->subDays(10), // Joining date 10 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2, // Assuming this is the ID of the second user
                'event_id' => 2, // Assuming this is the ID of the second event
                'joining_date' => Carbon::now()->subDays(5), // Joining date 5 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3, // Assuming this is the ID of the third user
                'event_id' => 1, // Rejoining event 1
                'joining_date' => Carbon::now()->subDays(15), // Joining date 15 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more members as needed...
        ]);
    }
}
