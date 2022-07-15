<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bun;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetBunsController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse([
            'data' => Bun::all()
        ], 200);
    }
}