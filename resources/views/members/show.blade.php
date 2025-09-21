{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Members')

@section('content')
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Member Details</h5>
                    <a href="{{ route('members') }}" class="btn btn-secondary btn-sm">Back to Members List</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Member ID:</strong> {{ $member->member_id }}</li>
                        <li class="list-group-item"><strong>Name:</strong> {{ $member->first_name }} {{ $member->last_name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $member->email }}</li>
                        <li class="list-group-item"><strong>Phone:</strong> {{ $member->phone ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Address:</strong>
                            {{ $member->address_line1 ?? '' }}
                            {{ $member->address_line2 ? ', ' . $member->address_line2 : '' }}
                            <br/>
                            {{ $member->city ? ' ' . $member->city : '' }}
                            {{ $member->state ? ', ' . $member->state : '' }}<br/>
                            {{ $member->postal_code ? ' ' . $member->postal_code : '' }}
                        </li>
                       
                        <li class="list-group-item"><strong>Assigned Courses:</strong>
                            @if($member->memberCourses->isEmpty())
                                <p>No courses assigned.</p>
                            @else
                                <ul>
                                    @foreach($member->memberCourses as $memberCourse)
                                        <li class="mb-3">
                                            <div class="">
                                                {{ $memberCourse->course->name }} (Enrolled on: {{ $memberCourse->created_at->format('Y-m-d') }}) -
                                                {{ $memberCourse->completion_date ? 'Completed on ' . \Carbon\Carbon::parse($memberCourse->completion_date)->format('M d, Y') : 'Not Completed Yet' }}
                                            </div>
                                            @if($memberCourse->status == 'completed')
                                                <div class="">
                                                    Card Number: {{ $memberCourse->card_number ?? 'N/A' }} <br/>
                                                    Issue Date: {{ $memberCourse->issue_date ? \Carbon\Carbon::parse($memberCourse->issue_date)->format('M d, Y') : 'N/A' }} <br/>
                                                    Expiry Date: {{ $memberCourse->expiry_date ? \Carbon\Carbon::parse($memberCourse->expiry_date)->format('M d, Y') : 'N/A' }} <br/>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>

                        <li class="list-group-item"><strong>Assigned Branches:</strong>
                            @if($member->memberBranches->isEmpty())
                                <p>No branches assigned.</p>
                            @else
                                <ul>
                                    @foreach($member->memberBranches as $memberBranch)
                                        <li>
                                            {{ $memberBranch->branch->name }} 
                                            (From: {{ $memberBranch->start_date ? \Carbon\Carbon::parse($memberBranch->start_date)->format('M d, Y') : 'N/A' }} 
                                            To: {{ $memberBranch->end_date ? \Carbon\Carbon::parse($memberBranch->end_date)->format('M d, Y') : 'N/A' }}) 
                                            <strong>{{ $memberBranch->is_current === 'yes' ? 'Current' : '' }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Created By:</strong> {{ $member->creator?->name }}</li>
                        <li class="list-group-item"><strong>Updated By:</strong> {{ $member->updator?->name ?? 'N/A' }}</li>
                    </ul>

                    <div class="mt-4 text-end">
                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-primary">Edit Member</a>
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
    <script>
       
    </script>
@endpush
