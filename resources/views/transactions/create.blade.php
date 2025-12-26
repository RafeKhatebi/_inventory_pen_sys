@extends('layouts.app')

@section('title', 'افزودن تراکنش جدید')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2custom.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h3 class="mb-1">افزودن تراکنش جدید</h3>
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
                                <label for="customer_id" class="form-label">مشتری *</label>
                                <select name="customer_id" id="customer_id" class="form-control select2" required>
                                    <option value="">جستجو و انتخاب مشتری...</option>
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
                                <label>نوع تراکنش</label>
                                <select name="type" class="form-select" required>
                                    <option value="give">دریافت پول (مشتری پرداخت میکند) + <i class="fa fa-arrow-up"></i></option>
                                    <option value="take">اعتبار دادن (من اعتبار میدهم) - <i class="fa fa-arrow-down"></i></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>مبلغ</label>
                                <input type="number" step="0.01" name="amount" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>تاریخ</label>
                                <input type="date" name="transaction_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="mb-3">
                                <label>یادداشت</label>
                                <input type="text" name="note" class="form-control">
                            </div>

                            <button class="btn btn-primary">ذخیره تراکنش</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script src="{{ asset('assets/dist/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'جستجو و انتخاب مشتری...',
        allowClear: true,
        width: '100%',
        dropdownAutoWidth: true,
        tags: false,
        tokenSeparators: [],
        minimumResultsForSearch: 0,
        language: {
            noResults: function() {
                return 'نتیجهای یافت نشد';
            },
            searching: function() {
                return 'در حال جستجو...';
            },
            inputTooShort: function() {
                return 'لطفا حداقل یک کاراکتر وارد کنید';
            }
        }
    });
});
</script>
@endpush
@endsection