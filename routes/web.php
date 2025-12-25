<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BackupController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;

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
    Route::resource('transactions', TransactionController::class);

    // Reports
    Route::get('/reports', function () {
        return redirect()->route('reports.complete-summary.index');
    })->name('reports.index');
    Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('reports.inventory.index');
    Route::get('/reports/customers', [ReportController::class, 'customers'])->name('reports.customers.index');
    Route::get('/reports/complete-summary', [ReportController::class, 'completeSummary'])->name('reports.complete-summary.index');

    // Users
    Route::resource('users', UserController::class);

    // Profile
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');

    // Backup & Restore
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'create'])->name('backup.create');
    Route::get('/backup/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
    Route::delete('/backup/delete/{filename}', [BackupController::class, 'delete'])->name('backup.delete');

});


// Home redirect to dashboard
Route::redirect('/home', '/dashboard');
