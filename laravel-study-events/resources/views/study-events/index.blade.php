<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📚 Study Events
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('study-events.store') }}" class="mb-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input name="title" placeholder="Event title..." required
                               class="border rounded px-3 py-2 focus:outline-none" />
                        <input name="subject" placeholder="Subject..." required
                               class="border rounded px-3 py-2 focus:outline-none" />
                        <input name="event_date" type="datetime-local" required
                               class="border rounded px-3 py-2 focus:outline-none" />
                        <input name="location" placeholder="Location (optional)"
                               class="border rounded px-3 py-2 focus:outline-none" />
                    </div>
                    <textarea name="description" placeholder="Description (optional)" rows="3"
                              class="w-full border rounded px-3 py-2 focus:outline-none mb-4"></textarea>
                    <button type="submit" style="background-color: #3b82f6; color: white; padding: 0.5rem 1.5rem; border-radius: 0.25rem; width: 100%; font-weight: bold;">Add Event</button>
                </form>

                <div class="space-y-4">
                    @foreach($studyEvents as $event)
                        <div class="border rounded p-4 bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-600">📖 {{ $event->subject }}</p>
                                    <p class="text-sm text-gray-600">📅 {{ $event->event_date }}</p>
                                    @if($event->location)
                                        <p class="text-sm text-gray-600">📍 {{ $event->location }}</p>
                                    @endif
                                    @if($event->description)
                                        <p class="text-sm mt-2">{{ $event->description }}</p>
                                    @endif
                                </div>

                                <form method="POST" action="{{ route('study-events.destroy', $event) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">✖</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>