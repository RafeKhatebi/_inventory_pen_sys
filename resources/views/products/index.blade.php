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
            <div>
                {{-- search Box --}}
                <span><strong>Search</strong></span>
                <input type="search" class="form-control">
            </div>
        </div>

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
                                <th>package_type</th>
                                <th>price_per_unit</th>
                                <th>price_per_carton</th>
                                <th>weight</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                        <div>
                                            <h6 class="mb-0">Laptop</h6>
                                            <small class="text-muted">SKU: LP-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics</td>
                                <td>Electronics-section</td>
                                <td>$99</td>
                                <td>$9900</td>
                                <td>34kg</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-1">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection