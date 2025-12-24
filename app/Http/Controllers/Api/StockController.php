<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ActivityLog;
use App\Http\Requests\StockRequest;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Stock::with('product');
        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        return response()->json($query->paginate(15));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(StockRequest $request)
    {
        $stock = Stock::create($request->validated());

        ActivityLog::log('stock_transaction', Stock::class, $stock->id, "Stock {$stock->type}: {$stock->quantity} units for product ID: {$stock->product_id}");

        return response()->json(['stock' => $stock->load('product')], 201);
    }

    public function show(Stock $stock)
    {
        return response()->json($stock->load('product'));
    }

    public function update(StockRequest $request, Stock $stock)
    {
        $stock->update($request->validated());

        ActivityLog::log('stock_updated', Stock::class, $stock->id, "Stock updated for product ID: {$stock->product_id}");

        return response()->json(['stock' => $stock->load('product')]);
    }

    public function destroy(Stock $stock)
    {
        ActivityLog::log('stock_deleted', Stock::class, $stock->id, "Stock record deleted for product ID: {$stock->product_id}");

        $stock->delete();
        return response()->json(['message' => 'Stock record deleted successfully']);
    }

    public function getCurrentStock(Request $request)
    {
        $query = Product::with([
            'stock' => function ($q) {
                $q->selectRaw('product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
                    ->groupBy('product_id');
            }
        ]);

        if ($request->has('low_stock_only')) {
            $query->whereHas('stock', function ($q) {
                $q->selectRaw('product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
                    ->groupBy('product_id')
                    ->havingRaw('current_stock <= 10');
            });
        }

        return response()->json($query->get());
    }
}
