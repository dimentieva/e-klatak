@extends('layouts.navbar')

@section('title', 'Tambah Akun')

@section('content')
<h2 class="text-2xl font-bold text-[#0bb4b2] mb-4">Tambah Akun</h2>

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
        <label class="block text-sm font-medium">Nama</label>
        <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Role</label>
        <select name="role" class="w-full border px-3 py-2 rounded" required>
            <option value="" disabled selected>Pilih Role</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
        </select>
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