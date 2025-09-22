{{-- resources/views/members/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Members')

@section('content')
    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-funnel me-2"></i>Filters
                        <button class="btn btn-sm btn-outline-secondary float-end" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </h6>
                </div>
                <div class="collapse" id="filterCollapse">
                    <div class="card-body">
                        <form method="GET" action="{{ route('members') }}" id="filterForm">
                            <div class="row g-3">
                                <!-- Search -->
                                <div class="col-md-3">
                                    <label for="search" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" 
                                           value="{{ request('search') }}" 
                                           placeholder="Name, email, phone, member ID...">
                                </div>

                                <!-- City Filter -->
                                <div class="col-md-1">
                                    <label for="city" class="form-label">City</label>
                                    <select class="form-select" id="city" name="city">
                                        <option value="">All Cities</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- State Filter -->
                                <div class="col-md-1">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" name="state">
                                        <option value="">All States</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>
                                                {{ $state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Created By Filter -->
                                <div class="col-md-2">
                                    <label for="created_by" class="form-label">Created By</label>
                                    <select class="form-select" id="created_by" name="created_by">
                                        <option value="">All Users</option>
                                        @foreach($creators as $creator)
                                            <option value="{{ $creator->id }}" {{ request('created_by') == $creator->id ? 'selected' : '' }}>
                                                {{ $creator->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Date From -->
                                <div class="col-md-2">
                                    <label for="date_from" class="form-label">From Date</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from" 
                                           value="{{ request('date_from') }}">
                                </div>

                                <!-- Date To -->
                                <div class="col-md-2">
                                    <label for="date_to" class="form-label">To Date</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to" 
                                           value="{{ request('date_to') }}">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm me-2">
                                        <i class="bi bi-search me-1"></i>Apply Filters
                                    </button>
                                    <a href="{{ route('members') }}" class="btn btn-outline-secondary btn-sm me-2">
                                        <i class="bi bi-x-circle me-1"></i>Clear All
                                    </a>
                                    <span class="text-muted small">
                                        Showing {{ $members->count() }} result(s)
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Members List -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Members List</h5>
                    <div>
                        <!-- Sort Options -->
                        <div class="dropdown d-inline-block me-2">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-sort-down me-1"></i>Sort
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'sort_order' => 'desc']) }}">Latest First</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'sort_order' => 'asc']) }}">Oldest First</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_name', 'sort_order' => 'asc']) }}">Name A-Z</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_name', 'sort_order' => 'desc']) }}">Name Z-A</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'email', 'sort_order' => 'asc']) }}">Email A-Z</a></li>
                            </ul>
                        </div>
                        <a href="{{ route('members.create') }}" class="btn btn-primary btn-sm">Add New Member</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>
                                        Member ID
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Creator</th>
                                    <th>Updator</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($members as $member)
                                    <tr>
                                        <td>{{ $member->id }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $member->member_id }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $member->first_name }} {{ $member->last_name }}</strong>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $member->email }}" class="text-decoration-none">
                                                {{ $member->email }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($member->phone)
                                                <a href="tel:{{ $member->phone }}" class="text-decoration-none">
                                                    {{ $member->phone }}
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>
                                                {{ $member->address_line1 ?? '' }}
                                                {{ $member->address_line2 ? ', ' . $member->address_line2 : '' }}
                                                @if($member->city || $member->state)
                                                    <br>
                                                    {{ $member->city ? $member->city : '' }}
                                                    {{ $member->state ? ', ' . $member->state : '' }}
                                                    {{ $member->postal_code ? ' ' . $member->postal_code : '' }}
                                                @endif
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                {{ $member->creator?->name ?? 'N/A' }}
                                            </small>
                                        </td>
                                        <td>
                                            <small>{{ $member->updator?->name ?? 'N/A' }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('members.show', $member->id) }}" 
                                                   class="btn btn-info btn-sm" title="View" style="margin-right: 5px">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('members.edit', $member->id) }}" 
                                                   class="btn btn-warning btn-sm" title="Edit" style="margin-right: 5px">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" 
                                                      style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this member?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1"></i>
                                                <p class="mt-2">No members found</p>
                                                @if(request()->hasAny(['search', 'city', 'state', 'created_by', 'date_from', 'date_to']))
                                                    <small>Try adjusting your filters</small>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
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
        
        .table th a:hover {
            color: #e9ecef !important;
        }
        
        .btn-group .btn {
            border-radius: 0;
        }
        
        .btn-group .btn:first-child {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        
        .btn-group .btn:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }

        .table-responsive {
            border-radius: 0.375rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form on filter change (optional)
            const filterInputs = document.querySelectorAll('#filterForm select, #filterForm input[type="date"]');
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Uncomment the line below if you want auto-submit on filter change
                    // document.getElementById('filterForm').submit();
                });
            });

            // Show filter section if any filters are active
            const hasActiveFilters = {{ request()->hasAny(['search', 'city', 'state', 'created_by', 'date_from', 'date_to']) ? 'true' : 'false' }};
            if (hasActiveFilters) {
                document.getElementById('filterCollapse').classList.add('show');
            }
        });
    </script>
@endpush