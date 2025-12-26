@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">ویرایش مشتری</h3>
                <p class="text-muted mb-0">به‌روزرسانی اطلاعات مشتری</p>
            </div>
            <div>
                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> بازگشت به مشتریان
                </a>
            </div>
        </div>

        <!-- Customer Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customers.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @include('customers.partials.form')

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-times me-1"></i> انصراف
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> به‌روزرسانی مشتری
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection