@extends('layouts.app')

@section('title', 'Inventory-Reports')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Backup Overview</h3>
                <p class="text-muted mb-0">Welcome back, Admin! Here's you can backup and restore your data.</p>
            </div>
            <div>
            </div>
        </div>

        <!-- Recent Backups -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Backups </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Backup No</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Size</th>
                                        <th>Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV-001</td>
                                        <td>backup_2024_01_15</td>
                                        <td>15 Jan 2024</td>
                                        <td>256 MB</td>
                                        <td><span class="badge bg-success">Manual</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1">
                                                <i class="fa fa-download"></i>
                                                <button class="btn btn-sm btn-danger"></button>
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
        </div>
    </div>
@endsection