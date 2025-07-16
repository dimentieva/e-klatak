@extends('layouts.navbar')

@section('title', 'Edit Akun')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-[#0BB4B2] mb-4">Edit Akun</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('karyawan.edit', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Role</label>
            <select name="role" class="w-full border px-3 py-2 rounded" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ old('role', $user->role) == 'kasir' ? 'selected' : '' }}>Kasir</option>
            </select>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('karyawan.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm font-medium transition">
                Kembali
            </a>
            <button type="submit"
                class="bg-[#0BB4B2] hover:bg-teal-700 text-white px-4 py-2 rounded text-sm font-medium transition">
                Update
            </button>
        </div>

    </form>
</div>
@endsection