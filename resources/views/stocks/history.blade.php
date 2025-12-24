@extends('layouts.app')

@section('title', 'Stock History')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Stock Movement History</h3>
                <p class="text-muted mb-0">Track all stock in and out transactions</p>
            </div>
            <div>
                <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa fa-arrow-left me-1"></i> Back to Stock
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Note</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stocks as $stock)
                                <tr>
                                    <td>
                                        <div>
                                            <strong>{{ $stock->created_at->format('d M Y') }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $stock->created_at->format('H:i A') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-{{ $stock->type == 'in' ? 'success' : 'warning' }} text-white rounded d-flex align-items-center justify-content-center me-2"
                                                style="width: 40px; height: 40px;">
                                                <i class="fa fa-{{ $stock->type == 'in' ? 'arrow-down' : 'arrow-up' }}"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $stock->product->name }}</h6>
                                                <small class="text-muted">{{ $stock->product->type }} -
                                                    {{ $stock->product->package_type }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $stock->type == 'in' ? 'success' : 'warning' }} fs-6">
                                            <i class="fa fa-{{ $stock->type == 'in' ? 'plus' : 'minus' }} me-1"></i>
                                            Stock {{ ucfirst($stock->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-5 text-{{ $stock->type == 'in' ? 'success' : 'warning' }}">
                                            {{ $stock->type == 'in' ? '+' : '-' }}{{ $stock->quantity }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($stock->note)
                                            <span class="text-muted">{{ Str::limit($stock->note, 50) }}</span>
                                        @else
                                            <span class="text-muted fst-italic">No note</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Completed</span>
                                        <br>
                                        <small class="text-muted">{{ $stock->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fa fa-history fa-3x mb-3"></i>
                                            <h5>No Stock Movements Found</h5>
                                            <p>Start by adding some stock transactions</p>
                                            <div class="mt-3">
                                                <a href="{{ route('stocks.in') }}" class="btn btn-primary me-2">
                                                    <i class="fa fa-plus me-1"></i> Add Stock
                                                </a>
                                                <a href="{{ route('stocks.out') }}" class="btn btn-warning">
                                                    <i class="fa fa-minus me-1"></i> Remove Stock
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($stocks->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $stocks->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection