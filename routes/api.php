<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\WarehouseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::get('/test-route', function () {
    return response()->json([
        'message' => 'API routes are loading!'
    ]);
});

// -------- AUTH --------
Route::get('/login', function() { return response()->json(['message' => 'Login endpoint - use POST method with credentials']); });
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// -------- PROTECTED ROUTES --------
Route::middleware(['auth:sanctum'])->group(function () {

    // Only Admins
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('products', ProductController::class);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('warehouse', WarehouseController::class);
    });

});
