@extends('layouts.app')
{{-- updated the file to use dynamic data --}}
@section('title', 'Customers')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Customers Management</h3>
                <p class="text-muted mb-0">Manage your customers and credit accounts</p>
            </div>
            {{-- Search from dynamic data --}}
            <div>
                <form method="GET" action="{{ route('customers.index') }}" class="d-flex">
                    <input type="search" name="search" class="form-control" placeholder="Search customers..."
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
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Credit Limit</th>
                                <th>Status</th>
                                <th>Actions</th>
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
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('customers.destroy', $customer) }}" class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $customer->id }}').submit();">
                                            <i class="fa fa-trash"></i> </a>
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