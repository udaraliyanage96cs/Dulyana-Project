{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Events')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Update Event</h5>
                    <a href="{{ route('events') }}" class="btn btn-secondary btn-sm">Back to Events</a>
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
                    <form action="{{ route('events.update',$event->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Event Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $event->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $event->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="event_date" name="event_date"
                                value="{{ $event->event_date }}" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="event_time" class="form-label">Event Time</label>
                            <input type="time" class="form-control" id="event_time" name="event_time"
                                value="{{ $event->event_time }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="branch_id" class="form-label">Branch</label>
                            <select class="form-select" id="branch_id" name="branch_id" required>
                                <option value="" disabled selected>Select Branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" @selected($event->branch_id == $branch->id)>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="scheduled" @selected($event->status == 'scheduled')>Scheduled</option>
                                <option value="completed" @selected($event->status == 'completed')>Completed</option>
                                <option value="canceled" @selected($event->status == 'canceled')>Canceled</option>
                            </select>
                        </div>
                            
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Event</button>
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
