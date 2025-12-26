<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search functionality
        if ($request->has('search') && !empty($request->get('search'))) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('package_type', 'LIKE', "%{$search}%");
            });
        }

        $customers = $query->paginate(15);

        // Preserve search parameter in pagination links
        if ($request->has('search')) {
            $customers->appends(['search' => $request->get('search')]);
        }

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerRequest $request)
    {
        try {
            $customer = Customer::create($request->validated());

            ActivityLog::log('customer_created', Customer::class, $customer->id, "Customer '{$customer->name}' created via web interface");

            return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create customer: ' . $e->getMessage());
        }
    }

    public function show(Customer $customer)
    {
        $transactions = $customer->transactions()->orderBy('transaction_date', 'desc')->paginate(10);
        $currentBalance = $customer->getCurrentCredit();
        $totalTaken = $customer->getTotalTaken();
        $totalGiven = $customer->getTotalGiven();
        
        return view('customers.show', compact('customer', 'transactions', 'currentBalance', 'totalTaken', 'totalGiven'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $customer->update($request->validated());

            ActivityLog::log('customer_updated', Customer::class, $customer->id, "Customer '{$customer->name}' updated via web interface");

            return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update customer: ' . $e->getMessage());
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            // Check if customer has any transactions
            $currentBalance = $customer->getCurrentCredit();
            
            if ($currentBalance != 0) {
                return back()->with('error', 'نمی‌توان مشتری را حذف کرد. مشتری دارای اعتبار یا بدهی است. موجودی فعلی: ' . \App\Helpers\CurrencyHelper::format($currentBalance));
            }
            
            ActivityLog::log('customer_deleted', Customer::class, $customer->id, "Customer '{$customer->name}' deleted via web interface");

            $customer->delete();

            return redirect()->route('customers.index')->with('success', 'مشتری با موفقیت حذف شد!');
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در حذف مشتری: ' . $e->getMessage());
        }
    }
    
    public function downloadReport(Customer $customer)
    {
        $transactions = $customer->transactions()->orderBy('transaction_date', 'desc')->get();
        
        return view('customers.report', compact('customer', 'transactions'));
    }
}