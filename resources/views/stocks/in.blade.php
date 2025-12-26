@extends('layouts.app')

@section('title', 'ورود کالا')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2custom.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">ورود کالا</h3>
                <p class="text-muted mb-0">افزودن موجودی به انبار</p>
            </div>
            <div>
                <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> بازگشت به موجودی
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('stocks.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="in">

                            <div class="mb-3">
                                <label for="product_id" class="form-label">محصول *</label>
                                <select name="product_id" id="product_id" class="form-control select2" required>
                                    <option value="">جستجو و انتخاب محصول...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} - {{ $product->type }} ({{ $product->package_type }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                    <label for="quantity" class="form-label">مقدار *</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" required value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">یادداشت</label>
                                <textarea name="note" id="note" class="form-control" rows="3" placeholder="یادداشت اختیاری درباره این تراکنش موجودی">{{ old('note') }}</textarea>
                                @error('note')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fa fa-redo me-1"></i> ریست
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus me-1"></i> افزودن موجودی
                                </button>
                            </div>
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
        placeholder: 'جستجو و انتخاب محصول...',
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