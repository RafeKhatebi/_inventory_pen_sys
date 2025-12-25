{{-- Show the Transaction --}}
@extends('layouts.app')
@section('title', 'Transaction Details')
@section('content')
    <div class="container-fluid">
        <h3 class="mb-3">Transaction Details</h3>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Transaction #{{ $transaction->id }}</h5>
                <p class="card-text"><strong>Customer:</strong> {{ $transaction->customer->name }}
                    ({{ $transaction->customer->phone }})</p>
                <p class="card-text"><strong>Type:</strong>
                    <span class="badge bg-{{ $transaction->type === 'take' ? 'danger' : 'success' }}">
                        {{ ucfirst($transaction->type) }}
                    </span>
                </p>
                <p class="card-text"><strong>Amount:</strong> {{ $transaction->amount }}</p>
                <p class="card-text"><strong>Date:</strong> {{ $transaction->transaction_date }}</p>
                <p class="card-text"><strong>Note:</strong> {{ $transaction->note }}</p>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back to Transactions</a>
            </div>
        </div>
    </div>
@endsection