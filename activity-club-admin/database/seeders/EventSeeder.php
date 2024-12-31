<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'name' => 'Mountain Hiking',
                'description' => 'A 3-day hiking event through the Rocky Mountains.',
                'category_id' => 1, // Assuming this is the category id for "Hiking"
                'destination' => 'Rocky Mountains',
                'date_from' => '2024-10-10',
                'date_to' => '2024-10-12',
                'cost' => 200,
                'status' => 'planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'River Rafting',
                'description' => 'Experience the thrill of rafting on the Amazon River.',
                'category_id' => 2, // Assuming this is the category id for "Rafting"
                'destination' => 'Amazon River',
                'date_from' => '2024-11-05',
                'date_to' => '2024-11-07',
                'cost' => 300,
                'status' => 'ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desert Safari',
                'description' => 'A fun and adventurous safari through the Sahara Desert.',
                'category_id' => 3, // Assuming this is the category id for "Safari"
                'destination' => 'Sahara Desert',
                'date_from' => '2024-12-01',
                'date_to' => '2024-12-03',
                'cost' => 400,
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more event records as needed
        ]);
    }
}
