<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating an Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tyro.com',
            'password' => Hash::make('123456'),  // Hashing the password
            'role' => 'Admin',
        ]);

        // Creating a Manager User
        User::create([
            'name' => 'Manager',
            'email' => 'manager@tyro.com',
            'password' => Hash::make('123456'),  // Hashing the password
            'role' => 'Manager',
        ]);

        // Creating an Employee User
        User::create([
            'name' => 'Employee',
            'email' => 'employee@tyro.com',
            'password' => Hash::make('123456'),  // Hashing the password
            'role' => 'Employee',
        ]);
    }
}
