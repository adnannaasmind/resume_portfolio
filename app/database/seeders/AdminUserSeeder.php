<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Platform Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'preferred_locale' => 'en',
                'email_verified_at' => now(),
            ]
        );

        // Create Regular User (for testing)
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'preferred_locale' => 'en',
                'email_verified_at' => now(),
            ]
        );
    }
}
