<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bun;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GetBunsController
{
    public function __invoke(Request $request): JsonResponse
    {
        $buns = Cache::remember('buns', 60 * 60, function () {
            return Bun::all();
        });

        return new JsonResponse([
            'data' => $buns
        ], 200);
    }
}