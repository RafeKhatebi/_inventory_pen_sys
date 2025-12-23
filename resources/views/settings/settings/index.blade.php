@extends('layouts.app')

@section('title', 'General Settings')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">General Settings</h3>
                <p class="text-muted mb-0">Here you can manage your general settings.</p>
            </div>
            <div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0">Settings Overview</h5>
                <div>
                    {{-- Add a label and input to change the name of system --}}
                    <label for="systemName" class="form-label">System Name</label>
                    <input type="text" class="form-control" id="systemName" name="systemName"
                        value="{{ old('systemName', config('app.name')) }}">
                    {{-- Add a label to choose choose low stock --}}
                    <label for="lowStockThreshold" class="form-label mt-3">Low Stock Threshold</label>
                    <input type="number" class="form-control" id="lowStockThreshold" name="lowStockThreshold"
                        value="{{ old('lowStockThreshold', 10) }}">

                    {{-- Add a label and input to change the show per page --}}
                    <label for="showperpage" class="form-label mt-3">Show Per Page</label>
                    <input type="number" class="form-control" id="showperpage" name="showperpage"
                        value="{{ old('showperpage', 10) }}">
                </div>
                {{-- Add a button to save the settings --}}
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fa fa-save me-1"></i> Save Settings
                </button>
            </div>


        </div>
    </div>
@endsection