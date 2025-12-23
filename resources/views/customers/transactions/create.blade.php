@extends('layouts.app')

@section('title', 'Add New Transactions')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h3 class="mb-1">Add New Transactions</h3>
            </div>
        </div>

        <!-- customer Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf

                            <!-- Basic Information -->
                            <div class="mb-1">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fa fa-info-circle me-2 text-primary"></i>Basic Information
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="customer_name" class="form-label">customer Name *</label>
                                        <select name="selectcustomer" id="selectcustomer">
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="type" class="form-label">Phone No.*</label>
                                        <select name="customer_phone" id="customer_phone">
                                            <option value="">
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->phone }}">{{ $customer->phone }}</option>
                                                @endforeach
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="package_type" class="form-label">Loan Amount</label>
                                        <select name="loan_amount" id="loan_amount">
                                            <option value="">Select Loan Amount</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->loan_amount }}">{{ $customer->loan_amount }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="package_type" class="form-label">Loan Amount</label>
                                        <input type="number" class="form-control" id="pres_amount" name="pres_amount">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="package_type" class="form-label">Total</label>
                                        <input type="number" class="form-control" id="pres_amount" name="pres_amount">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="quantity" class="form-label">Total</label>
                                        <input type="date" class="form-control" id="quantity" name="quantity">
                                    </div>

                                    <!-- Pricing Information -->
                                    <div class="mb-1">
                                        <h5 class="mb-3 border-bottom pb-2">
                                            <i class="fa fa-dollar-sign me-2 text-primary"></i>Extra Information
                                        </h5>

                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="price_per_unit" class="form-label">Loan-past</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Af</span>
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="price_per_unit" name="price_per_unit" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="price_per_carton" class="form-label">Now Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Af</span>
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="price_per_carton" name="price_per_carton">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="units_per_carton" class="form-label">Total</label>
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
                                            <i class="fa fa-save me-1"></i> Save customer
                                        </button>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection