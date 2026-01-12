<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            ✏️ Edit Study Event
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6">

        <div class="bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('admin.study-events.update', $studyEvent) }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Title</label>
                    <input type="text" name="title" value="{{ $studyEvent->title }}" required class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Subject</label>
                    <input type="text" name="subject" value="{{ $studyEvent->subject }}" required class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Event Date & Time</label>
                    <input type="datetime-local" name="event_date" value="{{ \Carbon\Carbon::parse($studyEvent->event_date)->format('Y-m-d\TH:i') }}" required class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Location</label>
                    <input type="text" name="location" value="{{ $studyEvent->location }}" class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Description</label>
                    <textarea name="description" rows="4" class="border p-2 w-full rounded">{{ $studyEvent->description }}</textarea>
                </div>

                <div class="flex gap-2">
                    <button class="bg-green-600 text-white px-4 py-2 rounded">Save Changes</button>
                    <a href="{{ route('admin.study-events.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>