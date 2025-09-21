<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Branch;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::with('branch')->orderBy('id','desc')->get();
        return view('events.index',compact('events'));
    }

    public function create()
    {
        $branches = Branch::where('status', 'active')->get();
        return view('events.create',compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'status' => 'required|in:scheduled,completed,canceled',
            'branch_id' => 'required|exists:branches,id',
        ]);

        try {
            DB::beginTransaction();

            Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'status' => $request->status,
                'branch_id' => $request->branch_id,
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Event created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $branches = Branch::where('status', 'active')->get();
        $event = Event::findOrFail($id);
        return view('events.edit', compact('branches', 'event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'status' => 'required|in:scheduled,completed,canceled',
            'branch_id' => 'required|exists:branches,id',
        ]);

        try {
            DB::beginTransaction();

            $event = Event::findOrFail($id);
            $event->update([
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'status' => $request->status,
                'branch_id' => $request->branch_id,
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Event updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $event = Event::findOrFail($id);
            $event->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Event deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
