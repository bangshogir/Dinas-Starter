<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserWithRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('Super Admin');

        // Create Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('Admin');

        // Create Author user
        $author = User::create([
            'name' => 'Author User',
            'email' => 'author@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $author->assignRole('Author');
    }
}