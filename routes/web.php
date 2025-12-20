<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    Route::get('/products', function () {
        return view('products.index');
    })->name('products.index');

    Route::get('/products/create', function () {
        return view('products.create');
    })->name('products.create');

    // Customers
    Route::get('/customers', function () {
        return view('customers.index');
    })->name('customers.index');

    Route::get('/customers/create', function () {
        return view('customers.create');
    })->name('customers.create');

    Route::get('/customers/transactions', function () {
        return view('customers.transactions');
    })->name('customers.transactions');
    // Stocks / Inventory
    Route::get('/stocks', function () {
        return view('stocks.index');
    })->name('stocks.index');

    Route::get('/stocks/in', function () {
        return view('stocks.in');
    })->name('stocks.in.create');

    Route::get('/stocks/out', function () {
        return view('stocks.out');
    })->name('stocks.out.create');

    Route::get('/stocks/history', function () {
        return view('stocks.history');
    })->name('stocks.history');

    // Reports
    Route::get('/reports/inventory', function () {
        return view('reports.inventory.index');
    })->name('reports.inventory.index');

    Route::get('/reports/customers', function () {
        return view('reports.customers.index');
    })->name('reports.customers.index');


    Route::get('/reports/complete-summary', function () {
        return view('reports.complete-summary.index');
    })->name('reports.complete-summary.index');

    //Users 
    Route::get('/users/create', function () {
        return view('users.create');
    })->name('users.create');

    Route::get('/users/index', function () {
        return view('users.index');
    })->name('users.index');
    
    // Profile -> User Profile
    Route::get('/users/profile/index', function () {
        return view('users.profile.index');
    })->name('users.profile.index');

    // Settings
    Route::get('/settings/settings', function () {
        return view('settings.settings.index');
    })->name('settings.settings.index');

    Route::get('/settings/backup', function () {
        return view('settings.backup.index');
    })->name('settings.backup.index');


    // Home redirect to dashboard
    Route::redirect('/home', '/dashboard');
});