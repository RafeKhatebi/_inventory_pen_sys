<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    BackupController,
    CustomerController,
    ProductController,
    ProfileController,
    ReportController,
    StockController,
    TransactionController,
    UserController
};
use App\Models\{Customer, Product, Transaction};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root redirect
Route::get('/', fn() => redirect()->route('login'));
Route::redirect('/home', '/dashboard');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Authentication
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', function () {
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalStockValue = Product::selectRaw('SUM(COALESCE((SELECT SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) FROM stocks WHERE product_id = products.id), 0) * price_per_unit) as total')->value('total') ?? 0;
        $totalCredits = Customer::selectRaw('SUM(COALESCE((SELECT SUM(CASE WHEN type = "take" THEN amount ELSE -amount END) FROM transactions WHERE customer_id = customers.id), 0)) as total')->value('total') ?? 0;
        $lowStockProducts = Product::selectRaw('products.id, products.name, products.type, COALESCE(SUM(CASE WHEN stocks.type = "in" THEN stocks.quantity ELSE -stocks.quantity END), 0) as current_stock')
            ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->groupBy('products.id', 'products.name', 'products.type')
            ->havingRaw('current_stock <= 10')
            ->take(5)->get();
        $recentTransactions = Transaction::with('customer')->latest()->take(5)->get();

        return view('dashboard.index', compact('totalProducts', 'totalCustomers', 'totalStockValue', 'totalCredits', 'lowStockProducts', 'recentTransactions'));
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Resource Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | Stock Management Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('stocks')->name('stocks.')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('index');
        Route::get('/create', [StockController::class, 'create'])->name('create');
        Route::post('/', [StockController::class, 'store'])->name('store');
        Route::get('/in', [StockController::class, 'stockIn'])->name('in');
        Route::get('/out', [StockController::class, 'stockOut'])->name('out');
        Route::get('/history', [StockController::class, 'history'])->name('history');
    });

    /*
    |--------------------------------------------------------------------------
    | Report Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', fn() => redirect()->route('reports.complete-summary.index'))->name('index');
        Route::get('/inventory', [ReportController::class, 'inventory'])->name('inventory.index');
        Route::get('/customers', [ReportController::class, 'customers'])->name('customers.index');
        Route::get('/complete-summary', [ReportController::class, 'completeSummary'])->name('complete-summary.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Backup Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('backup')->name('backup.')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('index');
        Route::post('/create', [BackupController::class, 'create'])->name('create');
        Route::get('/download/{filename}', [BackupController::class, 'download'])->name('download');
        Route::delete('/delete/{filename}', [BackupController::class, 'delete'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Additional Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/customers/{customer}/report', [CustomerController::class, 'downloadReport'])->name('customers.downloadReport');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
});