<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful user registration.
     * This test verifies that a user can register with valid data and
     * that the user is stored in the database.
     */
    public function testUserRegistration()
    {
        // Arrange
        $user = User::factory()->make();

        // Act
        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Assert
        $response->assertStatus(302); // Redirection status
        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    /**
     * Test user registration with invalid data (unhappy path).
     * This test verifies that the registration fails when provided
     * with invalid data and appropriate validation errors are returned.
     */
    public function testUnhappyPathRegistration()
    {
        // Act
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        // Assert
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * Test successful user login.
     * This test verifies that a user can log in with valid credentials
     * and that the user is authenticated.
     */
    public function testLogin()
    {
        // Arrange
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        // Act
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assert
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login with invalid credentials (unhappy path).
     * This test verifies that login fails when provided with incorrect credentials
     * and appropriate validation errors are returned.
     */
    public function testLoginWithInvalidCredentials()
    {
        // Arrange
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        // Act
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        // Assert
        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertSessionHasErrors();
    }
}
