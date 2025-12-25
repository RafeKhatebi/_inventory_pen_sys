<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        return view('transactions.create', compact('customers'));
    }
    public function index()
    {
        $transactions = Transaction::with('customer')
            ->latest()
            ->paginate(15);

        return view('transactions.index', compact('transactions'));
    }
    public function show($id)
    {
        $transaction = Transaction::with('customer')->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function print($id)
    {
        $transaction = Transaction::with('customer')->findOrFail($id);
        return view('transactions.print', compact('transaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|in:take,give',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction saved successfully');
    }
}

