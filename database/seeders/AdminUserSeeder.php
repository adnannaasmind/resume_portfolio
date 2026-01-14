<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Superadmin
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'preferred_locale' => 'en',
                'email_verified_at' => now(),
            ]
        );

        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
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
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'preferred_locale' => 'en',
                'email_verified_at' => now(),
            ]
        );

        // $this->command->info('✓ Created Superadmin: superadmin@example.com (password: password)');
        // $this->command->info('✓ Created Admin: admin@example.com (password: password)');
        // $this->command->info('✓ Created User: user@example.com (password: password)');
    }
}
