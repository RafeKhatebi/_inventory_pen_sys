<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Credit;
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
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'type' => 'required|in:sale,payment',
            'description' => 'nullable|string',
        ]);
        $credit = Credit::create($request->all());
        return response()->json(['credit' => $credit], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
