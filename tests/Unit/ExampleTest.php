<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }


    // Test to check the recipes index view
    public function testRecipesIndexView()
    {
        Recipe::factory()->count(5)->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('recipes.index'));
        $response->assertStatus(200);
        $response->assertViewIs('recipes.index');
        $response->assertSee('Recipes');
        $response->assertSee('Create New Recipe');
        $recipes = Recipe::all();
        foreach ($recipes as $recipe) {
            $response->assertSee($recipe->name);
        }
    }

    // Unhappy path test for recipes index view without authentication
    public function testRecipesIndexViewWithoutAuthentication()
    {
        $response = $this->get(route('recipes.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    // Test to check the recipes show view
    public function testRecipesShowView()
    {
        $recipe = Recipe::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('recipes.show', $recipe->id));
        $response->assertStatus(200);
        $response->assertViewIs('recipes.show');
        $response->assertSee($recipe->name);
        $response->assertSee($recipe->description);
    }

    // Unhappy path test for recipes show view with non-existent recipe
    public function testRecipesShowViewWithNonExistentRecipe()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('recipes.show', 999));
        $response->assertStatus(404);
    }

    // Unhappy path test for recipes show view without authentication
    public function testRecipesShowViewWithoutAuthentication()
    {
        $recipe = Recipe::factory()->create();
        $response = $this->get(route('recipes.show', $recipe->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
