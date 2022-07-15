<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Filling;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class GetFillingsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_get_fillings(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user
        );

        $filling = Filling::factory()->create();

        $response = $this->getJson('/api/fillings');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'description' => $filling->description,
                        'typeOfFilling' => $filling->typeOfFilling,
                        'price' => $filling->price,
                    ]
                ]
            ]);
    }
}
