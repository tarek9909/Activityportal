<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'date_of_birth' => $faker->date(),
                'gender' => $faker->randomElement(['male', 'female']),
                'email' => $faker->unique()->safeEmail,
                'photo' => null,
                'password' => Hash::make('password'),
                'role' => 'member',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'mobile_number' => $faker->phoneNumber,
                'emergency_number' => $faker->phoneNumber,
                'nationality' => $faker->country,
            ]);
        }
}
}
