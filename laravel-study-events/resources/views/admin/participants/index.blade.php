<x-app-layout>
    <x-slot name="header">
        👥 Participants
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.participants.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
           ➕ Add Participant
        </a>

        <form method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Search by name, email, or role..."
                   value="{{ request('search') }}"
                   class="border p-2 rounded w-64">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Search
            </button>
        </form>

        @php
            $direction = request('direction') === 'asc' ? 'desc' : 'asc';
        @endphp

        <table class="w-full border mb-4 bg-white">
            <tr class="bg-gray-200">
                <th class="p-2 border">Photo</th>
                <th class="p-2 border">
                    <a href="?sort=name&direction={{ $direction }}">
                        Name
                        @if(request('sort')==='name')
                            {{ request('direction')==='asc'?'▲':'▼' }}
                        @endif
                    </a>
                </th>
                <th class="p-2 border">
                    <a href="?sort=role&direction={{ $direction }}">
                        Role
                        @if(request('sort')==='role')
                            {{ request('direction')==='asc'?'▲':'▼' }}
                        @endif
                    </a>
                </th>
                <th class="p-2 border">
                    <a href="?sort=email&direction={{ $direction }}">
                        Email
                        @if(request('sort')==='email')
                            {{ request('direction')==='asc'?'▲':'▼' }}
                        @endif
                    </a>
                </th>
                <th class="p-2 border">Phone</th>
                <th class="p-2 border">Actions</th>
            </tr>

            @forelse($participants as $participant)
                <tr>
                    <td class="p-2 border">
                        @if($participant->profile_photo)
                            <img src="{{ asset('storage/' . $participant->profile_photo) }}" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-600">👤</span>
                            </div>
                        @endif
                    </td>
                    <td class="p-2 border">{{ $participant->name }}</td>
                    <td class="p-2 border">
                        <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
                            {{ ucfirst($participant->role) }}
                        </span>
                    </td>
                    <td class="p-2 border">{{ $participant->email }}</td>
                    <td class="p-2 border">{{ $participant->phone ?? '—' }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('admin.participants.edit', $participant) }}" class="text-blue-600 hover:underline">Edit</a>

                        <form method="POST" action="{{ route('admin.participants.destroy', $participant) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">
                        No participants found.
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $participants->links() }}

    </div>
</x-app-layout>