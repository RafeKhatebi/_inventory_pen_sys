@extends('layouts.app')

@section('title', 'Add New Transactions')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2custom.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h3 class="mb-1">Add New Transactions</h3>
            </div>
        </div>
        <!-- customer Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf

                           <div class="mb-3">
                                <label for="customer_id" class="form-label">customer *</label>
                                <select name="customer_id" id="customer_id" class="form-control select2" required>
                                    <option value="">Search and Select Customer...</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ request('customer') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} ({{ $customer->phone }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Transaction Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="give">Give Money (Customer pays me) + <i class="fa fa-arrow-up"></i></option>
                                    <option value="take">Take Money (I give credit to customer) - <i class="fa fa-arrow-down"></i></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Amount</label>
                                <input type="number" step="0.01" name="amount" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="transaction_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Note</label>
                                <input type="text" name="note" class="form-control">
                            </div>

                            <button class="btn btn-primary">Save Transaction</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Search and select a customer...',
        allowClear: true,
        width: '100%',
        matcher: function(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }
            if (typeof data.text === 'undefined') {
                return null;
            }
            if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                return data;
            }
            return null;
        }
    });
});
</script>
@endpush
@endsection