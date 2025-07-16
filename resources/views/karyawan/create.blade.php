@extends('layouts.navbar')

@section('title', 'Tambah Karyawan')

@section('content')
    <h2 class="text-2xl font-bold text-[#0bb4b2] mb-4">Tambah Karyawan</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('karyawan.store') }}" method="POST" class="bg-white p-4 rounded shadow space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Username</label>
            <input type="text" name="username" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm font-medium">No HP</label>
            <input type="text" name="no_hp" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full border px-3 py-2 rounded" required></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium">Tanggal Bergabung</label>
            <input type="date" name="tanggal_bergabung" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-[#0bb4b2] hover:bg-[#0aa5a3] text-white px-4 py-2 rounded transition">
                Simpan
            </button>
            <a href="{{ route('karyawan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded transition">
                Batal
            </a>
        </div>
    </form>
@endsection