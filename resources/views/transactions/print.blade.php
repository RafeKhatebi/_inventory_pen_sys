@extends('layouts.app')
@section('title', 'Print Transaction')
@section('content')
    <div class="container-fluid">
        <h3 class="mb-3">Print Transaction #{{ $transaction->id }}</h3>

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
            </div>
        </div>
    </div>

@endsection

<script>
    //  Don't show the header and footer when printing
    window.onload = function () {
        window.print();
    };

</script>