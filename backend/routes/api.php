<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });

    // Test route
    Route::get('/test', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'API is working',
            'user' => $request->user(),
        ]);
    });
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'IndoWater API is running',
        'version' => '1.0.0',
        'timestamp' => now()->toISOString(),
    ]);
});
