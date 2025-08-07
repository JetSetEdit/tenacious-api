<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ApiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user for API token generation
        $user = User::create([
            'name' => 'API Admin',
            'email' => 'admin@tenacioustapes.com',
            'password' => bcrypt('password'),
        ]);

        $this->command->info('API Admin user created successfully!');
        $this->command->info('User ID: ' . $user->id);
        $this->command->info('Email: ' . $user->email);
    }
} 