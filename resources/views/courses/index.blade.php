{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Courses')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Committee List</h5>
                    <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">Add New Course</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Description</th>
                                <th>Provider</th>
                                <th>Duration (Hours)</th>
                                <th>Color Code</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th style="display: flex;justify-content:end;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td>{{ $course->provider }}</td>
                                    <td>{{ $course->duration_hours }}</td>
                                    <td>{{ ucfirst($course->color_code ?? "N/A")  }}</td>
                                    <td>{{ ucfirst($course->status) }}</td>
                                    <td>{{ $course->creator?->name }}</td>
                                    <td>{{ $course->updator?->name ?? "N/A" }}</td>
                                    <td style="display: flex;justify-content:end">
                                        <a href="{{ route('courses.edit', $course->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                            style="display:inline-block; margin-left:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($courses->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">No data found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">

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
