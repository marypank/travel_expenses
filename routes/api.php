<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\AuthController;
use App\Models\TripDetail;
use App\Models\TripExpense;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/user',  function (Request $request) {
        return $request->user();
    });

    // Route::group(['prefix'=> ''], function () {});

    Route::get('/trips/show-by-slug', [TripController::class, 'showBySlug']);
    Route::get('/trips/get-trips-by-user', [TripController::class, 'getTripsByUser']);

    Route::apiResource('trips', TripController::class);
    Route::apiResource('trip-details', TripDetail::class);
    Route::apiResource('trip-expenses', TripExpense::class);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


