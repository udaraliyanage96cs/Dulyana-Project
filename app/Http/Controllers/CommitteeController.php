<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Committee;
use App\Models\Branch;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;


class CommitteeController extends Controller
{
    public function index()
    {
        $committees = Committee::orderBy('id', 'desc')->with('branch')->get();
        return view('committees.index', compact('committees'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('committees.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();

            Committee::create([
                'name' => $request->name,
                'description' => $request->description,
                'branch_id' => $request->branch_id,
                'status' => $request->status,
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Committee created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $branches = Branch::all();
        $committee = Committee::findOrFail($id);
        return view('committees.edit', compact('branches', 'committee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'status' => 'required|in:active,inactive',
        ]);
        try {
            DB::beginTransaction();

            $committee = Committee::findOrFail($id);
            $committee->update([
                'name' => $request->name,
                'description' => $request->description,
                'branch_id' => $request->branch_id,
                'status' => $request->status,
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Committee updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
        }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $committee = Committee::findOrFail($id);
            $committee->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Committee deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function committee_service_report()
    {
        $committees = Committee::with(['memberCommittees' => function ($query) {
            $query->with('member', 'role_get');
        }])->orderBy('name')->get();

        $pdf = Pdf::loadView('reports.committee_service_report', compact('committees'));
        return $pdf->download('committee_service_report.pdf');
    }
}
