<x-app-layout>
    <x-slot name="header">
        ➕ Create Participant
    </x-slot>

    <div class="max-w-xl mx-auto p-6">

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.participants.store') }}" enctype="multipart/form-data">
            @csrf

            <label class="block font-semibold">Name</label>
            <input name="name" class="border p-2 w-full mb-3 rounded" value="{{ old('name') }}" required>

            <label class="block font-semibold">Role</label>
            <select name="role" class="border p-2 w-full mb-3 rounded" required>
                @foreach(['student','teacher','tutor','moderator','guest'] as $r)
                    <option value="{{ $r }}" @selected(old('role')===$r)>{{ ucfirst($r) }}</option>
                @endforeach
            </select>

            <label class="block font-semibold">Email</label>
            <input type="email" name="email" class="border p-2 w-full mb-3 rounded" value="{{ old('email') }}" required>

            <label class="block font-semibold">Phone</label>
            <input type="text" name="phone" class="border p-2 w-full mb-3 rounded" value="{{ old('phone') }}">

            <label class="block font-semibold">Bio</label>
            <textarea name="bio" class="border p-2 w-full mb-3 rounded" rows="3">{{ old('bio') }}</textarea>

            <label class="block font-semibold">Profile Photo</label>
            <input type="file" name="profile_photo" accept="image/*" class="border p-2 w-full mb-4 rounded">

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">
                Create Participant
            </button>
        </form>
    </div>
</x-app-layout>