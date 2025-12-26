@extends('layouts.app')
{{-- updated to use dynamic data --}}
@section('title', 'Customer Details')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Customer Details</h3>
                <p class="text-muted mb-0">View customer information and credit history</p>
            </div>
            <div>
                <a href="{{ route('customers.edit', 1) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back to Customers
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Customer Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-user me-2"></i>Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ $customer->name }}&background=random"
                                class="rounded-circle mb-2" width="80" alt="Customer Avatar">
                            <h5>{{ $customer->name }}</h5>
                            <p class="text-muted">{{ $customer->id }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Phone</label>
                            <p class="fw-bold">{{ $customer->phone }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Address</label>
                            <p class="fw-bold">{{ $customer->address }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Credit Limit</label>
                            <h4 class="text-danger">@currency($customer->credit_limit)</h4>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Member Since</label>
                            <p class="fw-bold">@jalali($customer->created_at)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Credit History -->
            {{-- updated to use dynamic data --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-credit-card me-2"></i>Credit History</h5>
                        {{-- <a href="{{ route('customers.downloadReport', $customer->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-download me-1"></i> Download Report
                        </a> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ date('M d, Y') }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td class="text-danger">{{ number_format($customer->credit_limit, 0) }}</td>
                                        <td><span class="badge bg-warning">{{ $customer->type }}</span></td>
                                        <td><span class="badge bg-danger">{{ $customer->status }}</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection