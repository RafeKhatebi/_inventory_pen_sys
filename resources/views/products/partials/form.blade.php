<!-- Basic Information -->
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-info-circle me-2 text-primary"></i>اطلاعات پایه
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">نام محصول *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $product->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="type" class="form-label">نوع محصول *</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type"
                value="{{ old('type', $product->type ?? '') }}" required>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="package_type" class="form-label">نوع بسته بندی *</label>
            <input type="text" class="form-control @error('package_type') is-invalid @enderror" id="package_type"
                name="package_type" value="{{ old('package_type', $product->package_type ?? '') }}" required>
            @error('package_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="weight" class="form-label">وزن (کیلوگرم) *</label>
            <div class="input-group">
                <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" id="weight"
                    name="weight" value="{{ old('weight', $product->weight ?? '') }}" required>
                <span class="input-group-text">کیلوگرم</span>
            </div>
            @error('weight')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- Pricing Information -->
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-dollar-sign me-2 text-primary"></i>اطلاعات قیمت گذاری
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="price_per_unit" class="form-label">قیمت هر واحد *</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" class="form-control @error('price_per_unit') is-invalid @enderror"
                    id="price_per_unit" name="price_per_unit"
                    value="{{ old('price_per_unit', $product->price_per_unit ?? '') }}" required>
            </div>
            @error('price_per_unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="price_per_carton" class="form-label">قیمت هر کارتن *</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" class="form-control @error('price_per_carton') is-invalid @enderror"
                    id="price_per_carton" name="price_per_carton"
                    value="{{ old('price_per_carton', $product->price_per_carton ?? '') }}" required>
            </div>
            @error('price_per_carton')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="quantity_per_carton" class="form-label">تعداد در هر کارتن *</label>
            <input type="number" class="form-control @error('quantity_per_carton') is-invalid @enderror"
                id="quantity_per_carton" name="quantity_per_carton"
                value="{{ old('quantity_per_carton', $product->quantity_per_carton ?? '') }}" required>
            @error('quantity_per_carton')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>