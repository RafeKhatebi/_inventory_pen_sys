<!-- Customer Information -->
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-user me-2 text-primary"></i>Customer Information
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Customer Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $customer->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">Phone Number *</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                   id="phone" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control @error('address') is-invalid @enderror" 
                  id="address" name="address" rows="3">{{ old('address', $customer->address ?? '') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    @if(isset($customer))
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="total_credit" class="form-label">Total Credit</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" class="form-control" 
                       id="total_credit" name="total_credit" value="{{ $customer->total_credit ?? 0 }}" readonly>
            </div>
            <small class="text-muted">This is calculated automatically from credit transactions</small>
        </div>
    </div>
    @endif
</div>