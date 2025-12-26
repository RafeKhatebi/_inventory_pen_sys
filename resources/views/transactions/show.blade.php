{{-- Show the Transaction --}}
@extends('layouts.app')
@section('title', 'Transaction Details')
@section('content')
    <div class="container-fluid">
        <h3 class="mb-3">تراکنش #{{ $transaction->id }}</h3>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">تراکنش #{{ $transaction->id }}</h5>
                <p class="card-text"><strong>مشتری:</strong> {{ $transaction->customer->name }}
                    ({{ $transaction->customer->phone }})</p>
                <p class="card-text"><strong>نوع:</strong>
                    <span class="badge bg-{{ $transaction->type === 'take' ? 'danger' : 'success' }}">
                        {{ ucfirst($transaction->type) }}
                    </span>
                </p>
                <p class="card-text"><strong>مقدار:</strong> {{ $transaction->amount }}</p>
                <p class="card-text"><strong>تاریخ:</strong> {{ $transaction->transaction_date }}</p>
                <p class="card-text"><strong>یادداشت:</strong> {{ $transaction->note }}</p>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">بازگشت به تراکنش‌ها</a>
            </div>
        </div>
    </div>
@endsection