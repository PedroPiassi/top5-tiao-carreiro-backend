<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    protected function login($email = 'user@example.com', $password = 'password123')
    {
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        return [$response, $user];
    }

    protected function loginAdmin($email = 'admin@gmail.com', $password = 'password123')
    {
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'role' => "admin",
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        return [$response, $user];
    }
}
