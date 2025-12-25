@extends('layouts.app')

@section('title', 'Inventory Report')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Inventory Report</h3>
                <p class="text-muted mb-0">Complete inventory status and valuation</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Products</h6>
                        <h2>{{ $products->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>Total Value</h6>
                        <h2>${{ number_format($totalValue, 2) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>Low Stock Items</h6>
                        <h2>{{ $lowStockProducts }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6>Out of Stock</h6>
                        <h2>{{ $outOfStockProducts }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Current Stock</th>
                                <th>Unit Price</th>
                                <th>Stock Value</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">ID: {{ $product->id }}</small>
                                    </td>
                                    <td>{{ $product->type }}</td>
                                    <td>{{ $product->current_stock }}</td>
                                    <td>${{ number_format($product->price_per_unit, 2) }}</td>
                                    <td>${{ number_format($product->stock_value, 2) }}</td>
                                    <td>
                                        @if($product->current_stock == 0)
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @elseif($product->current_stock <= 10)
                                            <span class="badge bg-warning">Low Stock</span>
                                        @else
                                            <span class="badge bg-success">In Stock</span>
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