<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Zone;
use App\Models\District;

class BranchController extends Controller
{
    public function index()
    {

        $branches = Branch::with(['zone.district'])->orderBy('id','desc')->get();
        return view('branches.index',compact('branches'));
    }

    public function create()
    {
        $districts = District::all();
        $zones = Zone::all();
        return view('branches.create',compact('districts','zones'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'zone_id' => 'required|exists:zones,id',
            'status' => 'required|in:active,inactive',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();


            Branch::create([
                'name' => $request->name,
                'zone_id' => $request->zone_id,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'created_by' => auth()->user()->id,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Branch created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        $districts = District::all();
        $zones = Zone::all();
        return view('branches.edit', compact('branch', 'districts', 'zones'));
    }

    public function update(Request $request, $id)
    {
       DB::beginTransaction();
       
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'zone_id' => 'required|exists:zones,id',
                'status' => 'required|in:active,inactive',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address_line1' => 'nullable|string|max:255',
                'address_line2' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
            ]);

            $branch = Branch::findOrFail($id);
            $branch->update([
                'name' => $request->name,
                'zone_id' => $request->zone_id,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

            return redirect()->route('branches')->with('success', 'Branch updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
       try {
            DB::beginTransaction();
            $branch = Branch::findOrFail($id);
            $branch->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Branch deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
