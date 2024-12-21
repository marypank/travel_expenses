<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExternalApi\CurrencyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SourceExpenseController;
use App\Http\Controllers\TripDetailController;
use App\Http\Controllers\TripExpenseController;
use App\Http\Controllers\TripStatusController;
use App\Http\Controllers\TagController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/user',  function (Request $request) {
        return $request->user();
    });

    Route::prefix('trips')->group(function () {
        Route::get('/show-by-slug', [TripController::class, 'showBySlug']);
        Route::post('/tag', [TripController::class, 'tag']);

        Route::apiResource('/', TripController::class);
    });

    Route::prefix('trip-details')->group(function () {
        Route::post('/tag', [TripDetailController::class, 'tag']);

        Route::apiResource('/', TripDetailController::class);
    });

    Route::prefix('trip-expenses')->group(function () {
        Route::post('/tag', [TripExpenseController::class, 'tag']);

        Route::apiResource('/', TripExpenseController::class);
    });

    Route::apiResource('source-expenses', SourceExpenseController::class);
    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('trip-statuses', TripStatusController::class);
    Route::apiResource('tags', TagController::class);

    Route::prefix('reports')->group(function () {
        Route::get('/trip/{id}', [ReportController::class, 'trip']);

    });
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


