@extends('layouts.app')

@section('title', 'خروج کالا')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2custom.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">خروج کالا</h3>
                <p class="text-muted mb-0">حذف موجودی از انبار</p>
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
                            <input type="hidden" name="type" value="out">

                            <div class="mb-3">
                                <label for="product_id" class="form-label">محصول *</label>
                                <select name="product_id" id="product_id" class="form-control select2" required>
                                    <option value="">جستجو و انتخاب محصول...</option>
                                    @foreach ($products as $product)
                                        @php
                                            $currentStock = $product->stock()->selectRaw('SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')->value('current_stock') ?? 0;
                                        @endphp
                                        <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }} data-stock="{{ $currentStock }}">
                                            {{ $product->name }} - {{ $product->type }} (موجودی: {{ $currentStock }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">مقدار *</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1" required
                                    value="{{ old('quantity') }}">
                                <small class="text-muted">موجودی قابل دسترس هنگام انتخاب محصول نمایش داده میشود</small>
                                @error('quantity')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">یادداشت</label>
                                <textarea name="note" id="note" class="form-control" rows="3"
                                    placeholder="یادداشت اختیاری درباره این تراکنش موجودی (مثلاً فروش، آسیب، انتقال)">{{ old('note') }}</textarea>
                                @error('note')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="alert alert-warning" id="stock-warning" style="display: none;">
                                <i class="fa fa-exclamation-triangle me-2"></i>
                                <span id="warning-message"></span>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fa fa-redo me-1"></i> ریست
                                </button>
                                <button type="submit" class="btn btn-warning" id="submit-btn">
                                    <i class="fa fa-minus me-1"></i> حذف موجودی
                                </button>
                            </div>
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
            $(document).ready(function () {
                $('.select2').select2({
                    placeholder: 'جستجو و انتخاب محصول...',
                    allowClear: true,
                    width: '100%',
                    minimumResultsForSearch: 0
                });
            });

            document.getElementById('product_id').addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const currentStock = selectedOption.getAttribute('data-stock') || 0;
                const quantityInput = document.getElementById('quantity');
                const warning = document.getElementById('stock-warning');
                const warningMessage = document.getElementById('warning-message');
                const submitBtn = document.getElementById('submit-btn');

                if (currentStock == 0) {
                    warning.style.display = 'block';
                    warningMessage.textContent = 'این محصول ناموجود است!';
                    submitBtn.disabled = true;
                    quantityInput.max = 0;
                } else {
                    warning.style.display = 'none';
                    submitBtn.disabled = false;
                    quantityInput.max = currentStock;
                    quantityInput.placeholder = `حداکثر: ${currentStock}`;
                }
            });

            document.getElementById('quantity').addEventListener('input', function () {
                const selectedOption = document.getElementById('product_id').options[document.getElementById('product_id').selectedIndex];
                const currentStock = selectedOption.getAttribute('data-stock') || 0;
                const quantity = parseInt(this.value);
                const warning = document.getElementById('stock-warning');
                const warningMessage = document.getElementById('warning-message');

                if (quantity > currentStock) {
                    warning.style.display = 'block';
                    warningMessage.textContent = `مقدار نمیتواند از موجودی قابل دسترس (${currentStock}) بیشتر باشد`;
                } else {
                    warning.style.display = 'none';
                }
            });
        </script>
    @endpush
@endsection