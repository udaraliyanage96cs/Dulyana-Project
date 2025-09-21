{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Members')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Update Member</h5>
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
                    <form action="{{ route('members.update', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                                                value="{{ $member->first_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                value="{{ $member->last_name }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $member->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $member->phone }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_line_1" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" id="address_line_1"
                                                name="address_line_1" value="{{ $member->address_line1 }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_line_2" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" id="address_line_2"
                                                name="address_line_2" value="{{ $member->address_line2 }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                value="{{ $member->city }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control" id="state" name="state"
                                                value="{{ $member->state }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="postal_code" class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                                value="{{ $member->postal_code }}" required>
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
                                    <div>
                                        @foreach ($member->memberCourses as $index => $memberCourse)
                                            <div class="row g-2 course-item mb-3">
                                                <div class="col-md-5">
                                                    <label class="form-label">Assign Course</label>
                                                    <select class="form-control" name="courses[{{ $index }}][course_id]" required>
                                                        <option value="" disabled selected>Select course</option>
                                                        @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}"
                                                                @selected($course->id == $memberCourse->course_id)>{{ $course->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label" for="date">Enrollment Date</label>
                                                    <input type="date"
                                                        name="courses[{{ $index }}][enrollment_date]"
                                                        class="form-control" required
                                                        value="{{ $memberCourse->enrollment_date }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label" for="date">Completion Date</label>
                                                    <input type="date"
                                                        name="courses[{{ $index }}][completion_date]"
                                                        value="{{ $memberCourse->completion_date }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-1 d-flex align-items-end justify-content-end">
                                                    <a type="button"
                                                        href="{{ route('members.removeCourse', ['memberId' => $member->id, 'courseId' => $memberCourse->id]) }}"
                                                        class="btn btn-danger">Remove</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $nextIndex = $member->memberCourses->count() + 1;
                                @endphp
                                <div class="mb-3">
                                    <div id="courses-wrapper">
                                        <div class="row g-2 course-item">
                                            <div class="col-md-5">
                                                <label class="form-label">Assign Course</label>
                                                <select class="form-control" name="courses[{{$nextIndex}}][course_id]">
                                                    <option value="" disabled selected>Select course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">Enrollment Date</label>
                                                <input type="date" name="courses[{{$nextIndex}}][enrollment_date]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">Completion Date</label>
                                                <input type="date" name="courses[{{$nextIndex}}][completion_date]"
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
                            <button type="submit" class="btn btn-primary">Update Member</button>
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
        let courseIndex = {{ $nextIndex }};

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
