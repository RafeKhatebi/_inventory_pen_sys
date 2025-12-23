<?php

use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\BackupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CreditController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ActivityLogController;

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

// -------- AUTH (API ONLY) --------
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// -------- PROTECTED API ROUTES --------
Route::middleware('auth:sanctum')->group(function () {

    // Only Admins
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('products', ProductController::class);
        Route::get('products/search/{term}', [ProductController::class, 'search']);

        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('warehouse', WarehouseController::class);
        Route::apiResource('stocks', StockController::class);
        Route::get('stocks/current', [StockController::class, 'getCurrentStock']);
        Route::apiResource('users', UserController::class);
        Route::get('roles', [UserController::class, 'getRoles']);

        Route::apiResource('credits', CreditController::class);
        Route::get('customers/{customer}/credits', [CreditController::class, 'customerCredits']);

        // Reports
        Route::get('reports/customer-credits', [ReportController::class, 'customerCreditReport']);
        Route::get('reports/stock-movement', [ReportController::class, 'stockMovementHistory']);
        Route::get('reports/low-stock', [ReportController::class, 'lowStockAlert']);
        Route::get('reports/export', [ReportController::class, 'exportData']);

        // Activity Logs
        Route::apiResource('activity-logs', ActivityLogController::class)->only(['index', 'store']);
        
        // Backup Management
        Route::post('backup/create', [BackupController::class, 'createBackup']);
        Route::get('backup/list', [BackupController::class, 'listBackups']);
        Route::get('backup/download/{filename}', [BackupController::class, 'downloadBackup']);
    });

});
