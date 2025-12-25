@extends('layouts.app')

@section('title', 'Complete Summary Report')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Complete Summary Report</h3>
                <p class="text-muted mb-0">Comprehensive system overview and analytics</p>
            </div>
            <div>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fa fa-print me-1"></i> Print Report
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Products</h6>
                        <h2>{{ $totalProducts }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>Stock Value</h6>
                        <h2>${{ number_format($totalStockValue, 2) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6>Total Customers</h6>
                        <h2>{{ $totalCustomers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>Total Credits</h6>
                        <h2>${{ number_format($totalCredits, 2) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Stock Movements -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Recent Stock Movements</h5>
                    </div>
                    <div class="card-body">
                        @forelse($recentStocks as $stock)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <div>
                                    <strong>{{ $stock->product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $stock->created_at->format('M d, Y H:i') }}</small>
                                </div>
                                <span class="badge bg-{{ $stock->type == 'in' ? 'success' : 'warning' }}">
                                    {{ $stock->type == 'in' ? '+' : '-' }}{{ $stock->quantity }}
                                </span>
                            </div>
                        @empty
                            <p class="text-muted text-center">No recent stock movements</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="col-md-6 mb-4">
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
                                    <small class="text-muted">{{ $transaction->transaction_date->format('M d, Y') }}</small>
                                </div>
                                <span class="badge bg-{{ $transaction->type == 'take' ? 'warning' : 'success' }}">
                                    {{ $transaction->type == 'take' ? 'Took' : 'Paid' }} ${{ number_format($transaction->amount, 2) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-muted text-center">No recent transactions</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Low Stock Alert</h5>
                    </div>
                    <div class="card-body">
                        @forelse($lowStockProducts as $product)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $product->type }}</small>
                                </div>
                                <span class="badge bg-{{ $product->current_stock == 0 ? 'danger' : 'warning' }}">
                                    {{ $product->current_stock }} left
                                </span>
                            </div>
                        @empty
                            <p class="text-muted text-center">All products have sufficient stock</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection