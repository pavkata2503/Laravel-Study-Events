<?php

namespace App\Http\Controllers;

use App\Models\StudyEvent;
use Illuminate\Http\Request;

class StudyEventAdminController extends Controller
{
    public function index()
    {
        $studyEvents = StudyEvent::orderBy('event_date', 'desc')->get();
        return view('admin.study-events.index', compact('studyEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        StudyEvent::create($request->all());

        return back()->with('success', 'Study event created successfully');
    }

    public function edit(StudyEvent $studyEvent)
    {
        return view('admin.study-events.edit', compact('studyEvent'));
    }

    public function update(Request $request, StudyEvent $studyEvent)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $studyEvent->update($request->all());

        return redirect()->route('admin.study-events.index')->with('success', 'Study event updated');
    }

    public function destroy(StudyEvent $studyEvent)
    {
        $studyEvent->delete();

        return back()->with('success', 'Study event deleted');
    }
}