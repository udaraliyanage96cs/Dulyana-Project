<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('id', 'desc')->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = $file->store('documents', 'public');
            } else {
                return redirect()->back()->with('error', 'File upload failed.');
            }

            Document::create([
                'name' => $request->name,
                'type' => $request->type,
                'file_path' => $filePath,
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Document uploaded successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $document = Document::findOrFail($id);

            if ($request->hasFile('file')) {
                if ($document->file_path && \Storage::disk('public')->exists($document->file_path)) {
                    \Storage::disk('public')->delete($document->file_path);
                }

                $file = $request->file('file');
                $filePath = $file->store('documents', 'public');
                $document->file_path = $filePath;
            }

            $document->name = $request->name;
            $document->type = $request->type;
            $document->updated_by = auth()->user()->id;
            $document->save();

            DB::commit();

            return redirect()->back()->with('success', 'Document updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

}
