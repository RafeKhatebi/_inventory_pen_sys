<!-- User Information -->
<div class="mb-4">
    <h5 class="mb-3 border-bottom pb-2">
        <i class="fa fa-user me-2 text-primary"></i>User Information
    </h5>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Full Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email Address *</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">{{ isset($user) ? 'New Password' : 'Password *' }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" {{ !isset($user) ? 'required' : '' }}>
            @if(isset($user))
                <small class="text-muted">Leave empty to keep current password</small>
            @endif
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                   id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="role_id" class="form-label">Role *</label>
            <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                <option value="">Select Role</option>
                <option value="1" {{ old('role_id', $user->role_id ?? '') == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ old('role_id', $user->role_id ?? '') == 2 ? 'selected' : '' }}>Manager</option>
                <option value="3" {{ old('role_id', $user->role_id ?? '') == 3 ? 'selected' : '' }}>Employee</option>
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>