{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Members')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Commitee Details</h5>
                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-secondary btn-sm">Back</a>
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
                    <form method="POST" action="{{ route('members.committees_role_store', [$member->id, $branch->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="committee_id" class="form-label">Committee</label>
                                <select class="form-select" id="committee_id" name="committee_id" required>
                                    <option value="">Select Committee</option>
                                    @foreach ($committees as $committee)
                                        <option value="{{ $committee->id }}"
                                            {{ old('committee_id') == $committee->id ? 'selected' : '' }}>
                                            {{ $committee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    @foreach ($committeeRoles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2"><label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ old('start_date') }}" required>
                            </div>
                            <div class="col-md-2"><label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ old('end_date') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end justify-content-end" >
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="mt-3">
                        <table class="table">
                            <thead class="table-dark">
                                <th>Committee</th>
                                <th>Role</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Creator</th>
                                <th class="d-flex justify-content-end">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($memberCommittees as $committee)
                                    <tr>
                                        <td>{{ $committee->committee->name }}</td>
                                        <td>{{ $committee->role_get->name }}</td>
                                        <td>{{ $committee->start_date }}</td>
                                        <td>{{ $committee->end_date ?? 'Ongoing' }}</td>
                                        <td>{{ $committee->creator?->name }}</td>
                                        <td class="d-flex justify-content-end">
                                            <form action="{{ route('members.removeCommittee', $committee->id) }}" method="POST"
                                                style="display:inline-block; margin-left:5px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this role?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
@endpush
