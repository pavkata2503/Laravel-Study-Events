<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📎 Study Materials
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('study-materials.store') }}" enctype="multipart/form-data" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Select Study Event</label>
                        <select name="study_event_id" required class="w-full border rounded p-2 mb-2">
                            <option value="">Choose an event...</option>
                            @foreach($studyEvents as $event)
                                <option value="{{ $event->id }}">{{ $event->title }} - {{ $event->subject }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="title" placeholder="Material title (optional)" class="w-full border rounded p-2 mb-2">
                    <input type="file" name="file" class="w-full border rounded p-2 mb-2">
                    <button type="submit" style="background-color: #3b82f6; color: white; padding: 0.5rem 1.5rem; border-radius: 0.25rem; width: 100%; font-weight: bold;">Upload Material</button>
                </form>

                <div class="space-y-4">
                    @foreach ($studyMaterials as $material)
                        <div class="border rounded p-4 bg-gray-50 flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold">{{ $material->title ?? $material->original_name }}</h3>
                                <p class="text-sm text-gray-600">📚 Event: {{ $material->studyEvent->title }}</p>
                                <p class="text-sm text-gray-500">📄 Type: {{ strtoupper($material->file_type) }}</p>
                                <a href="{{ asset('storage/' . $material->path) }}" target="_blank" 
                                   class="text-blue-500 text-sm hover:underline">Download</a>
                            </div>

                            <form method="POST" action="{{ route('study-materials.destroy', $material) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    ✖
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>