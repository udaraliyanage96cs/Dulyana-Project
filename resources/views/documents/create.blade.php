{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Documents')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Documents</h5>
                    <a href="{{ route('documents') }}" class="btn btn-secondary btn-sm">Back to Documents</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Document Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="e.g., Legal, Certificate, etc."
                                value="{{ old('type') }}">
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Upload Document</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Upload Document</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('styles')
    <style>
        .list-group-item {
            border: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script></script>
@endpush
