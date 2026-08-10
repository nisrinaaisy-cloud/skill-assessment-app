<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'adminsigma',
            'email' => 'adminsigma@mwt.local',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Leader',
            'username' => 'leader',
            'email' => 'leader@mwt.local',
            'role' => 'leader',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Foreman',
            'username' => 'foreman',
            'email' => 'foreman@mwt.local',
            'role' => 'foreman',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Kabag',
            'username' => 'kabag',
            'email' => 'kabag@mwt.local',
            'role' => 'kabag',
            'password' => Hash::make('12345678'),
        ]);
    }
}