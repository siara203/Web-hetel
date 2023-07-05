<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder for admin user
        User::create([
            'full_name' => 'Admin',
            'password' => Hash::make('admin'),
            'address' => 'Admin',
            'phone' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
        ]);

        // Seeder for user1
        User::create([
            'full_name' => 'User1',
            'password' => Hash::make('12345678'),
            'address' => 'User1',
            'phone' => '123445678',
            'email' => 'user1@gmail.com',
            'role' => 'user',
        ]);

     
        
    }
}

