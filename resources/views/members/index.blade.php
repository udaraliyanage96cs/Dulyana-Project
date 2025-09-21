{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Members')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Members List</h5>
                    <a href="{{ route('members.create') }}" class="btn btn-primary btn-sm">Add New Member</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Member ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th style="display: flex;justify-content:end;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->member_id }}</td>
                                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->phone ?? 'N/A' }}</td>
                                    <td>
                                        {{ $member->address_line1 ?? '' }}
                                        {{ $member->address_line2 ? ', ' . $member->address_line2 : '' }}
                                        <br/>
                                        {{ $member->city ? ' ' . $member->city : '' }}
                                        {{ $member->state ? ', ' . $member->state : '' }}<br/>
                                        {{ $member->postal_code ? ' ' . $member->postal_code : '' }}
                                    </td>
                                    <td>{{ $member->creator?->name }}</td>
                                    <td>{{ $member->updator?->name ?? 'N/A' }}</td>
                                    <td style="display: flex;justify-content:end">
                                        <a href="{{ route('members.show', $member->id) }}"
                                            class="btn  btn-info"><i class="bi bi-eye"></i>
                                        <a href="{{ route('members.edit', $member->id) }}"
                                            class="btn  btn-warning" style="margin-left:5px;"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                            style="display:inline-block; margin-left:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this member?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        
                                       
                                    </td>
                                </tr>
                            @endforeach
                            @if ($members->isEmpty())
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
