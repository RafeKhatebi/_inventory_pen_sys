<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    BackupController,
    CustomerController,
    ProductController,
    ReportController,
    StockController,
    UserController,
    WarehouseController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Protected API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Only Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        // Product Management
        Route::apiResource('products', ProductController::class);
        Route::get('products/search/{term}', [ProductController::class, 'search']);

        // Customer Management
        Route::apiResource('customers', CustomerController::class);

        // Stock Management
        Route::apiResource('stocks', StockController::class);
        Route::get('stocks/current', [StockController::class, 'getCurrentStock']);

        // Warehouse Management
        Route::apiResource('warehouse', WarehouseController::class);

        // User Management
        Route::apiResource('users', UserController::class);
        Route::get('roles', [UserController::class, 'getRoles']);

        /*
        |--------------------------------------------------------------------------
        | Reports API
        |--------------------------------------------------------------------------
        */
        Route::prefix('reports')->group(function () {
            Route::get('stock', [ReportController::class, 'stockReport']);
            Route::get('transactions', [ReportController::class, 'transactionReport']);
        });

        /* Backup Management API */

        Route::prefix('backup')->group(function () {
            Route::post('create', [BackupController::class, 'createBackup']);
            Route::get('list', [BackupController::class, 'listBackups']);
            Route::get('download/{filename}', [BackupController::class, 'downloadBackup']);
        });
    });
});