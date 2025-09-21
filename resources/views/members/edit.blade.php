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
                                                    <select class="form-control"
                                                        name="courses[{{ $index }}][course_id]" required>
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
                                    $nextIndexCourses = $member->memberCourses->count() + 1;
                                @endphp
                                <div class="mb-3">
                                    <div id="courses-wrapper">
                                        <div class="row g-2 course-item">
                                            <div class="col-md-5">
                                                <label class="form-label">Assign Course</label>
                                                <select class="form-control"
                                                    name="courses[{{ $nextIndexCourses }}][course_id]">
                                                    <option value="" disabled selected>Select course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">Enrollment Date</label>
                                                <input type="date"
                                                    name="courses[{{ $nextIndexCourses }}][enrollment_date]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">Completion Date</label>
                                                <input type="date"
                                                    name="courses[{{ $nextIndexCourses }}][completion_date]"
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

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Branch Assignments</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div>
                                        @foreach ($member->memberBranches as $index => $memberBranch)
                                            <div class="row g-2 course-item mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Assign Branch</label>
                                                    <select class="form-control"
                                                        name="branches[{{ $index }}][branch_id]" required>
                                                        <option value="" disabled selected>Select branch</option>
                                                        @foreach ($branches as $branch)
                                                            <option value="{{ $branch->id }}"
                                                                @selected($branch->id == $memberBranch->branch_id)>{{ $branch->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label" for="date">Start Date</label>
                                                    <input type="date"
                                                        name="branches[{{ $index }}][start_date]"
                                                        class="form-control" value="{{ $memberBranch->start_date }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label" for="date">End Date</label>
                                                    <input type="date" name="branches[{{ $index }}][end_date]"
                                                        value="{{ $memberBranch->end_date }}" class="form-control">
                                                </div>

                                                <div class="col-md-1 d-flex align-items-end justify-content-end">
                                                    <div class="form-check">
                                                        <input class="form-check" type="checkbox" value="yes"
                                                            name="branches[{{ $index }}][is_current]"
                                                            id="is_current_{{ $index }}"
                                                            @if ($memberBranch->is_current === 'yes') checked @endif>
                                                        <label class="form-checklabel"
                                                            for="is_current_{{ $index }}">
                                                            Current
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 d-flex align-items-end justify-content-end">
                                                    <a type="button"
                                                        href="{{ route('members.removeBranch', ['memberId' => $member->id, 'branchId' => $memberBranch->id]) }}"
                                                        class="btn btn-danger">Remove</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $nextIndexBranches = $member->memberBranches->count() + 1;
                                @endphp
                                <div class="mb-3">
                                    <div id="branches-wrapper">
                                        <div class="row g-2 course-item">
                                            <div class="col-md-4">
                                                <label class="form-label">Assign Branch</label>
                                                <select class="form-control"
                                                    name="branches[{{ $nextIndexBranches }}][branch_id]">
                                                    <option value="" disabled selected>Select branch</option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">Start Date</label>
                                                <input type="date"
                                                    name="branches[{{ $nextIndexBranches }}][start_date]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="date">End Date</label>
                                                <input type="date" name="branches[{{ $nextIndexBranches }}][end_date]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end justify-content-end">
                                                <div class="form-check">
                                                    <input class="form-check" type="checkbox" value="yes"
                                                        name="branches[{{ $nextIndexBranches }}][is_current]"
                                                        id="is_current_{{ $nextIndexBranches }}">
                                                    <label class="form-checklabel"
                                                        for="is_current_{{ $nextIndexBranches }}">
                                                        Current
                                                    </label>
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
        let courseIndex = {{ $nextIndexCourses }};

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


        let branchIndex = {{ $nextIndexBranches }};
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
                        <div class="col-md-3">
                            <input type="date" name="branches[${branchIndex}][start_date]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="branches[${branchIndex}][end_date]" class="form-control">
                        </div>
                        <div class="col-md-1 d-flex align-items-end justify-content-end">
                            <div class="form-check">
                                <input class="form-check" type="checkbox" value="yes" name="branches[${branchIndex}][is_current]" id="is_current_${branchIndex}">
                                <label class="form-checklabel" for="is_current_${branchIndex}">
                                    Current
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end justify-content-end">
                            <button type="button" class="btn btn-danger remove-branch"> Remove </button>
                        </div>
                    </div>
            `;
            $('#branches-wrapper').append(newBranch);
            branchIndex++;
        });

        $(document).on('click', '.remove-course', function() {
            $(this).closest('.course-item').remove();
        });

        $(document).on('click', '.remove-branch', function() {
            $(this).closest('.course-item').remove();
        });

        $(document).on('change', 'input[type="checkbox"]', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });
    </script>
@endpush
