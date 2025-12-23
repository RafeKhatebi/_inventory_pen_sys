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
    Route::resource('products', \App\Http\Controllers\ProductController::class);

    // Customers
    Route::get('/customers', function () {
        return view('customers.index');
    })->name('customers.index');
    Route::get('/customers/create', function () {
        return view('customers.create');
    })->name('customers.create');
    Route::get('/customers/{id}', function ($id) {
        return view('customers.show');
    })->name('customers.show');
    Route::get('/customers/{id}/edit', function ($id) {
        return view('customers.edit');
    })->name('customers.edit');
    Route::post('/customers', function () {
        return redirect()->route('customers.index');
    })->name('customers.store');
    Route::put('/customers/{id}', function ($id) {
        return redirect()->route('customers.index');
    })->name('customers.update');
    Route::delete('/customers/{id}', function ($id) {
        return redirect()->route('customers.index');
    })->name('customers.destroy');
    Route::get('/customers/transactions', function () {
        return view('customers.transactions.index');
    })->name('customers.transactions');

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