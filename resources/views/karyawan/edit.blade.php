@extends('layouts.navbar')

@section('title', 'Edit Karyawan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-[#0BB4B2] mb-4">Edit Karyawan</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Username</label>
                <input type="text" name="username" value="{{ old('username', $karyawan->username) }}"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $karyawan->email) }}"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full border px-3 py-2 rounded" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Tanggal Bergabung</label>
                <input type="date" name="tanggal_bergabung"
                       value="{{ old('tanggal_bergabung', $karyawan->tanggal_bergabung) }}"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('karyawan.index') }}" class="text-sm text-gray-600 hover:underline">
                    ← Kembali
                </a>
                <button type="submit"
                        class="bg-[#0BB4B2] hover:bg-teal-700 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection