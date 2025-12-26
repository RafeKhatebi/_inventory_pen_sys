@extends('layouts.app')
@section('title', 'Transactions')

@section('content')
    <div class="container-fluid">

        <h3 class="mb-3">Transactions</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->customer->name }}</td>
                        <td>
                            <span class="badge bg-{{ $transaction->type === 'take' ? 'danger' : 'success' }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </td>
                        <td>@currency($transaction->amount)</td>
                        {{-- use JalaliHelper --}}
                        <td>@jalali($transaction->transaction_date)</td>
                        <td>{{ $transaction->note }}</td>
                        <td>
                            <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-view btn-sm">
                                <i class="fas fa-eye"></i>
                                View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No transactions found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $transactions->links() }}

    </div>
@endsection