<?php

namespace App\Http\Controllers;

use App\Models\StudyEvent;
use Illuminate\Http\Request;

class StudyEventController extends Controller
{
    public function index()
    {
        $studyEvents = StudyEvent::orderBy('event_date', 'desc')->get();
        return view('study-events.index', compact('studyEvents'));
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
        return back();
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
        return back();
    }

    public function destroy(StudyEvent $studyEvent)
    {
        $studyEvent->delete();
        return back();
    }
}