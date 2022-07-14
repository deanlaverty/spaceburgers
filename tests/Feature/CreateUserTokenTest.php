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

    public function test_user_can_create_token(): void
    {
        $password = $this->faker()->password;

        $user = User::factory()->create([
            'password' => $password,
        ]);

        $response = $this->postJson('/api/sanctum/token', [
            'email' => $user->email,
            'password' => $password,
            'device_name' => $this->faker->title,
        ]);

        $response
            ->assertStatus(200);
    }

    public function test_user_cannot_create_token_with_incorrect_password(): void
    {
        $password = $this->faker()->password;

        $user = User::factory()->create([
            'password' => $password,
        ]);

        $response = $this->postJson('/api/sanctum/token', [
            'email' => $user->email,
            'password' => $this->faker()->password,
            'device_name' => $this->faker->title,
        ]);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The provided credentials are incorrect.',
            ]);
    }

    public function test_user_cannot_create_token_if_they_dont_exist(): void
    {
        $response = $this->postJson('/api/sanctum/token', [
            'email' => $this->faker()->email,
            'password' => $this->faker()->password,
            'device_name' => $this->faker->title,
        ]);

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'User not found.',
            ]);
    }

    /**
     * @test
     * @dataProvider createTokenValidationProvider
     */
    public function test_user_cannot_create_token_without_valid_payload($formInput): void
    {
        $response = $this->postJson('/api/sanctum/token', [
            $formInput => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors($formInput);
    }

    public function createTokenValidationProvider(): array
    {
        return [
            ['email'],
            ['password'],
            ['device_name'],
        ];
    }
}
