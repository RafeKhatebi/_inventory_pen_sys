@extends('layouts.app')

@section('title', 'مدیریت موجودی')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">مدیریت موجودی</h3>
                <p class="text-muted mb-0">مدیریت انبار و حرکات موجودی</p>
            </div>
            <div class="d-flex gap-2">
                <!-- Search Form -->
                <form method="GET" action="{{ route('stocks.index') }}" class="d-flex">
                    <input type="search" name="search" class="form-control" placeholder="جستجوی محصولات..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary ms-2">
                        <i class="fa fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary ms-1">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>کل محصولات</h6>
                        <h2>{{ $totalProducts }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>کل موجودی</h6>
                        <h2>{{ number_format($totalInStock) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6>ناموجود</h6>
                        <h2>{{ $outOfStockCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>محصول</th>
                                <th>نوع</th>
                                <th>موجودی فعلی</th>
                                <th>قیمت/واحد</th>
                                <th>قیمت/کارتن</th>
                                <th>آخرین بروزرسانی</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center me-2"
                                                style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($product->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $product->name }}</h6>
                                                <small class="text-muted">شناسه: {{ $product->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product->type }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $product->current_stock ?? 0 }}</span>
                                        <small class="text-muted d-block">{{ $product->package_type }}</small>
                                    </td>
                                    <td>@currency($product->price_per_unit)</td>
                                    <td>@currency($product->price_per_carton)</td>
                                    <td>@jalali($product->updated_at)</td>
                                    <td>
                                        @if($product->current_stock == 0)
                                            <span class="badge bg-danger">ناموجود</span>
                                        @elseif($product->current_stock <= 10)
                                            <span class="badge bg-warning">موجودی کم</span>
                                        @else
                                            <span class="badge bg-success">موجود</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('stocks.in') }}?product={{ $product->id }}"
                                            class="btn btn-sm btn-success me-1" title="افزودن موجودی">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="{{ route('stocks.out') }}?product={{ $product->id }}"
                                            class="btn btn-sm btn-warning" title="کاهش موجودی">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fa fa-box fa-3x mb-3"></i>
                                            <p>هیچ محصولی یافت نشد. <a href="{{ route('products.create') }}">اولین محصول خود را اضافه کنید</a></p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($products->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection