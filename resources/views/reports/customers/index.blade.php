@extends('layouts.app')

@section('title', 'گزارش مشتریان')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">گزارش مشتریان</h3>
                <p class="text-muted mb-0">تحلیل اعتبار مشتریان و خلاصه تراکنشها</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>کل مشتریان</h6>
                        <h2>{{ $totalCustomers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>کل اعتبارات</h6>
                        <h2>@currency($totalCredits)</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>مشتریان فعال</h6>
                        <h2>{{ $activeCustomers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>مشتری</th>
                                <th>تلفن</th>
                                <th>موجودی فعلی</th>
                                <th>حد اعتبار</th>
                                <th>کل تراکنشها</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        <strong>{{ $customer->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $customer->address }}</small>
                                    </td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <span class="fw-bold {{ $customer->current_balance > 0 ? 'text-warning' : 'text-success' }}">
                                            @currency($customer->current_balance)
                                        </span>
                                    </td>
                                    <td>@currency($customer->credit_limit)</td>
                                    <td>{{ $customer->total_transactions }}</td>
                                    <td>
                                        @if($customer->current_balance >= $customer->credit_limit)
                                            <span class="badge bg-danger">حد اعتبار رسیده</span>
                                        @elseif($customer->current_balance > ($customer->credit_limit * 0.8))
                                            <span class="badge bg-warning">نزدیک حد</span>
                                        @else
                                            <span class="badge bg-success">وضعیت خوب</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($customers->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $customers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection