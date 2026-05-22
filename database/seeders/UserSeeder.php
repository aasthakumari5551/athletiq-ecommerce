<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@athletiq.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Regular users
        User::factory(10)->create(['role' => 'user']);
    }
}