<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LookupSeeder extends Seeder
{
    public function run()
    {
        DB::table('lookups')->insert([
            ['code' => 'event_category', 'name' => 'Camping', 'order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'event_category', 'name' => 'Hiking', 'order' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'event_category', 'name' => 'Swimming', 'order' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
