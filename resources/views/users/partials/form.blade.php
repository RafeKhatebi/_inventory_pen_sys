<!-- User Information -->
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-user me-2 text-primary"></i>اطلاعات کاربر
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">نام کامل*</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $user->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">ایمیل نام کاربری*</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email', $user->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">{{ isset($user) ? 'New Password' : 'Password *' }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" {{ !isset($user) ? 'required' : '' }}>
            @if(isset($user))
                <small class="text-muted">خالی بگذارید در صورت عدم تغییر رمز عبور</small>
            @endif
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="password_confirmation" class="form-label">تایید رمز عبور</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="role_id" class="form-label">نقش *</label>
            <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                <option value="">انتخاب نقش</option>
                <option value="1" {{ old('role_id', $user->role_id ?? '') == 1 ? 'selected' : '' }}>مدیر کل</option>
                <option value="2" {{ old('role_id', $user->role_id ?? '') == 2 ? 'selected' : '' }}>مدیر</option>
                <option value="3" {{ old('role_id', $user->role_id ?? '') == 3 ? 'selected' : '' }}>کارمند</option>
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>