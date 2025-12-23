@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Products Management</h3>
                <p class="text-muted mb-0">View and manage your products</p>
            </div>
            <div class="d-flex gap-2">
                <!-- Search Form -->
                <form method="GET" action="{{ route('products.index') }}" class="d-flex">
                    <input type="search" name="search" class="form-control" 
                           placeholder="Search products..." 
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary ms-2">
                        <i class="fa fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary ms-1">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </form>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> Add Product
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Search Results Info -->
        @if(request('search'))
            <div class="alert alert-info">
                <i class="fa fa-search me-2"></i>
                Search results for: <strong>"{{ request('search') }}"</strong>
                ({{ $products->total() }} {{ $products->total() == 1 ? 'result' : 'results' }} found)
            </div>
        @endif

        <!-- Products Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Package Type</th>
                                <th>Price/Unit</th>
                                <th>Price/Carton</th>
                                <th>Weight</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0">{{ $product->name }}</h6>
                                            <small class="text-muted">{{ $product->quantity_per_carton }} units/carton</small>
                                        </div>
                                    </td>
                                    <td>{{ $product->type }}</td>
                                    <td>{{ $product->package_type }}</td>
                                    <td>${{ number_format($product->price_per_unit, 2) }}</td>
                                    <td>${{ number_format($product->price_per_carton, 2) }}</td>
                                    <td>{{ $product->weight }}kg</td>
                                    <td>
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info me-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fa fa-box fa-3x mb-3"></i>
                                            <p>No products found. <a href="{{ route('products.create') }}">Create your first
                                                    product</a></p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection