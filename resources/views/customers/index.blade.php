@extends('layouts.app')

@section('title', 'مشتریان')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">مدیریت مشتریان</h3>
                <p class="text-muted mb-0">مدیریت مشتریان و حسابهای اعتباری شما</p>
            </div>
            <div>
                <form method="GET" action="{{ route('customers.index') }}" class="d-flex">
                    <input type="search" name="search" class="form-control" placeholder="جستجوی مشتریان..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary ms-2">
                        <i class="fa fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary ms-1">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>مشتری</th>
                                <th>تلفن</th>
                                <th>آدرس</th>
                                <th>حد اعتبار</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>@currency($customer->credit_limit)</td>
                                    <td>
                                        <span class="badge bg-success">فعال</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('آیا مطمئن هستید که میخواهید این مشتری را حذف کنید؟')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection