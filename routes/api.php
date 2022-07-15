<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserTokenController;
use App\Http\Controllers\GetFillingsController;
use App\Http\Controllers\GetBunsController;
use App\Http\Controllers\CreateOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sanctum/token', CreateUserTokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/fillings', GetFillingsController::class);
    Route::get('/buns', GetBunsController::class);
    Route::post('/order', CreateOrderController::class);
});