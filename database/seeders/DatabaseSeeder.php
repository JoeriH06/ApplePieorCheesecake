<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uncomment this line if you want to create multiple user records
        // User::factory(10)->create();

        // Create a single test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Call the RecipeSeeder to seed the recipes table
        $this->call([
            RecipeSeeder::class,
        ]);
    }
}
