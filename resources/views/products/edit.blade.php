@extends('layouts.app')
{{-- i want to use dynamic data in each file --}}
@section('title', 'Edit Product')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Edit Product</h3>
                <p class="text-muted mb-0">Update product information</p>
            </div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back to Products
                </a>
            </div>
        </div>

        <!-- Product Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.update', $product) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @include('products.partials.form')

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-times me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection