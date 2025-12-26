@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">مشخصات کاربر</h3>
                <p class="text-muted mb-0">دیدن جزییات و عملکرد کاربر</p>
            </div>
            <div>
                <a href="{{ route('users.edit', 1) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit me-1"></i> ویرایش کاربر
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> برگشت به کاربران
                </a>
            </div>
        </div>

        <div class="row">
            <!-- User Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-user me-2"></i>اطلاعات کاربر</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=random"
                                class="rounded-circle mb-2" width="80" alt="User Avatar">
                            <h5>{{ $user->name}}</h5>
                            <p class="text-muted">آی دی کاربر: {{ $user->id}}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">ایمیل</label>
                            <p class="fw-bold">{{ $user->email}}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">نقش</label>
                            <span class="badge bg-primary">{{ $user->role?->name ?? 'No Role' }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">وضعیت</label>
                            <span class="badge bg-success">فعال</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">آخرین ورود</label>
                            <p class="fw-bold">{{ date('M d, Y H:i') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">تاریخ عضویت</label>
                            <p class="fw-bold">{{ date('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection