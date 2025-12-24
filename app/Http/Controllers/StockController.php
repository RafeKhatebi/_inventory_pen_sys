<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ActivityLog;
use App\Http\Requests\StockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(Request $request)
    {
        // Get products with current stock levels
        $query = Product::select('products.*')
            ->selectRaw('COALESCE(SUM(CASE WHEN stocks.type = "in" THEN stocks.quantity ELSE -stocks.quantity END), 0) as current_stock')
            ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->groupBy('products.id', 'products.name', 'products.type', 'products.package_type', 'products.quantity_per_carton', 'products.price_per_unit', 'products.price_per_carton', 'products.weight', 'products.created_at', 'products.updated_at');

        // Search functionality
        if ($request->has('search') && !empty($request->get('search'))) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'LIKE', "%{$search}%")
                    ->orWhere('products.type', 'LIKE', "%{$search}%")
                    ->orWhere('products.package_type', 'LIKE', "%{$search}%");
            });
        }

        $products = $query->paginate(15);
        
        // Preserve search parameter in pagination links
        if ($request->has('search')) {
            $products->appends(['search' => $request->get('search')]);
        }

        // Calculate statistics
        $totalProducts = Product::count();
        $totalInStock = Product::selectRaw('SUM(COALESCE((SELECT SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) FROM stocks WHERE product_id = products.id), 0)) as total')
            ->value('total') ?? 0;
        $lowStockCount = Product::whereRaw('COALESCE((SELECT SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) FROM stocks WHERE product_id = products.id), 0) <= 10 AND COALESCE((SELECT SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) FROM stocks WHERE product_id = products.id), 0) > 0')
            ->count();
        $outOfStockCount = Product::whereRaw('COALESCE((SELECT SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) FROM stocks WHERE product_id = products.id), 0) = 0')
            ->count();

        return view('stocks.index', compact('products', 'totalProducts', 'totalInStock', 'lowStockCount', 'outOfStockCount'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stocks.in', compact('products'));
    }

    public function store(StockRequest $request)
    {
        try {
            $stock = Stock::create($request->validated());

            ActivityLog::log('stock_transaction', Stock::class, $stock->id, "Stock {$stock->type}: {$stock->quantity} units for product: {$stock->product->name}");

            return redirect()->route('stocks.index')->with('success', 'Stock transaction recorded successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to record stock transaction: ' . $e->getMessage());
        }
    }

    public function stockIn()
    {
        $products = Product::all();
        return view('stocks.in', compact('products'));
    }

    public function stockOut()
    {
        $products = Product::all();
        return view('stocks.out', compact('products'));
    }

    public function history(Request $request)
    {
        $stocks = Stock::with('product')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('stocks.history', compact('stocks'));
    }
}