@extends('layouts.app')

@section('title', 'Add New Transactions')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h3 class="mb-1">Add New Transactions</h3>
            </div>
        </div>

        <!-- customer Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label>Customer</label>
                                <select name="customer_id" class="form-select" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->name }} ({{ $customer->phone }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Transaction Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="take">Take Money</option>
                                    <option value="give">Give Money</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Amount</label>
                                <input type="number" step="0.01" name="amount" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="transaction_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Note</label>
                                <input type="text" name="note" class="form-control">
                            </div>

                            <button class="btn btn-primary">Save Transaction</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection