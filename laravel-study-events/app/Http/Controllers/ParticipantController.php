<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('role', 'like', '%' . $request->search . '%');
            });
        }

        $allowedSorts = ['name', 'role', 'email'];
        if ($request->filled('sort') && in_array($request->sort, $allowedSorts)) {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort, $direction);
        }

        $participants = $query->paginate(10)->withQueryString();
        return view('admin.participants.index', compact('participants'));
    }

    public function create()
    {
        return view('admin.participants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:student,teacher,tutor,moderator,guest',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        Participant::create($data);

        return redirect()->route('admin.participants.index')
            ->with('success', 'Participant created');
    }

    public function edit(Participant $participant)
    {
        return view('admin.participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:student,teacher,tutor,moderator,guest',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            if ($participant->profile_photo) {
                \Storage::disk('public')->delete($participant->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        $participant->update($data);

        return redirect()->route('admin.participants.index')
            ->with('success', 'Participant updated');
    }

    public function destroy(Participant $participant)
    {
        if ($participant->profile_photo) {
            \Storage::disk('public')->delete($participant->profile_photo);
        }
        
        $participant->delete();

        return redirect()->route('admin.participants.index')
            ->with('success', 'Participant deleted');
    }
}