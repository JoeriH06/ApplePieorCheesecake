<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Faker\Factory as Faker;


class RecipeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Recipe::factory()->count(10)->create();
    }
}
