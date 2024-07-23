<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExternalApi\CurrencyController;
use App\Http\Controllers\SourceExpenseController;
use App\Http\Controllers\TripDetailController;
use App\Http\Controllers\TripExpenseController;
use App\Http\Controllers\TripStatusController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/user',  function (Request $request) {
        return $request->user();
    });

    Route::get('/trips/show-by-slug', [TripController::class, 'showBySlug']);

    Route::apiResource('trips', TripController::class);
    Route::apiResource('trip-details', TripDetailController::class);
    Route::apiResource('trip-expenses', TripExpenseController::class);
    Route::apiResource('source-expenses', SourceExpenseController::class);
    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('trip-statuses', TripStatusController::class);

    //
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


