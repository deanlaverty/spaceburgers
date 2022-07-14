<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class CreateUserTokenTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_token()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/sanctum/token', [
            'email' => $user->email,
            'password' => $user->password,
            'device_name' => 'mobile',
        ]);

        $response
            ->assertStatus(201);
    }
}
