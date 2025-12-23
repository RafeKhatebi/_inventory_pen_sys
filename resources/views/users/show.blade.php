@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">User Details</h3>
                <p class="text-muted mb-0">View user information and activity</p>
            </div>
            <div>
                <a href="{{ route('users.edit', 1) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back to Users
                </a>
            </div>
        </div>

        <div class="row">
            <!-- User Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-user me-2"></i>User Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=random" 
                                 class="rounded-circle mb-2" width="80" alt="User Avatar">
                            <h5>Admin User</h5>
                            <p class="text-muted">User ID: USR-001</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <p class="fw-bold">admin@example.com</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Role</label>
                            <span class="badge bg-primary">Admin</span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Status</label>
                            <span class="badge bg-success">Active</span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Last Login</label>
                            <p class="fw-bold">{{ date('M d, Y H:i') }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Member Since</label>
                            <p class="fw-bold">{{ date('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Log -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-history me-2"></i>Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ date('M d, Y H:i') }}</td>
                                        <td><span class="badge bg-success">Login</span></td>
                                        <td>User logged into system</td>
                                        <td>192.168.1.100</td>
                                    </tr>
                                    <tr>
                                        <td>{{ date('M d, Y H:i', strtotime('-1 hour')) }}</td>
                                        <td><span class="badge bg-primary">Create</span></td>
                                        <td>Created new product: Sample Product</td>
                                        <td>192.168.1.100</td>
                                    </tr>
                                    <tr>
                                        <td>{{ date('M d, Y H:i', strtotime('-2 hours')) }}</td>
                                        <td><span class="badge bg-warning">Update</span></td>
                                        <td>Updated customer: John Doe</td>
                                        <td>192.168.1.100</td>
                                    </tr>
                                    <tr>
                                        <td>{{ date('M d, Y H:i', strtotime('-3 hours')) }}</td>
                                        <td><span class="badge bg-info">View</span></td>
                                        <td>Viewed inventory report</td>
                                        <td>192.168.1.100</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- User Permissions -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fa fa-shield-alt me-2"></i>Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Products</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check text-success me-2"></i>View Products</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Create Products</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Edit Products</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Delete Products</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>Customers</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check text-success me-2"></i>View Customers</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Create Customers</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Edit Customers</li>
                                    <li><i class="fa fa-times text-danger me-2"></i>Delete Customers</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection