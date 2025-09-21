{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Courses')

@section('content')
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="page-title">Update Course</h1>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Update Course</h5>
                    <a href="{{ route('courses') }}" class="btn btn-secondary btn-sm">Back to Course</a>
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
                    <form action="{{ route('courses.update',$course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $course->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $course->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="provider" class="form-label">Provider</label>
                            <input type="text" class="form-control" id="provider" name="provider"
                                value="{{$course->provider}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="duration_hours" class="form-label">Duration (Hours)</label>
                            <input type="number" class="form-control" id="duration_hours" name="duration_hours"
                                value="{{ $course->duration_hours }}" required>       
                        </div>
                        <div class="mb-3">
                            <label for="color_code" class="form-label">Color Code</label>
                            <input type="text" class="form-control" id="color_code" name="color_code"
                                value="{{ $course->color_code }}">    
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" @selected($course->status == 'active')>Active</option>
                                <option value="inactive" @selected($course->status == 'inactive')>Inactive</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Course</button>
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
