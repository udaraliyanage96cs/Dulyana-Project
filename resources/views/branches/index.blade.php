{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Branches')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Branches List</h5>
                    <a href="{{ route('branches.create') }}" class="btn btn-primary btn-sm">Add New Branch</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>District</th>
                                <th>Zone</th>
                                <th>Status</th>
                                <th style="display: flex;justify-content:end;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $branch)
                                <tr>
                                    <td>{{ $branch->id }}</td>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->zone?->district?->name }}</td>
                                    <td>{{ $branch->zone?->name }}</td>
                                    <td>{{ ucfirst($branch->status) }}</td>
                                    <td style="display: flex;justify-content:end">
                                        <a href="{{ route('branches.edit', $branch->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('branches.destroy', $branch->id) }}" method="POST"
                                            style="display:inline-block; margin-left:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this branch?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($branches->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No data found</td>
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
