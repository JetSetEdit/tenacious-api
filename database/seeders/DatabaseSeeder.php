<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create API user first
        $this->call([
            ApiUserSeeder::class,
        ]);

        // Seed brand and product data
        $this->call([
            BrandSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
