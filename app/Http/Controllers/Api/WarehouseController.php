<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['stock' => function($q) {
            $q->selectRaw('product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
              ->groupBy('product_id');
        }]);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return response()->json($query->paginate(15));
    }

    public function store(Request $request)
    {
        // Warehouse operations are handled through StockController
        return response()->json(['message' => 'Use /api/stocks endpoint for warehouse operations'], 400);
    }

    public function show($id)
    {
        $product = Product::with(['stock' => function($q) {
            $q->selectRaw('product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
              ->groupBy('product_id');
        }])->findOrFail($id);

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Use /api/stocks endpoint for warehouse operations'], 400);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Use /api/stocks endpoint for warehouse operations'], 400);
    }
}
