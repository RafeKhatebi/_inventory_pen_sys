@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Customers Management</h3>
                <p class="text-muted mb-0">Manage your customers and credit accounts</p>
            </div>
            <div>
                <span><strong>Search</strong></span>
                <input type="text" class="form-control">
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Total Credit</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td>CUST-00{{ $i }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Customer+{{ $i }}&background=random"
                                                class="rounded-circle me-2" width="40" alt="">
                                            <div>
                                                <h6 class="mb-0">Customer {{ $i }}</h6>
                                                <small class="text-muted">Registered:
                                                    {{ date('d M Y', strtotime("-{$i} days")) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>+91 98765{{ rand(10000, 99999) }}</td>
                                    <td>customer{{ $i }}@example.com</td>
                                    <td>₹{{ rand(5000, 50000) }}</td>
                                    <td>
                                        @if($i % 3 == 0)
                                            <span class="badge bg-danger">₹{{ rand(1000, 5000) }}</span>
                                        @else
                                            <span class="badge bg-success">₹0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($i % 4 == 0)
                                            <span class="badge bg-warning">Inactive</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary me-1">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning me-1">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
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