@extends('layouts.app')

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
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" 
                                 class="rounded-circle mb-2" width="80" alt="Customer Avatar">
                            <h5>John Doe</h5>
                            <p class="text-muted">Customer ID: CUST-001</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Phone</label>
                            <p class="fw-bold">+1234567890</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Address</label>
                            <p class="fw-bold">123 Main Street, City, Country</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Total Credit</label>
                            <h4 class="text-danger">$1,500.00</h4>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Member Since</label>
                            <p class="fw-bold">{{ date('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Credit History -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-credit-card me-2"></i>Credit History</h5>
                        <button class="btn btn-primary btn-sm">
                            <i class="fa fa-plus me-1"></i> Add Transaction
                        </button>
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
                                        <td>Product Purchase</td>
                                        <td class="text-danger">$500.00</td>
                                        <td><span class="badge bg-warning">Sale</span></td>
                                        <td><span class="badge bg-danger">Unpaid</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ date('M d, Y', strtotime('-1 day')) }}</td>
                                        <td>Payment Received</td>
                                        <td class="text-success">$300.00</td>
                                        <td><span class="badge bg-success">Payment</span></td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ date('M d, Y', strtotime('-2 days')) }}</td>
                                        <td>Product Purchase</td>
                                        <td class="text-danger">$1,300.00</td>
                                        <td><span class="badge bg-warning">Sale</span></td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
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