<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/user',  function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/trips', TripController::class);
    Route::apiResource('/trip-expenses', TripExpenseController::class);
    Route::apiResource('/tags', TagController::class);
    Route::apiResource('/currencies', CurrencyController::class);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
