<!-- Stock Transaction Information -->
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-warehouse me-2 text-primary"></i>Stock Transaction
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="product_id" class="form-label">Product *</label>
            <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id"
                required>
                <option value="">Select Product</option>
                <!-- Products will be loaded dynamically -->
                <option value="1" {{ old('product_id', $stock->product_id ?? '') == 1 ? 'selected' : '' }}>Sample Product
                    1</option>
                <option value="2" {{ old('product_id', $stock->product_id ?? '') == 2 ? 'selected' : '' }}>Sample Product
                    2</option>
            </select>
            @error('product_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="quantity" class="form-label">Quantity *</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                name="quantity" value="{{ old('quantity', $stock->quantity ?? '') }}" min="1" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="type" class="form-label">Transaction Type *</label>
            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                <option value="">Select Type</option>
                <option value="in" {{ old('type', $stock->type ?? $defaultType ?? '') == 'in' ? 'selected' : '' }}>Stock
                    In</option>
                <option value="out" {{ old('type', $stock->type ?? $defaultType ?? '') == 'out' ? 'selected' : '' }}>Stock
                    Out</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="note" class="form-label">Note</label>
        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3"
            placeholder="Optional note about this transaction">{{ old('note', $stock->note ?? '') }}</textarea>
        @error('note')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>