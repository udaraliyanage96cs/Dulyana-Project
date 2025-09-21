<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberCourse;
use App\Models\MemberBranch;
use App\Models\Course;
use App\Models\Branch;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        $courses = Course::where('status', 'active')->get();
        $branches = Branch::where('status', 'active')->get();
        return view('members.create', compact('courses', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:members,email',
            'phone' => 'nullable|string|max:20',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'courses.*.course_id' => 'required|exists:courses,id',
            'courses.*.enrollment_date' => 'required|date',
            'courses.*.completion_date' => 'nullable|date|after_or_equal:courses.*.enrollment_date',
            'branches.*.branch_id' => 'required|exists:branches,id',
            'branches.*.start_date' => 'nullable|date',
            'branches.*.end_date' => 'nullable|date|after_or_equal:branches.*.start_date',
        ],[
            'courses.*.course_id.required' => 'The course field is required.',
            'courses.*.course_id.exists' => 'The selected course is invalid.',
            'courses.*.enrollment_date.required' => 'The enrollment date field is required.',
            'courses.*.enrollment_date.date' => 'The enrollment date must be a valid date.',
            'courses.*.completion_date.date' => 'The completion date must be a valid date.',
            'courses.*.completion_date.after_or_equal' => 'The completion date must be a date after or equal to the enrollment date.',
            'branches.*.branch_id.required' => 'The branch field is required.',
            'branches.*.branch_id.exists' => 'The selected branch is invalid.',
            'branches.*.start_date.date' => 'The start date must be a valid date.',
            'branches.*.end_date.date' => 'The end date must be a valid date.',
            'branches.*.end_date.after_or_equal' => 'The end date must be a date after or equal to the start date.',
        ]);

        try {

            DB::beginTransaction();

            $member = Member::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address_line1' => $request->address_line_1,
                'address_line2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'created_by' => auth()->user()->id
            ]);

            $member->member_id = 'MEM' . str_pad($member->id, 5, '0', STR_PAD_LEFT);
            $member->save();

            if ($request->has('courses')) {
                foreach ($request->courses as $courseData) {
                    MemberCourse::create([
                        'member_id' => $member->id,
                        'course_id' => $courseData['course_id'],
                        'enrollment_date' => $courseData['enrollment_date'],
                        'completion_date' => $courseData['completion_date'] ?? null,
                        'status' => isset($courseData['completion_date']) ? 'completed' : 'enrolled',
                        'created_by' => auth()->user()->id
                    ]);
                }
            }

            if( $request->has('branches')) {
                foreach ($request->branches as $branchData) {
                    MemberBranch::create([
                        'member_id' => $member->id,
                        'branch_id' => $branchData['branch_id'],
                        'start_date' => $branchData['start_date'] ?? null,
                        'end_date' => $branchData['end_date'] ?? null,
                        'is_current' => isset($branchData['is_current']) ? 'yes' : 'no',
                        'created_by' => auth()->user()->id
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Member created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $member = Member::with('memberCourses','memberBranches')->findOrFail($id);
        $courses = Course::where('status', 'active')->get();
        $branches = Branch::where('status', 'active')->get();
        return view('members.edit', compact('member', 'courses', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:members,email,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        try {

            DB::beginTransaction();

            $member->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address_line1' => $request->address_line_1,
                'address_line2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'updated_by' => auth()->user()->id
            ]);

            MemberCourse::where('member_id', $member->id)->delete();
            if ($request->has('courses')) {
                $request->validate([
                    'courses.*.course_id' => 'required|exists:courses,id',
                    'courses.*.enrollment_date' => 'required|date',
                    'courses.*.completion_date' => 'nullable|date|after_or_equal:courses.*.enrollment_date',
                ],[
                    'courses.*.course_id.required' => 'The course field is required.',
                    'courses.*.course_id.exists' => 'The selected course is invalid.',
                    'courses.*.enrollment_date.required' => 'The enrollment date field is required.',
                    'courses.*.enrollment_date.date' => 'The enrollment date must be a valid date.',
                    'courses.*.completion_date.date' => 'The completion date must be a valid date.',
                    'courses.*.completion_date.after_or_equal' => 'The completion date must be a date after or equal to the enrollment date.',
                ]);
                foreach ($request->courses as $courseData) {
                    if (!empty($courseData['course_id']) && !empty($courseData['enrollment_date'])) {
                        MemberCourse::create([
                            'member_id'       => $member->id,
                            'course_id'       => $courseData['course_id'],
                            'enrollment_date' => $courseData['enrollment_date'],
                            'completion_date' => $courseData['completion_date'] ?? null,
                            'status'          => !empty($courseData['completion_date']) ? 'completed' : 'enrolled',
                            'created_by'      => auth()->id(),
                        ]);
                    }
                }
            }

            MemberBranch::where('member_id', $member->id)->delete();
            if( $request->has('branches')) {
                $request->validate([
                    'branches.*.branch_id' => 'required|exists:branches,id',
                    'branches.*.start_date' => 'nullable|date',
                    'branches.*.end_date' => 'nullable|date|after_or_equal:branches.*.start_date',
                ],[
                    'branches.*.branch_id.required' => 'The branch field is required.',
                    'branches.*.branch_id.exists' => 'The selected branch is invalid.',
                    'branches.*.start_date.date' => 'The start date must be a valid date.',
                    'branches.*.end_date.date' => 'The end date must be a valid date.',
                    'branches.*.end_date.after_or_equal' => 'The end date must be a date after or equal to the start date.',
                ]);
                foreach ($request->branches as $branchData) {
                    if (!empty($branchData['branch_id'])) {
                        MemberBranch::create([
                            'member_id' => $member->id,
                            'branch_id' => $branchData['branch_id'],
                            'start_date' => $branchData['start_date'] ?? null,
                            'end_date' => $branchData['end_date'] ?? null,  
                            'is_current' => isset($branchData['is_current']) ? 'yes' : 'no',
                            'created_by' => auth()->user()->id
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Member updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
        
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        try {
            DB::beginTransaction();
            MemberCourse::where('member_id', $member->id)->delete();
            $member->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Member deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function removeCourse($memberId, $courseId)
    {
        $member = Member::findOrFail($memberId);
        $memberCourse = MemberCourse::where('member_id', $member->id) ->where('id', $courseId)->firstOrFail();
        try {
            $memberCourse->delete();
            return redirect()->back()->with('success', 'Course removed from member successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $member = Member::with('memberCourses.course','memberBranches.branch')->findOrFail($id);
        return view('members.show', compact('member'));
    }

    public function removeBranch($memberId, $branchId)
    {
        $member = Member::findOrFail($memberId);
        $memberBranch = MemberBranch::where('member_id', $member->id) ->where('id', $branchId)->firstOrFail();
        try {
            $memberBranch->delete();
            return redirect()->back()->with('success', 'Branch removed from member successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    
}