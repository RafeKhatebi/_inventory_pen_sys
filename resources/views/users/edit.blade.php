@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">ویرایش کاربر</h3>
                <p class="text-muted mb-0">بروزرسانی اطلاعات کاربر و دسترسی‌ها</p>
            </div>
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> برگشت به کاربران
                </a>
            </div>
        </div>

        <!-- User Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">نام کامل *</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">ایمیل نام کاربری *</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">رمز عبور جدید</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="text-muted">خالی بگذارید در صورت عدم تغییر رمز عبور</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">تایید رمز عبور</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="role_id" class="form-label">نقش *</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-times me-1"></i> انصراف
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> ویرایش کاربر
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection