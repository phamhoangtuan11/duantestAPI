<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'tp11102004@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@123456'),
                'role' => 'admin',
            ]
        );
    }
}
