<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
        ];
    }
}
