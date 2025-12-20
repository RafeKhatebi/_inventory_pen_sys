@extends('layouts.app')

@section('title', 'Complete-Reports')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Complete Reports Overview</h3>
                <p class="text-muted mb-0">Welcome back, Admin! Here's what's happening today.</p>
            </div>
            <div>
            </div>
        </div>
        <div class="d-flex justify-items-center align-items-center mb-4">
            <label for="search" class="form-control">Search</label>
            <label for="text">Start Date: </label>
            <input type="search" class="form-control">
            <label for="text">End Date: </label>
            <input type="search" class="form-control">
        </div>
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary p-3 me-3">
                            <i class="fa fa-rupee-sign fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Products</p>
                            <h4 class="mb-0">25,480</h4>
                            <small class="text-success">
                                <i class="fa fa-arrow-up me-1"></i> 12%
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success p-3 me-3">
                            <i class="fa fa-chart-bar fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Types</p>
                            <h4 class="mb-0">₹1,25,480</h4>
                            <small class="text-success">
                                <i class="fa fa-arrow-up me-1"></i> 8%
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning p-3 me-3">
                            <i class="fa fa-users fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Low Stock</p>
                            <h4 class="mb-0">245</h4>
                            <small class="text-success">
                                <i class="fa fa-user-plus me-1"></i> +5
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-danger p-3 me-3">
                            <i class="fa fa-exclamation-triangle fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Low Stock Items</p>
                            <h4 class="mb-0">12</h4>
                            <small class="text-danger">
                                <i class="fa fa-arrow-down me-1"></i> Needs attention
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary p-3 me-3">
                            <i class="fa fa-rupee-sign fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Products</p>
                            <h4 class="mb-0">25,480</h4>
                            <small class="text-success">
                                <i class="fa fa-arrow-up me-1"></i> 12%
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success p-3 me-3">
                            <i class="fa fa-chart-bar fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Total Types</p>
                            <h4 class="mb-0">₹1,25,480</h4>
                            <small class="text-success">
                                <i class="fa fa-arrow-up me-1"></i> 8%
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning p-3 me-3">
                            <i class="fa fa-users fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Low Stock</p>
                            <h4 class="mb-0">245</h4>
                            <small class="text-success">
                                <i class="fa fa-user-plus me-1"></i> +5
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-danger p-3 me-3">
                            <i class="fa fa-exclamation-triangle fa-2x text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1">Low Stock Items</p>
                            <h4 class="mb-0">12</h4>
                            <small class="text-danger">
                                <i class="fa fa-arrow-down me-1"></i> Needs attention
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Transactions</h5>
                        <a href="/sales" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV-001</td>
                                        <td>John Doe</td>
                                        <td>15 Jan 2024</td>
                                        <td>₹5,250</td>
                                        <td><span class="badge bg-success">Cash</span></td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV-002</td>
                                        <td>Jane Smith</td>
                                        <td>15 Jan 2024</td>
                                        <td>₹3,800</td>
                                        <td><span class="badge bg-warning">Credit</span></td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV-003</td>
                                        <td>Mike Johnson</td>
                                        <td>14 Jan 2024</td>
                                        <td>₹8,900</td>
                                        <td><span class="badge bg-success">Cash</span></td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV-004</td>
                                        <td>Sarah Williams</td>
                                        <td>14 Jan 2024</td>
                                        <td>₹2,450</td>
                                        <td><span class="badge bg-info">Card</span></td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV-005</td>
                                        <td>Robert Brown</td>
                                        <td>13 Jan 2024</td>
                                        <td>₹6,750</td>
                                        <td><span class="badge bg-warning">Credit</span></td>
                                        <td><span class="badge bg-danger">Overdue</span></td>
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