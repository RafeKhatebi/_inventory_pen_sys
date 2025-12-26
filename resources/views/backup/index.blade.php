@extends('layouts.app')

@section('title', 'Backup & Restore')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Backup & Restore</h3>
                <p class="text-muted mb-0">Manage database backups and system restore</p>
            </div>
            <div>
                <form action="{{ route('backup.create') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus me-1"></i> Create New Backup
                    </button>
                </form>
            </div>
        </div>
        <!-- Backup List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Available Backups</h5>
            </div>
            <div class="card-body">
                @if(count($backups) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Backup Name</th>
                                    <th>Date Created</th>
                                    <th>File Size</th>
                                    <th>Actions</th>
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
                                                <i class="fa fa-download"></i> Download
                                            </a>
                                            <form action="{{ route('backup.delete', $backup['name']) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this backup?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
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
                        <h5>No Backups Available</h5>
                        <p class="text-muted">Create your first backup to get started</p>
                        <form action="{{ route('backup.create') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus me-1"></i> Create First Backup
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection