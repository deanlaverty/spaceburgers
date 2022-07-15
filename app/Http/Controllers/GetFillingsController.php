<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Filling;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GetFillingsController
{
    public function __invoke(Request $request): JsonResponse
    {
        $fillings = Cache::remember('fillings', 60 * 60, function () {
            return Filling::all();
        });

        return new JsonResponse([
            'data' => $fillings
        ], 200);
    }
}