{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Members')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Member</h5>
                    <a href="{{ route('members') }}" class="btn btn-secondary btn-sm">Back to Members</a>
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
                    <form action="{{ route('members.store') }}" method="POST">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Member Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                value="{{ old('first_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_line_1" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" id="address_line_1"
                                                name="address_line_1" value="{{ old('address_line_1') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_line_2" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" id="address_line_2"
                                                name="address_line_2" value="{{ old('address_line_2') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                value="{{ old('city') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control" id="state" name="state"
                                                value="{{ old('state') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="postal_code" class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                                value="{{ old('postal_code') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card  mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Course Assignments</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div id="courses-wrapper">
                                        <div class="row g-2 course-item">
                                            <div class="col-md-5">
                                                <label class="form-label">Assign Course</label>
                                                <select class="form-control" name="courses[0][course_id]" required>
                                                    <option value="" disabled selected>Select course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">Enrollment Date</label>
                                                <input type="date" name="courses[0][enrollment_date]"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">Completion Date</label>
                                                <input type="date" name="courses[0][completion_date]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end justify-content-end">
                                                <button type="button" class="btn btn-success add-course">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card  mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Branch Assignments</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div id="branches-wrapper">
                                        <div class="row g-2 course-item">
                                            <div class="col-md-4">
                                                <label class="form-label">Assign Branch</label>
                                                <select class="form-control" name="branches[0][branch_id]" required>
                                                    <option value="" disabled selected>Select branch</option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label" for="date">Start Date</label>
                                                <input type="date" name="branches[0][start_date]" class="form-control"
                                                    required>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label" for="date">End Date</label>
                                                <input type="date" name="branches[0][end_date]" class="form-control">
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end justify-content-end">
                                                <div class="">
                                                    <label class="form-label" for="date">Is Current Branch</label>
                                                    <input type="checkbox" name="branches[0][is_current]"
                                                        class="form-check">
                                                </div>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end justify-content-end">
                                                <button type="button" class="btn btn-success add-branches">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Card Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Blue Card Section -->
                                    <div class="col-md-6">
                                        <h6>Blue Card</h6>
                                        <div class="mb-3">
                                            <label for="blue_card_available" class="form-label">Blue Card
                                                Available</label>
                                            <select class="form-control" id="blue_card_available"
                                                name="blue_card_available">
                                                <option value="" selected disabled>Select</option>
                                                <option value="yes"
                                                    {{ old('blue_card_available') == 'yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="no"
                                                    {{ old('blue_card_available') == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>

                                        <div id="blue_card_fields" style="display: none;">
                                            <div class="mb-3">
                                                <label for="blue_card_number" class="form-label">Blue Card Number</label>
                                                <input type="number" class="form-control" id="blue_card_number"
                                                    name="blue_card_number" value="{{ old('blue_card_number') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="blue_card_issue" class="form-label">Issue Date</label>
                                                <input type="date" class="form-control" id="blue_card_issue"
                                                    name="blue_card_issue" value="{{ old('blue_card_issue') }}"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="blue_card_expire" class="form-label">Expire Date</label>
                                                <input type="date" class="form-control" id="blue_card_expire"
                                                    name="blue_card_expire" value="{{ old('blue_card_expire') }}"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Yellow Card Section -->
                                    <div class="col-md-6">
                                        <h6>Yellow Card</h6>
                                        <div class="mb-3">
                                            <label for="yellow_card_available" class="form-label">Yellow Card
                                                Available</label>
                                            <select class="form-control" id="yellow_card_available"
                                                name="yellow_card_available">
                                                <option value="" selected disabled>Select</option>
                                                <option value="yes"
                                                    {{ old('yellow_card_available') == 'yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="no"
                                                    {{ old('yellow_card_available') == 'no' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </div>

                                        <div id="yellow_card_fields" style="display: none;">
                                            <div class="mb-3">
                                                <label for="yellow_card_number" class="form-label">Yellow Card
                                                    Number</label>
                                                <input type="number" class="form-control" id="yellow_card_number"
                                                    name="yellow_card_number" value="{{ old('yellow_card_number') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="yellow_card_issue" class="form-label">Issue Date</label>
                                                <input type="date" class="form-control" id="yellow_card_issue"
                                                    name="yellow_card_issue" value="{{ old('yellow_card_issue') }}"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="yellow_card_expire" class="form-label">Expire Date</label>
                                                <input type="date" class="form-control" id="yellow_card_expire"
                                                    name="yellow_card_expire" value="{{ old('yellow_card_expire') }}" 
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Create Member</button>
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
    <script>
        let courseIndex = 1;
        let branchIndex = 1;

        $(document).on('click', '.add-course', function() {
            let newCourse = `
                    <div class="row g-2 course-item mt-2">
                        <div class="col-md-5">
                            <select class="form-control" name="courses[${courseIndex}][course_id]" required>
                                <option value="" disabled selected>Select course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="courses[${courseIndex}][enrollment_date]" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="courses[${courseIndex}][completion_date]" class="form-control">
                        </div>
                        <div class="col-md-1 d-flex align-items-end justify-content-end">
                            <button type="button" class="btn btn-danger remove-course"> Remove </button>
                        </div>
                    </div>
                `;
            $('#courses-wrapper').append(newCourse);
            courseIndex++;
        });

        $(document).on('click', '.add-branches', function() {
            let newBranch = `
                    <div class="row g-2 course-item mt-2">
                        <div class="col-md-4">
                            <select class="form-control" name="branches[${branchIndex}][branch_id]" required>
                                <option value="" disabled selected>Select branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="branches[${branchIndex}][start_date]" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="branches[${branchIndex}][end_date]" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end justify-content-end">
                            <div class="">
                                <label class="form-label" for="date">Is Current Branch</label>
                                <input type="checkbox" name="branches[${branchIndex}][is_current]"
                                class="form-check" >
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end justify-content-end">
                            <button type="button" class="btn btn-danger remove-course"> Remove </button>
                        </div>
                    </div>
                `;
            $('#branches-wrapper').append(newBranch);
            branchIndex++;
        });

        $(document).on('click', '.remove-course', function() {
            $(this).closest('.course-item').remove();
        });

        $(document).on('click', '.remove-branches', function() {
            $(this).closest('.course-item').remove();
        });

        $(document).on('change', 'input[type="checkbox"]', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });

        $(document).ready(function() {
            function toggleCardFields(selectId, fieldsId) {
                if ($(selectId).val() === "yes") {
                    $(fieldsId).show();
                } else {
                    $(fieldsId).hide();
                    $(fieldsId).find("input").val(""); // clear values if hidden
                }
            }

            // Initial load
            toggleCardFields("#blue_card_available", "#blue_card_fields");
            toggleCardFields("#yellow_card_available", "#yellow_card_fields");

            // On change
            $("#blue_card_available").on("change", function() {
                toggleCardFields("#blue_card_available", "#blue_card_fields");
            });
            $("#yellow_card_available").on("change", function() {
                toggleCardFields("#yellow_card_available", "#yellow_card_fields");
            });
        });
    </script>
@endpush
