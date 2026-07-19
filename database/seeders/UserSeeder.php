<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gscri.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gscri.com'],
            [
                'name' => 'User',
                'password' => Hash::make('User123!'),
                'role' => 'user',
            ]
        );
    }
}