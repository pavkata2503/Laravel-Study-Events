<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            📚 Admin – Study Events Manager
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.study-events.store') }}" class="mb-6 bg-white p-4 rounded shadow">
            @csrf
            <h3 class="font-bold mb-3">Add New Study Event</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <input type="text" name="title" placeholder="Event title" required class="border p-2 rounded">
                <input type="text" name="subject" placeholder="Subject" required class="border p-2 rounded">
                <input type="datetime-local" name="event_date" required class="border p-2 rounded">
                <input type="text" name="location" placeholder="Location (optional)" class="border p-2 rounded">
            </div>
            <textarea name="description" placeholder="Description (optional)" rows="3" class="w-full border p-2 rounded mt-3"></textarea>
            <button class="bg-blue-500 text-white px-4 py-2 rounded mt-3">Create Event</button>
        </form>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Subject</th>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-left">Location</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studyEvents as $event)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $event->title }}</td>
                            <td class="p-3">{{ $event->subject }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y H:i') }}</td>
                            <td class="p-3">{{ $event->location ?? 'N/A' }}</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.study-events.edit', $event) }}" class="text-blue-600 hover:underline">Edit</a>

                                    <form method="POST" action="{{ route('admin.study-events.destroy', $event) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>