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
        </div>`;

            $('#courses-wrapper').append(newCourse);
            courseIndex++;
        });

        $(document).on('click', '.remove-course', function() {
            $(this).closest('.course-item').remove();
        });
    </script>
@endpush
