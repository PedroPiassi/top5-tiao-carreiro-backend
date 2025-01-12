<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123')
        ]);

        $loginData = [
            'email' => 'user@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'token',
                 ]);
    }

    public function test_logout()
    {
        list($responseLogin, $user) = $this->login();

        $token = $responseLogin->json('token');

        $responseLogout = $this->withToken($token)->postJson("/api/logout/{$user->id}");

        $responseLogout->assertStatus(201);
    }
}
