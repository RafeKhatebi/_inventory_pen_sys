@extends('layouts.app')
{{-- i want to use dynamic data in each file --}}
@section('title', 'Product Details')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Product Details</h3>
                <p class="text-muted mb-0">View product information</p>
            </div>
            <div>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back to Products
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Product Information -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-box me-2"></i>Product Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">{{('Product Name') }}</label>
                                <p class="fw-bold">{{ $product->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Product Type</label>
                                <p class="fw-bold">{{ $product->type }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Package Type</label>
                                <p class="fw-bold">{{ $product->package_type }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Weight</label>
                                <p class="fw-bold">{{ $product->weight }} kg</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Price Per Unit</label>
                                <p class="fw-bold text-success">${{ number_format($product->price_per_unit, 2) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Price Per Carton</label>
                                <p class="fw-bold text-success">${{ number_format($product->price_per_carton, 2) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Quantity Per Carton</label>
                                <p class="fw-bold">{{ $product->quantity_per_carton }} units</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Created Date</label>
                                <p class="fw-bold">{{ date('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-warehouse me-2"></i>Stock Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h2 class="text-primary">150</h2>
                            <p class="text-muted">Current Stock</p>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('stocks.in.create') }}" class="btn btn-success">
                                <i class="fa fa-plus me-1"></i> Stock In
                            </a>
                            <a href="{{ route('stocks.out.create') }}" class="btn btn-warning">
                                <i class="fa fa-minus me-1"></i> Stock Out
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Stock Movements -->
                {{-- <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">Recent Movements</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <small class="text-muted">Stock In</small>
                                    <div>+50 units</div>
                                </div>
                                <small class="text-muted">Today</small>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <small class="text-muted">Stock Out</small>
                                    <div>-25 units</div>
                                </div>
                                <small class="text-muted">Yesterday</small>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection