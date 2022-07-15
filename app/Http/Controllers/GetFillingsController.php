<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Filling;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetFillingsController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse([
            'data' => Filling::all()
        ], 200);
    }
}