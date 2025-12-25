@extends('layouts.app')
{{-- updated to use dynamic data --}}
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Dashboard Overview</h3>
                <p class="text-muted mb-0">Welcome back, Admin! Here's what's happening today.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary p-3 me-3">
                            <i class="fa fa-rupee-sign fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Customers</p>
                            <h4 class="mb-0">345</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success p-3 me-3">
                            <i class="fa fa-chart-bar fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Products</p>
                            <h4 class="mb-0">4343</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning p-3 me-3">
                            <i class="fa fa-users fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Money</p>
                            <h4 class="mb-0">245323Af</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info p-3 me-3">
                            <i class="fa fa-exclamation-triangle fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1"> Stock Items</p>
                            <h4 class="mb-0">1232</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4 mb-4">
            <div class="col-md-12">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3">Quick Actions</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">View Products</a>
                        <a href="{{ route('customers.index') }}" class="btn btn-success">View Customers</a>
                        <a href="{{ route('stocks.index') }}" class="btn btn-warning">View Stocks</a>
                        <a href="{{ route('transactions.index') }}" class="btn btn-info">View Transactions</a>
                    </div>
                </div>
            </div>
        </div>
        {{--Date and time --}}
        <div class="row g-4 mb-4">
            <div class="col-md-12">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3">Date and Time</h5>
                    <p id="currentDateTime" class="mb-0">{{ now() }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection