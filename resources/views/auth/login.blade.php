@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <!-- Brand Header -->
                <div class="text-center ">
                    <h1 class="text-primary fw-bold mb-3">
                        <i class="fa fa-boxes me-2"></i>مدیریت موجودی
                    </h1>
                </div>
                <!-- Login Card -->
                <div class="bg-white rounded shadow-lg border-0 overflow-hidden">
                    <div class="p-4 p-sm-5">
                        <!-- Card Header -->
                        <div class="text-center mb-4">
                            <h3 class="text-dark mb-2">خوش آمدید</h3>
                            <p class="text-muted small">لطفاً اطلاعات خود را وارد کنید</p>
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-exclamation-circle me-2"></i>
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <div class="small">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-check-circle me-2"></i>
                                    <div class="small">{{ session('success') }}</div>
                                </div>
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate>
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-dark fw-medium mb-2">
                                    <i class="fa fa-envelope text-primary me-2"></i>نام کاربری یا ایمیل
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fa fa-user text-muted"></i>
                                    </span>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                                        name="email" placeholder="name@example.com" value="{{ old('email') }}" required
                                        autofocus>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="password" class="form-label text-dark fw-medium">
                                        <i class="fa fa-lock text-primary me-2"></i>رمز عبور
                                    </label>
                                </div>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fa fa-key text-muted"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter your password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label text-muted" for="remember">
                                        مرا در این دستگاه به خاطر بسپار
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                                    <i class="fa fa-sign-in-alt me-2"></i>ورود
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection