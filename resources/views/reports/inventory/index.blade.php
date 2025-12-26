@extends('layouts.app')

@section('title', 'گزارش انبار')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">گزارش انبار</h3>
                <p class="text-muted mb-0">وضعیت کامل انبار و ارزیابی</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>کل محصولات</h6>
                        <h2>{{ $products->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>کل ارزش</h6>
                        <h2>@currency($totalValue)</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>موجودی کم</h6>
                        <h2>{{ $lowStockProducts }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6>ناموجود</h6>
                        <h2>{{ $outOfStockProducts }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>محصول</th>
                                <th>نوع</th>
                                <th>موجودی فعلی</th>
                                <th>قیمت واحد</th>
                                <th>ارزش موجودی</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">شناسه: {{ $product->id }}</small>
                                    </td>
                                    <td>{{ $product->type }}</td>
                                    <td>{{ $product->current_stock }}</td>
                                    <td>@currency($product->price_per_unit)</td>
                                    <td>@currency($product->stock_value)</td>
                                    <td>
                                        @if($product->current_stock == 0)
                                            <span class="badge bg-danger">ناموجود</span>
                                        @elseif($product->current_stock <= 10)
                                            <span class="badge bg-warning">موجودی کم</span>
                                        @else
                                            <span class="badge bg-success">موجود</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection