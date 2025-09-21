{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Branches')

@section('content')
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="page-title">Update Branche</h1>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Update Branch</h5>
                    <a href="{{ route('branches') }}" class="btn btn-secondary btn-sm">Back to Branches</a>
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
                    <form action="{{ route('branches.update',$branch->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{$branch->name}}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="district_id" class="form-label">District</label>
                                <select class="form-select" id="district_id" name="district_id" required disabled>
                                    <option value="" disabled selected>Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            @selected($branch->zone && $branch->zone->district_id == $district->id)>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="zone_id" class="form-label">Zone</label>
                                <select class="form-select" id="zone_id" name="zone_id" required>
                                    <option value="" disabled selected>Select Zone</option>
                                    @foreach ($zones as $zone)
                                        <option value="{{ $zone->id }}" @selected($branch->zone_id == $zone->id)>
                                            {{ $zone->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                     
                        <div class="mb-3 mt-3">
                            <label for="address_line1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" id="address_line1" name="address_line1"
                                value="{{ $branch->address_line1 }}">
                        </div>
                        <div class="mb-3">
                            <label for="address_line2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" id="address_line2" name="address_line2"
                                value="{{ $branch->address_line2 }}"> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{  $branch->city  }}">
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="{{ $branch->state  }}">
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    value="{{  $branch->postal_code  }}">
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{  $branch->email  }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $branch->phone  }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" @selected($branch->status == 'active')>Active
                                </option>
                                <option value="inactive" @selected($branch->status == 'inactive')>Inactive
                                </option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Branch</button>
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
