<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Credit;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function customerCreditReport(Request $request): JsonResponse
    {
        $query = Customer::with([
            'credits' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }
        ]);

        if ($request->has('customer_id')) {
            $query->where('id', $request->customer_id);
        }

        $customers = $query->get()->map(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'total_credit' => $customer->totalCredit(),
                'credits_count' => $customer->credits->count(),
                'last_transaction' => $customer->credits->first()?->created_at,
                'credits' => $customer->credits
            ];
        });

        return response()->json([
            'customers' => $customers,
            'summary' => [
                'total_customers' => $customers->count(),
                'total_outstanding' => $customers->sum('total_credit'),
                'customers_with_debt' => $customers->where('total_credit', '>', 0)->count()
            ]
        ]);
    }

    public function stockMovementHistory(Request $request): JsonResponse
    {
        $query = Stock::with('product')->orderBy('created_at', 'desc');

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $movements = $query->paginate($request->get('per_page', 15));

        return response()->json($movements);
    }

    public function lowStockAlert(): JsonResponse
    {
        $lowStockProducts = Product::whereHas('stock', function ($query) {
            $query->selectRaw('product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
                ->groupBy('product_id')
                ->havingRaw('current_stock <= 10');
        })->with([
                    'stock' => function ($query) {
                        $query->selectRaw('product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
                            ->groupBy('product_id');
                    }
                ])->get();

        return response()->json([
            'low_stock_products' => $lowStockProducts,
            'count' => $lowStockProducts->count()
        ]);
    }

    public function exportData(Request $request): JsonResponse
    {
        $type = $request->get('type', 'products');

        switch ($type) {
            case 'products':
                $data = Product::all();
                break;
            case 'customers':
                $data = Customer::with('credits')->get();
                break;
            case 'stocks':
                $data = Stock::with('product')->get();
                break;
            case 'credits':
                $data = Credit::with('customer')->get();
                break;
            default:
                return response()->json(['error' => 'Invalid export type'], 400);
        }

        return response()->json([
            'data' => $data,
            'type' => $type,
            'count' => $data->count(),
            'exported_at' => now()
        ]);
    }
}