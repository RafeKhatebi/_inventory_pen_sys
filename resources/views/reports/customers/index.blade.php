@extends('layouts.app')

@section('title', 'Customer Report')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Customer Report</h3>
                <p class="text-muted mb-0">Customer credit analysis and transaction summary</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Customers</h6>
                        <h2>{{ $totalCustomers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>Total Credits</h6>
                        <h2>${{ number_format($totalCredits, 2) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>Active Customers</h6>
                        <h2>{{ $activeCustomers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Current Balance</th>
                                <th>Credit Limit</th>
                                <th>Total Transactions</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        <strong>{{ $customer->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $customer->address }}</small>
                                    </td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <span class="fw-bold {{ $customer->current_balance > 0 ? 'text-warning' : 'text-success' }}">
                                            ${{ number_format($customer->current_balance, 2) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($customer->credit_limit, 2) }}</td>
                                    <td>{{ $customer->total_transactions }}</td>
                                    <td>
                                        @if($customer->current_balance >= $customer->credit_limit)
                                            <span class="badge bg-danger">Limit Reached</span>
                                        @elseif($customer->current_balance > ($customer->credit_limit * 0.8))
                                            <span class="badge bg-warning">Near Limit</span>
                                        @else
                                            <span class="badge bg-success">Good Standing</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection