@extends('layouts.app')
@section('title', 'تراکنشها')

@section('content')
    <div class="container-fluid">

        <h3 class="mb-3">تراکنشها</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>مشتری</th>
                    <th>نوع</th>
                    <th>مبلغ</th>
                    <th>تاریخ</th>
                    <th>یادداشت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->customer->name }}</td>
                        <td>
                            <span class="badge bg-{{ $transaction->type === 'take' ? 'danger' : 'success' }}">
                                {{ $transaction->type === 'take' ? 'اعتبار' : 'پرداخت' }}
                            </span>
                        </td>
                        <td>@currency($transaction->amount)</td>
                        <td>@jalali($transaction->transaction_date)</td>
                        <td>{{ $transaction->note }}</td>
                        <td>
                            <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-view btn-sm">
                                <i class="fas fa-eye"></i>
                                مشاهده</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">هیچ تراکنشی یافت نشد</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $transactions->links() }}

    </div>
@endsection