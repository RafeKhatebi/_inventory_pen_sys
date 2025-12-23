<!-- Credit Transaction Information -->
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-credit-card me-2 text-primary"></i>Credit Transaction
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="customer_id" class="form-label">Customer *</label>
            <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                <option value="">Select Customer</option>
                <!-- Customers will be loaded dynamically -->
                <option value="1" {{ old('customer_id', $credit->customer_id ?? '') == 1 ? 'selected' : '' }}>John Doe</option>
                <option value="2" {{ old('customer_id', $credit->customer_id ?? '') == 2 ? 'selected' : '' }}>Jane Smith</option>
            </select>
            @error('customer_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="amount" class="form-label">Amount *</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                       id="amount" name="amount" value="{{ old('amount', $credit->amount ?? '') }}" min="0.01" required>
            </div>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="credit_date" class="form-label">Credit Date *</label>
            <input type="date" class="form-control @error('credit_date') is-invalid @enderror" 
                   id="credit_date" name="credit_date" value="{{ old('credit_date', $credit->credit_date ?? date('Y-m-d')) }}" required>
            @error('credit_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="is_paid" class="form-label">Payment Status</label>
            <select class="form-select @error('is_paid') is-invalid @enderror" id="is_paid" name="is_paid">
                <option value="0" {{ old('is_paid', $credit->is_paid ?? 0) == 0 ? 'selected' : '' }}>Unpaid</option>
                <option value="1" {{ old('is_paid', $credit->is_paid ?? 0) == 1 ? 'selected' : '' }}>Paid</option>
            </select>
            @error('is_paid')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" 
                  id="description" name="description" rows="3" placeholder="Description of the credit transaction">{{ old('description', $credit->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>