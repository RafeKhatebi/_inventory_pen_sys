@extends('layouts.app')

@section('title', 'تاریخچه موجودی')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">تاریخچه حرکات موجودی</h3>
                <p class="text-muted mb-0">پیگیری تمام تراکنشهای ورود و خروج موجودی</p>
            </div>
            <div>
                <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa fa-arrow-left me-1"></i> بازگشت به موجودی
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>تاریخ و زمان</th>
                                <th>محصول</th>
                                <th>نوع</th>
                                <th>مقدار</th>
                                <th>یادداشت</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stocks as $stock)
                                <tr>
                                    <td>
                                        <div>
                                            <strong>@jalali($stock->created_at)</strong>
                                            <br>
                                            <small class="text-muted">{{ $stock->created_at->format('H:i') }}</small>
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
                                            {{ $stock->type == 'in' ? 'ورود کالا' : 'خروج کالا' }}
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
                                            <span class="text-muted fst-italic">بدون یادداشت</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">تکمیل شده</span>
                                        <br>
                                        <small class="text-muted">{{ $stock->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fa fa-history fa-3x mb-3"></i>
                                            <h5>هیچ حرکت موجودی یافت نشد</h5>
                                            <p>با افزودن تراکنشهای موجودی شروع کنید</p>
                                            <div class="mt-3">
                                                <a href="{{ route('stocks.in') }}" class="btn btn-primary me-2">
                                                    <i class="fa fa-plus me-1"></i> افزودن موجودی
                                                </a>
                                                <a href="{{ route('stocks.out') }}" class="btn btn-warning">
                                                    <i class="fa fa-minus me-1"></i> حذف موجودی
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