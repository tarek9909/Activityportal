<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuideSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['member_id' => 10, 'event_id' => 1],
            ['member_id' => 11, 'event_id' => 2],
            ['member_id' => 12, 'event_id' => 3],
            ['member_id' => 13, 'event_id' => 5],
            ['member_id' => 17, 'event_id' => 1],
            ['member_id' => 19, 'event_id' => 2],
            ['member_id' => 20, 'event_id' => 3],
        ];

        foreach ($data as $entry) {
            DB::table('guides')->insert([
                'member_id'   => $entry['member_id'],
                'event_id'    => $entry['event_id'],
                'joining_date' => Carbon::now()->subDays(rand(1, 365)), // Random date within the last year
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}
