@extends('layouts.app')

@section('title', 'Profile - Add New User')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h3 class="mb-1">Add New User</h3>
            </div>
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back to Users
                </a>
            </div>
        </div>

        <!-- User Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <!-- Basic Information -->
                            <div class="mb-1">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fa fa-info-circle me-2 text-primary"></i>Basic Information
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="full_name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="user_type" class="form-label">User Type *</label>
                                        <select class="form-select" id="user_type" name="user_type" required>
                                            <option value="" disabled selected>Select User Type</option>
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="user_name" class="form-label">User Name *</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="password" class="form-label">Password *</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Save User
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