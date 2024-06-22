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

    /**
     * Test to check the recipes index view (happy path).
     * This test verifies that the recipes index view displays correctly
     * when a user is authenticated and recipes are present in the database.
     */
    public function testRecipesIndexView()
    {
        // Arrange
        Recipe::factory()->count(5)->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->get(route('recipes.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('recipes.index');
        $response->assertSee('Recipes');
        $response->assertSee('Create New Recipe');

        $recipes = Recipe::all();
        foreach ($recipes as $recipe) {
            $response->assertSee($recipe->name);
        }
    }

    /**
     * Unhappy path test for recipes index view without authentication.
     * This test verifies that the request to the recipes index view redirects
     * to the login page when the user is not authenticated.
     */
    public function testRecipesIndexViewWithoutAuthentication()
    {
        // Act
        $response = $this->get(route('recipes.index'));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test to check the recipes show view (happy path).
     * This test verifies that the recipes show view displays correctly
     * when a user is authenticated and the recipe exists in the database.
     */
    public function testRecipesShowView()
    {
        // Arrange
        $recipe = Recipe::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->get(route('recipes.show', $recipe->id));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('recipes.show');
        $response->assertSee($recipe->name);
        $response->assertSee($recipe->description);
    }

    /**
     * Unhappy path test for recipes show view with non-existent recipe.
     * This test verifies that the request to the recipes show view returns
     * a 404 status when the recipe does not exist.
     */
    public function testRecipesShowViewWithNonExistentRecipe()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->get(route('recipes.show', 999));

        // Assert
        $response->assertStatus(404);
    }

    /**
     * Unhappy path test for recipes show view without authentication.
     * This test verifies that the request to the recipes show view redirects
     * to the login page when the user is not authenticated.
     */
    public function testRecipesShowViewWithoutAuthentication()
    {
        // Arrange
        $recipe = Recipe::factory()->create();

        // Act
        $response = $this->get(route('recipes.show', $recipe->id));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
