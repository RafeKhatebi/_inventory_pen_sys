@extends('layouts.app')

@section('title', 'پشتیبان گیری و بازیابی')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">پشتیبان گیری و بازیابی</h3>
                <p class="text-muted mb-0">مدیریت پشتیبان پایگاه داده و بازیابی سیستم</p>
            </div>
            <div>
                <form action="{{ route('backup.create') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus me-1"></i> ایجاد پشتیبان جدید
                    </button>
                </form>
            </div>
        </div>
        <!-- Backup List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">پشتیبانهای موجود</h5>
            </div>
            <div class="card-body">
                @if(count($backups) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>نام پشتیبان</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>اندازه فایل</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($backups as $backup)
                                    <tr>
                                        <td>
                                            <i class="fa fa-database me-2 text-primary"></i>
                                            {{ $backup['name'] }}
                                        </td>
                                        <td>{{ $backup['date'] }}</td>
                                        <td>{{ $backup['size'] }}</td>
                                        <td>
                                            <a href="{{ route('backup.download', $backup['name']) }}"
                                                class="btn btn-sm btn-success me-1">
                                                <i class="fa fa-download"></i> دانلود
                                            </a>
                                            <form action="{{ route('backup.delete', $backup['name']) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('آیا مطمئن هستید که میخواهید این پشتیبان را حذف کنید؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> حذف
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa fa-database fa-3x text-muted mb-3"></i>
                        <h5>هیچ پشتیبانی موجود نیست</h5>
                        <p class="text-muted">اولین پشتیبان خود را برای شروع ایجاد کنید</p>
                        <form action="{{ route('backup.create') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus me-1"></i> ایجاد اولین پشتیبان
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection