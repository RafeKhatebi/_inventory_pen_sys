@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Stock Management</h3>
                <p class="text-muted mb-0">Manage inventory and stock movements</p>
            </div>
            <div>
                <a href="/stocks/in" class="btn btn-primary me-2">
                    <i class="fa fa-arrow-down me-1"></i> Stock In
                </a>
                <a href="/stocks/out" class="btn btn-warning">
                    <i class="fa fa-arrow-up me-1"></i> Stock Out
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Products</h6>
                        <h2>245</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>In Stock</h6>
                        <h2>15,480</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>Low Stock</h6>
                        <h2>12</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6>Out of Stock</h6>
                        <h2>3</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Current Stock</th>
                                <th>Min Level</th>
                                <th>Max Level</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                            <div>
                                                <h6 class="mb-0">Product {{ $i }}</h6>
                                                <small class="text-muted">SKU: SKU-00{{ $i }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Category {{ $i % 3 + 1 }}</td>
                                    <td>{{ rand(5, 100) }}</td>
                                    <td>10</td>
                                    <td>100</td>
                                    <td>{{ date('d M Y', strtotime("-{$i} days")) }}</td>
                                    <td>
                                        @if($i % 4 == 0)
                                            <span class="badge bg-danger">Low Stock</span>
                                        @elseif($i % 5 == 0)
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @else
                                            <span class="badge bg-success">In Stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success me-1">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection