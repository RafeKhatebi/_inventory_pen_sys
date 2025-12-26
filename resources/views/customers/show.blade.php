@extends('layouts.app')
{{-- updated to use dynamic data --}}
@section('title', 'Customer Details')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">جزئیات مشتری</h3>
                <p class="text-muted mb-0">مشاهده اطلاعات مشتری و تاریخچه اعتبار</p>
            </div>
            <div>
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit me-1"></i> ویرایش
                </a>
                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> بازگشت به مشتریان
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Customer Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-user me-2"></i>اطلاعات مشتری</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ $customer->name }}&background=random"
                                class="rounded-circle mb-2" width="80" alt="Customer Avatar">
                            <h5>{{ $customer->name }}</h5>
                            <p class="text-muted">{{ $customer->id }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">تلفن</label>
                            <p class="fw-bold">{{ $customer->phone }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">آدرس</label>
                            <p class="fw-bold">{{ $customer->address }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">حد اعتبار</label>
                            <h4 class="text-danger">@currency($customer->credit_limit)</h4>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">عضو از</label>
                            <p class="fw-bold">@jalali($customer->created_at)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Credit History -->
            {{-- updated to use dynamic data --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-credit-card me-2"></i>تاریخچه اعتبار</h5>
                        <a href="{{ route('customers.downloadReport', $customer->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-download me-1"></i> دانلود گزارش
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>تاریخ</th>
                                        <th>توضیحات</th>
                                        <th>مقدار</th>
                                        <th>نوع</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- loop to get a transaction --}}
                                    @forelse($transactions as $transaction)
                                        <tr>
                                            <td>@jalali($transaction->transaction_date)</td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>@currency($transaction->amount)</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $transaction->type == 'take' ? 'warning' : 'success' }}">
                                                    {{ $transaction->type == 'take' ? 'اعتبار گرفت' : 'پرداخت کرد' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($transaction->status == 'pending')
                                                    <span class="badge bg-secondary">در انتظار</span>
                                                @elseif($transaction->status == 'completed')
                                                    <span class="badge bg-success">تکمیل شد</span>
                                                @else
                                                    <span class="badge bg-danger">لغو شد</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('transactions.show', $transaction->id) }}"
                                                    class="btn btn-sm btn-outline-info">
                                                    <i class="fa fa-eye me-1"></i> مشاهده
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr></tr>
                                        <td colspan="6" class="text-center py-4">
                                            <p class="text-muted">هیچ تراکنشی برای این مشتری وجود ندارد.</p>
                                        </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection