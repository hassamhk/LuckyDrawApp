<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ParticipationApiController;
use App\Http\Controllers\WinnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::post('/login', function (Request $request) {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if (!Auth::attempt($request->only('email', 'password'))) {
//         return response()->json(['message' => 'Invalid credentials'], 401);
//     }

//     $user = $request->user();

//     $token = $user->createToken('API Token')->plainTextToken;

//     return response()->json([
//         'message' => 'Login successful',
//         'token' => $token,
//         'user' => $user,
//     ]);
// });


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/participate', [ParticipationApiController::class, 'store']);
    Route::get('/participations', [ParticipationApiController::class, 'index']);

    // Select winner manually
    Route::post('/products/{productId}/select-winner', [WinnerController::class, 'selectManualWinner']);
    // Select winner automatically
    Route::post('/products/{productId}/select-random-winner', [WinnerController::class, 'selectAutomaticWinner']);
});
