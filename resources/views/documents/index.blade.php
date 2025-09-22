{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Documents')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Document List</h5>
                    <a href="{{ route('documents.create') }}" class="btn btn-primary btn-sm">Add New Document</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Document Name</th>
                                <th>Type</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th style="display: flex;justify-content:end;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->id }}</td>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $document->type ?? "N/A" }}</td>
                                    <td>{{ $document->creator?->name }}</td>
                                    <td>{{ $document->updator?->name ?? "N/A" }}</td>
                                    <td style="display: flex;justify-content:end">
                                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-sm btn-info me-2">View</a>
                                        <a href="{{ route('documents.edit', $document->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST"
                                            style="display:inline-block; margin-left:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this document?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($documents->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
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
