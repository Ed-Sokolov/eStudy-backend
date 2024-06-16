<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TestAuth extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register_a_user(): void
    {
        $password = Hash::make('password');

        $userData = [
            'name' => 'new_test_user2',
            'email' => 'test2@khai.edu',
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $response = $this->postJson('/register', $userData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', ['name' => 'new_test_user']);
    }

    public function test_register_existing_user_email(): void
    {
        $existingUser = User::factory()->create();

        $password = Hash::make('password');

        $userData = [
            'name' => $existingUser->name,
            'email' => 'test@khai.edu',
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $response = $this->postJson('/register', $userData);

        $response->assertStatus(422);
    }
}
