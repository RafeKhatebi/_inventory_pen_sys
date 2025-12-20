@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h3 class="mb-1">Add New User</h3>
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
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <!-- Basic Information -->
                            <div class="mb-1">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fa fa-info-circle me-2 text-primary"></i>Basic Information
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="product_name" class="form-label">Product Name *</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="type" class="form-label">Product Type *</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="package_type" class="form-label">Package Type *</label>
                                        <input type="text" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="weight" class="form-label">Weight (kg)</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" class="form-control" id="weight" name="weight">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Information -->
                            <div class="mb-1">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fa fa-dollar-sign me-2 text-primary"></i>Pricing Information
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="price_per_unit" class="form-label">Price Per Unit *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control" id="price_per_unit"
                                                name="price_per_unit" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="price_per_carton" class="form-label">Price Per Carton</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control" id="price_per_carton"
                                                name="price_per_carton">
                                        </div>
                                        <small class="text-muted">Leave empty if not applicable</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="units_per_carton" class="form-label">Units Per Carton</label>
                                        <input type="number" class="form-control" id="units_per_carton"
                                            name="units_per_carton">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="status" class="form-label">Status *</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="discontinued">Discontinued</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fa fa-redo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Save Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Sidebar -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="mb-3">
                            <i class="fa fa-lightbulb me-2 text-warning"></i>Quick Tips
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="fa fa-check-circle text-success me-1"></i>
                                Fill all required fields (*)
                            </li>
                            <li class="mb-2">
                                <i class="fa fa-check-circle text-success me-1"></i>
                                Set realistic stock levels
                            </li>
                            <li class="mb-2">
                                <i class="fa fa-check-circle text-success me-1"></i>
                                Add barcode for easier scanning
                            </li>
                            <li>
                                <i class="fa fa-check-circle text-success me-1"></i>
                                Set minimum stock for alerts
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection