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
        $user = User::factory()->make();
        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    /**
     * Test user registration with invalid data (unhappy path).
     * This test verifies that the registration fails when provided
     * with invalid data and appropriate validation errors are returned.
     */
    public function testUnhappyPathRegistration()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * Test successful user login.
     * This test verifies that a user can log in with valid credentials
     * and that the user is authenticated.
     */
    public function testLogin()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
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
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);
        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertSessionHasErrors();
    }
}
