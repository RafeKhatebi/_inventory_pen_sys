<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function inventory()
    {
        $products = Product::select('products.id', 'products.name', 'products.type', 'products.price_per_unit')
            ->selectRaw('COALESCE(SUM(CASE WHEN stocks.type = "in" THEN stocks.quantity ELSE -stocks.quantity END), 0) as current_stock')
            ->selectRaw('COALESCE(SUM(CASE WHEN stocks.type = "in" THEN stocks.quantity ELSE -stocks.quantity END), 0) * products.price_per_unit as stock_value')
            ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->groupBy('products.id', 'products.name', 'products.type', 'products.price_per_unit')
            ->paginate(15);

        $totalValue = Product::selectRaw('SUM(COALESCE((SELECT SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) FROM stocks WHERE product_id = products.id), 0) * price_per_unit) as total')->value('total') ?? 0;
        $lowStockProducts = Product::selectRaw('COUNT(*) as count')
            ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->groupBy('products.id')
            ->havingRaw('COALESCE(SUM(CASE WHEN stocks.type = "in" THEN stocks.quantity ELSE -stocks.quantity END), 0) <= 10')
            ->count();
        $outOfStockProducts = Product::selectRaw('COUNT(*) as count')
            ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->groupBy('products.id')
            ->havingRaw('COALESCE(SUM(CASE WHEN stocks.type = "in" THEN stocks.quantity ELSE -stocks.quantity END), 0) = 0')
            ->count();

        return view('reports.inventory.index', compact('products', 'totalValue', 'lowStockProducts', 'outOfStockProducts'));
    }

    public function customers()
    {
        $customers = Customer::select('customers.id', 'customers.name', 'customers.phone', 'customers.address', 'customers.credit_limit')
            ->selectRaw('COALESCE(SUM(CASE WHEN transactions.type = "take" THEN transactions.amount ELSE -transactions.amount END), 0) as current_balance')
            ->selectRaw('COUNT(transactions.id) as total_transactions')
            ->leftJoin('transactions', 'customers.id', '=', 'transactions.customer_id')
            ->groupBy('customers.id', 'customers.name', 'customers.phone', 'customers.address', 'customers.credit_limit')
            ->paginate(15);

        $totalCustomers = Customer::count();
        $totalCredits = Customer::selectRaw('SUM(COALESCE((SELECT SUM(CASE WHEN type = "take" THEN amount ELSE -amount END) FROM transactions WHERE customer_id = customers.id), 0)) as total')->value('total') ?? 0;
        $activeCustomers = Customer::whereHas('transactions')->count();

        return view('reports.customers.index', compact('customers', 'totalCustomers', 'totalCredits', 'activeCustomers'));
    }

    public function completeSummary()
    {
        // Products Summary
        $totalProducts = Product::count();
        $totalStockValue = Product::selectRaw('SUM(COALESCE((SELECT SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) FROM stocks WHERE product_id = products.id), 0) * price_per_unit) as total')
            ->value('total') ?? 0;

        // Customers Summary
        $totalCustomers = Customer::count();
        $totalCredits = Customer::selectRaw('SUM(COALESCE((SELECT SUM(CASE WHEN type = "take" THEN amount ELSE -amount END) FROM transactions WHERE customer_id = customers.id), 0)) as total')
            ->value('total') ?? 0;

        // Stock Movements (Last 30 days)
        $stockMovements = Stock::selectRaw('DATE(created_at) as date, type, SUM(quantity) as total_quantity')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date', 'type')
            ->orderBy('date', 'desc')
            ->get();

        // Recent Activities
        $recentStocks = Stock::with('product')->latest()->take(10)->get();
        $recentTransactions = Transaction::with('customer')->latest()->take(10)->get();

        // Low Stock Products
        $lowStockProducts = Product::selectRaw('products.id, products.name, products.type, COALESCE(SUM(CASE WHEN stocks.type = "in" THEN stocks.quantity ELSE -stocks.quantity END), 0) as current_stock')
            ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->groupBy('products.id', 'products.name', 'products.type')
            ->havingRaw('current_stock <= 10')
            ->get();

        return view('reports.complete-summary.index', compact(
            'totalProducts', 'totalStockValue', 'totalCustomers', 'totalCredits',
            'stockMovements', 'recentStocks', 'recentTransactions', 'lowStockProducts'
        ));
    }
}