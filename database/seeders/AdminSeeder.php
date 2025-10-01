<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $adminRole = Role::where('name', 'admin')->first();

        // Fixed admin for login
        User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        //  admins for testing
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
            ]);
        }
    }
}
