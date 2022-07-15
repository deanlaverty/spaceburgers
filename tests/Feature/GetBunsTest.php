<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Bun;
use App\Models\Filling;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class GetBunsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_get_buns(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user
        );

        $bun = Bun::factory()->create();

        $response = $this->getJson('/api/buns');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'description' => $bun->description,
                        'price' => $bun->price,
                    ]
                ]
            ]);
    }

    public function test_unauthorised_user_cannot_access_buns(): void
    {
        $response = $this->getJson('/api/buns');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }
}
