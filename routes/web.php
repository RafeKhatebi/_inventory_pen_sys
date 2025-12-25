<?php

use App\Http\Controllers\Api\CustomerController as ApiCustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Models\Customer;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Protected routes - User must be logged in
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);

    // Stocks / Inventory
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/stocks/in', [StockController::class, 'stockIn'])->name('stocks.in');
    Route::get('/stocks/out', [StockController::class, 'stockOut'])->name('stocks.out');
    Route::get('/stocks/history', [StockController::class, 'history'])->name('stocks.history');

    // Customers
    Route::resource('customers', CustomerController::class);

    // Transactions


    Route::get('transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');

    Route::get('transactions/create', [TransactionController::class, 'create'])
        ->name('transactions.create');
    Route::get('transactions/{id}', [TransactionController::class, 'show'])
        ->name('transactions.show');

    Route::get('transactions/{id}/print', [TransactionController::class, 'print'])
        ->name('transactions.print');
    Route::post('transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');

    // Reports
    Route::get('/reports/index', function () {
        return view('reports.index');
    })->name('reports.index');


});

// Users
Route::get('/users', function () {
    return view('users.index');
})->name('users.index');
Route::get('/users/create', function () {
    return view('users.create');
})->name('users.create');
Route::get('/users/{id}', function ($id) {
    return view('users.show');
})->name('users.show');
Route::get('/users/{id}/edit', function ($id) {
    return view('users.edit');
})->name('users.edit');
Route::post('/users', function () {
    return redirect()->route('users.index');
})->name('users.store');
Route::put('/users/{id}', function ($id) {
    return redirect()->route('users.index');
})->name('users.update');
Route::delete('/users/{id}', function ($id) {
    return redirect()->route('users.index');
})->name('users.destroy');





// Profile -> User Profile
Route::get('/users/profile/index', function () {
    return view('users.profile.index');
})->name('users.profile.index');

// Backup & Restore
Route::get('/backup', function () {
    return view('backup.index');
})->name('backup.index');

// Home redirect to dashboard
Route::redirect('/home', '/dashboard');
