<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CreditController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\UserController;

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
Route::get('/login', function () {
    return response()->json(['message' => 'Login endpoint - use POST method with credentials']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// -------- PROTECTED ROUTES --------
Route::middleware(['auth:sanctum'])->group(function () {

    // Only Admins
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('products', ProductController::class);
        Route::get('products/search/{term}', [ProductController::class, 'search']);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('warehouse', WarehouseController::class);
        Route::apiResource('users', UserController::class);
        Route::get('roles', [UserController::class, 'getRoles']);
        Route::apiResource('credits', CreditController::class);
        Route::get('customers/{customer}/credits', [CreditController::class, 'customerCredits']);
    });

});
