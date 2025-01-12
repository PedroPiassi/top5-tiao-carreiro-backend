<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;
    public function test_register_success()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Mario',
            'email' => 'mario@gmail.com',
            'password' => '1234',
        ]);

        $response->assertStatus(201);
    }

    public function test_register_failure()
    {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => 'mario@gmail.com',
            'password' => '1234',
        ]);

        $response->assertJson([
            'status' => false,
            'message' => 'Todos os campos são obrigatórios.',
        ]);
    }
}
