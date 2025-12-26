@extends('layouts.app')
{{-- i want to use dynamic data in each file --}}
@section('title', 'Product Details')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">جزئیات محصول</h3>
                <p class="text-muted mb-0">مشاهده اطلاعات محصول</p>
            </div>
            <div>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit me-1"></i> ویرایش محصول
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> بازگشت به محصولات
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Product Information -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-box me-2"></i>اطلاعات محصول</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">{{('Product Name') }}</label>
                                <p class="fw-bold">{{ $product->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">نوع محصول</label>
                                <p class="fw-bold">{{ $product->type }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">نوع بسته‌بندی</label>
                                <p class="fw-bold">{{ $product->package_type }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">وزن</label>
                                <p class="fw-bold">{{ $product->weight }} کیلوگرم</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">قیمت هر واحد</label>
                                <p class="fw-bold text-success">{{ number_format($product->price_per_unit, 2) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">قیمت هر کارتن</label>
                                <p class="fw-bold text-success">{{ number_format($product->price_per_carton, 2) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">تعداد واحد در کارتن</label>
                                <p class="fw-bold">{{ $product->quantity_per_carton }} واحد</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">تاریخ ایجاد</label>
                                <p class="fw-bold">{{ date('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-warehouse me-2"></i>اطلاعات موجودی</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h2 class="text-primary">{{ $product->stock }}</h2>
                            <p class="text-muted">موجودی فعلی</p>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('stocks.in') }}" class="btn btn-success">
                                <i class="fa fa-plus me-1"></i> ورود موجودی
                            </a>
                            <a href="{{ route('stocks.out') }}" class="btn btn-warning">
                                <i class="fa fa-minus me-1"></i> خروج موجودی
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection