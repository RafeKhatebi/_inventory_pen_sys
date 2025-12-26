<!-- Customer Information -->
@php($customer = $customer ?? null)
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-user me-2 text-primary"></i>اطلاعات مشتری
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">نام مشتری *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $customer->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">شماره تلفن *</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                value="{{ old('phone', $customer->phone ?? '') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">آدرس</label>
        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
            rows="3">{{ old('address', $customer->address ?? '') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="credit_limit" class="form-label">حد اعتبار *</label>
            <input type="number" step="0.01" class="form-control @error('credit_limit') is-invalid @enderror"
                id="credit_limit" name="credit_limit" value="{{ old('credit_limit', $customer->credit_limit ?? 0) }}"
                required>

            @error('credit_limit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>