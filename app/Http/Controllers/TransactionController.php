<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\ActivityLog;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('customer');

        if ($request->has('customer_id') && $request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $transactions = $query->latest()->paginate(15);
        $customers = Customer::all();

        return view('transactions.index', compact('transactions', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('transactions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|in:take,give',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'note' => 'nullable|string|max:500',
        ]);

        $customer = Customer::find($request->customer_id);

        $transaction = Transaction::create($request->all());

        ActivityLog::log(
            'transaction_created',
            Transaction::class,
            $transaction->id,
            "Transaction {$request->type}: {$request->amount} for customer: {$customer->name}"
        );

        return redirect()->route('transactions.index')
            ->with('success', 'تراکنش با موفقیت ثبت شد!');
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
}

