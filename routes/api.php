<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ParticipationApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\WinnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/participate', [ParticipationApiController::class, 'store']);
    Route::get('/participations', [ParticipationApiController::class, 'index']);

    // Select winner manually
    Route::post('/products/{productId}/select-winner', [WinnerController::class, 'selectManualWinner']);
    // Select winner automatically
    Route::post('/products/{productId}/select-random-winner', [WinnerController::class, 'selectAutomaticWinner']);

    // Get User Profile
    Route::get('/user/profile', [AuthController::class, 'profile']);

    // Update User Profile
    Route::put('/user/profile', [AuthController::class, 'update']);

    // Get All Products
    Route::get('/products', [ProductApiController::class, 'index']);

});
