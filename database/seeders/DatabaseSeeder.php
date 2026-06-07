<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Call the RoleSeeder first
        $this->call([
            RoleSeeder::class,
        ]);

        // 2. Create the main Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Ensure no duplicates
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), 
                'email_verified_at' => now(),
            ]
        );

        // 3. Assign the admin role to this user
        $admin->assignRole('admin');
    }
}