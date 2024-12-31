<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    \App\Models\Admin::create([
        'name' => 'Admin',
        'email' => 'admin@club.com',
        'password' => bcrypt('password'), // Use a secure password
    ]);
}

}
