{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Events')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Events List</h5>
                    <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm">Add New Event</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Event Title</th>
                                <th>Description</th>
                                <th>Event Date</th>
                                <th>Event Time</th>
                                <th>Status</th>
                                <th>Branch</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th style="display: flex;justify-content:end;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ $event->event_date }}</td>
                                    <td>{{ $event->event_time ?? "N/A" }}</td>
                                    <td>{{ ucfirst($event->status) }}</td>
                                    <td>{{ $event->branch?->name }}</td>
                                    <td>{{ $event->creator?->name }}</td>
                                    <td>{{ $event->updator?->name ?? "N/A" }}</td>
                                    <td style="display: flex;justify-content:end">
                                        <a href="{{ route('events.edit', $event->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                            style="display:inline-block; margin-left:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($events->isEmpty())
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
