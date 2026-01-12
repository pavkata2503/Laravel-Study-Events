<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use App\Models\StudyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $studyMaterials = StudyMaterial::with('studyEvent')->latest()->get();
        $studyEvents = StudyEvent::orderBy('event_date', 'desc')->get();
        return view('study-materials.index', compact('studyMaterials', 'studyEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'title' => 'nullable|string|max:255',
            'study_event_id' => 'required|exists:study_events,id',
        ]);

        $file = $request->file('file');
        $path = $file->store('study-materials', 'public');

        StudyMaterial::create([
            'study_event_id' => $request->study_event_id,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'title' => $request->title,
            'file_type' => $file->getClientOriginalExtension(),
        ]);

        return back()->with('success', 'Study material uploaded successfully!');
    }

    public function destroy(StudyMaterial $studyMaterial)
    {
        Storage::disk('public')->delete($studyMaterial->path);
        $studyMaterial->delete();

        return back();
    }
}