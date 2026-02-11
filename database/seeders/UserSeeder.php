<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@travel.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Partner Users
        User::factory(15)->create(['role' => 'partner']);

        // Regular Users
        User::factory(50)->create();
    }
}
