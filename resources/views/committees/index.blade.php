{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Committees')

@section('content')
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="page-title">All Committees</h1>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Committee List</h5>
                    <a href="{{ route('committees.create') }}" class="btn btn-primary btn-sm">Add New Committee</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Committee Name</th>
                                <th>Branch</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th style="display: flex;justify-content:end;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($committees as $committee)
                                <tr>
                                    <td>{{ $committee->id }}</td>
                                    <td>{{ $committee->name }}</td>
                                    <td>{{ $committee->branch?->name }}</td>
                                    <td>{{ $committee->description }}</td>
                                    <td>{{ ucfirst($committee->status) }}</td>
                                    <td>{{ $committee->creator?->name }}</td>
                                    <td>{{ $committee->updator?->name ?? "N/A" }}</td>
                                    <td style="display: flex;justify-content:end">
                                        <a href="{{ route('committees.edit', $committee->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('committees.destroy', $committee->id) }}" method="POST"
                                            style="display:inline-block; margin-left:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this committee?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($committees->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">No data found</td>
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
