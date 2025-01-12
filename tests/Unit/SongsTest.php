<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SongsTest extends TestCase
{
    use RefreshDatabase;
    public function teste_register_song(): void
    {
        list($responseLogin, $user) = $this->login();

        $token = $responseLogin->json('token');

        $response = $this->withToken($token)->postJson('/api/song', [
            "url" => "https://www.youtube.com/watch?v=hob2Q2wEwU8"
        ]);

        $response->assertStatus(201);
    }

    public function teste_approve_song(): void
    {
        list($responseLogin) = $this->loginAdmin();

        $token = $responseLogin->json('token');

        $this->withToken($token)->postJson('/api/song', [
            "url" => "https://www.youtube.com/watch?v=hob2Q2wEwU8"
        ]);

        $approveResponse = $this->putJson('/api/song/approve/1');

        $approveResponse->assertStatus(200);
    }

    public function teste_reject_song(): void
    {
        list($responseLogin) = $this->loginAdmin();

        $token = $responseLogin->json('token');

        $this->withToken($token)->postJson('/api/song', [
            "url" => "https://www.youtube.com/watch?v=hob2Q2wEwU8"
        ]);

        $approveResponse = $this->putJson('/api/song/reject/1');

        $approveResponse->assertStatus(200);
    }

    public function teste_delete_song(): void
    {
        list($responseLogin) = $this->loginAdmin();

        $token = $responseLogin->json('token');

        $this->withToken($token)->postJson('/api/song', [
            "url" => "https://www.youtube.com/watch?v=hob2Q2wEwU8"
        ]);

        $approveResponse = $this->deleteJson('/api/song/1');

        $approveResponse->assertStatus(200);
    }

    public function teste_getall_song(): void
    {
        list($responseLogin) = $this->loginAdmin();

        $token = $responseLogin->json('token');

        $this->withToken($token)->postJson('/api/song', [
            "url" => "https://www.youtube.com/watch?v=hob2Q2wEwU8"
        ]);

        $approveResponse = $this->getJson('/api/songs/approved');

        $approveResponse->assertStatus(200);
    }

    public function teste_getPerStatus_song(): void
    {
        list($responseLogin) = $this->loginAdmin();

        $token = $responseLogin->json('token');

        $this->withToken($token)->postJson('/api/song', [
            "url" => "https://www.youtube.com/watch?v=hob2Q2wEwU8"
        ]);

        $approveResponse = $this->getJson('/api/song/approved', [
            "page" => 1,
            "limit" => 5
        ]);

        $approveResponse->assertStatus(200);
    }
}
