<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateOrderAction;
use App\DTOs\OrderData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateOrderController
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fillings' => 'required|array',
            'fillings.*' => 'exists:fillings,pkid',
            'bun' => 'required|exists:buns,pkid',
        ]);

        $order = (new CreateOrderAction())->handle(new OrderData(...$validated));

        return new JsonResponse([
            'message' => 'Order created successfully!.'
        ], 200);
    }
}