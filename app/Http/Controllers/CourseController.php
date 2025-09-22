<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Member;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'provider' => 'required|string|unique:courses,provider',
            'duration_hours' => 'nullable|string',
            'color_code' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();

            Course::create([
                'name' => $request->name,
                'description' => $request->description,
                'provider' => $request->provider,
                'duration_hours' => $request->duration_hours,
                'color_code' => $request->color_code,
                'status' => $request->status,
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Course created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'provider' => 'required|string|unique:courses,provider,'.$id,
            'duration_hours' => 'nullable|string',
            'color_code' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();

            $course = Course::findOrFail($id);
            $course->update([
                'name' => $request->name,
                'description' => $request->description,
                'provider' => $request->provider,
                'duration_hours' => $request->duration_hours,
                'color_code' => $request->color_code,
                'status' => $request->status,
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Course updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $course = Course::findOrFail($id);
            $course->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function education_report()
    {
        $members = Member::with(['memberCourses.course'])->orderBy('first_name')->orderBy('last_name')->get();
        $pdf = Pdf::loadView('reports.training_education_report', compact('members'));
        return $pdf->download('training_education_report.pdf');
    }

}
