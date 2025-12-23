<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\ActivityLog;
use App\Http\Requests\CreditRequest;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Credit::with('customer');
        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }
        return response()->json($query->latest()->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreditRequest $request)
    {
        $credit = Credit::create($request->validated());
        
        ActivityLog::log('credit_created', Credit::class, $credit->id, "Credit created for customer ID: {$credit->customer_id}");
        
        return response()->json(['credit' => $credit->load('customer')], 201);
    }

    public function show(Credit $credit)
    {
        return response()->json($credit->load('customer'));
    }

    public function update(CreditRequest $request, Credit $credit)
    {
        $credit->update($request->validated());
        
        ActivityLog::log('credit_updated', Credit::class, $credit->id, "Credit updated for customer ID: {$credit->customer_id}");
        
        return response()->json(['credit' => $credit->load('customer')]);
    }

    public function destroy(Credit $credit)
    {
        ActivityLog::log('credit_deleted', Credit::class, $credit->id, "Credit deleted for customer ID: {$credit->customer_id}");
        
        $credit->delete();
        return response()->json(['message' => 'Credit deleted successfully']);
    }

    public function customerCredits($customerId)
    {
        $credits = Credit::where('customer_id', $customerId)
                        ->with('customer')
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return response()->json($credits);
    }
}
