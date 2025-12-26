@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Dashboard Overview</h3>
                <p class="text-muted mb-0">Welcome back! Here's what's happening today.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary p-3 me-3">
                            <i class="fa fa-users fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Customers</p>
                            <h4 class="mb-0">{{ number_format($totalCustomers) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success p-3 me-3">
                            <i class="fa fa-box fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Products</p>
                            <h4 class="mb-0">{{ number_format($totalProducts) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning p-3 me-3">
                            <i class="fa fa-money-bill-wave fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Stock Value</p>
                            <h4 class="mb-0">{{ number_format($totalStockValue, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info p-3 me-3">
                            <i class="fa fa-credit-card fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Credits</p>
                            <h4 class="mb-0">{{ number_format($totalCredits, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row g-4">
            <!-- Recent Transactions -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Recent Transactions</h5>
                    </div>
                    <div class="card-body">
                        @forelse($recentTransactions as $transaction)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <div>
                                    <strong>{{ $transaction->customer->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ 
                                            \App\Helpers\JalaliHelper::format($transaction->transaction_date) }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $transaction->type == 'take' ? 'warning' : 'success' }}">
                                        {{ $transaction->type == 'take' ? 'Took' : 'Paid' }}
                                        ${{ number_format($transaction->amount, 2) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center">No recent transactions</p>
                        @endforelse
                        <div class="text-center mt-3">
                            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-outline-primary">View All
                                Transactions</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('products.create') }}" class="btn btn-primary w-100">
                                    <i class="fa fa-plus me-2"></i>Product
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('customers.create') }}" class="btn btn-success w-100">
                                    <i class="fa fa-user-plus me-2"></i>Client
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('stocks.in') }}" class="btn btn-warning w-100">
                                    <i class="fa fa-arrow-down me-2"></i>Stock In
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('transactions.create') }}" class="btn btn-info w-100">
                                    <i class="fa fa-exchange-alt me-2"></i>Credit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection