@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Stock History</h3>
                <p class="text-muted mb-0">Manage inventory and stock movements</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Max Level</th>
                                <th>Last Updated</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                            <div>
                                                <h6 class="mb-0">Product {{ $i }}</h6>
                                                <small class="text-muted">SKU: SKU-00{{ $i }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Category {{ $i % 3 + 1 }}</td>
                                    <td>{{ rand(5, 100) }}</td>
                                    <td>10</td>
                                    <td>100</td>
                                    <td>{{ date('d M Y', strtotime("-{$i} days")) }}</td>
                                    <td>
                                        @if($i % 4 == 0)
                                            <span class="badge bg-danger">Low Stock</span>
                                        @elseif($i % 5 == 0)
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @else
                                            <span class="badge bg-success">In Stock</span>
                                        @endif
                                    </td>

                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </form>
    </div>
@endsection