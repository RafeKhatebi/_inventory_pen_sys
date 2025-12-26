@extends('layouts.app')

@section('title', 'گزارش خلاصه کامل')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">گزارش خلاصه کامل</h3>
                <p class="text-muted mb-0">نمای کلی جامع سیستم و تحلیلها</p>
            </div>
            <div>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fa fa-print me-1"></i> چاپ گزارش
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>کل محصولات</h6>
                        <h2>{{ $totalProducts }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>ارزش موجودی</h6>
                        <h2>@currency($totalStockValue)</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6>کل مشتریان</h6>
                        <h2>{{ $totalCustomers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>کل اعتبارات</h6>
                        <h2>@currency($totalCredits)</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Stock Movements -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">حرکات اخیر موجودی</h5>
                    </div>
                    <div class="card-body">
                        @forelse($recentStocks as $stock)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <div>
                                    <strong>{{ $stock->product->name }}</strong>
                                    <br>
                                    <small class="text-muted">@jalali($stock->created_at)</small>
                                </div>
                                <span class="badge bg-{{ $stock->type == 'in' ? 'success' : 'warning' }}">
                                    {{ $stock->type == 'in' ? '+' : '-' }}{{ $stock->quantity }}
                                </span>
                            </div>
                        @empty
                            <p class="text-muted text-center">هیچ حرکت موجودی اخیر وجود ندارد</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">تراکنشهای اخیر</h5>
                    </div>
                    <div class="card-body">
                        @forelse($recentTransactions as $transaction)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <div>
                                    <strong>{{ $transaction->customer->name }}</strong>
                                    <br>
                                    <small class="text-muted">@jalali($transaction->transaction_date)</small>
                                </div>
                                <span class="badge bg-{{ $transaction->type == 'take' ? 'warning' : 'success' }}">
                                    {{ $transaction->type == 'take' ? 'اعتبار گرفت' : 'پرداخت کرد' }} @currency($transaction->amount)
                                </span>
                            </div>
                        @empty
                            <p class="text-muted text-center">هیچ تراکنش اخیر وجود ندارد</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">هشدار موجودی کم</h5>
                    </div>
                    <div class="card-body">
                        @forelse($lowStockProducts as $product)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $product->type }}</small>
                                </div>
                                <span class="badge bg-{{ $product->current_stock == 0 ? 'danger' : 'warning' }}">
                                    {{ $product->current_stock }} باقیمانده
                                </span>
                            </div>
                        @empty
                            <p class="text-muted text-center">تمام محصولات موجودی کافی دارند</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection