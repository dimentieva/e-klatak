@extends('layouts.navbar')

@section('title', 'Tambah Supplier - E-KLATAK')

@section('content')
<h2 class="text-2xl font-bold text-teal-600 mb-4">Tambah Supplier</h2>

@if ($errors->any())
<div class="bg-red-100 text-red-700 px-4 py-3 mb-4 rounded border">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('supplier.store') }}" method="POST" class="bg-gray-50 p-6 rounded shadow space-y-4">
    @csrf

    <div>
        <label for="nama_supp" class="block text-sm font-medium text-gray-700">Nama Supplier</label>
        <input type="text" name="nama_supp" id="nama_supp"
            class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500"
            required>
    </div>

    <div>
        <label for="kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
        <input type="text" name="kontak" id="kontak"
            class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500">
    </div>

    <div>
        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
        <textarea name="alamat" id="alamat"
            class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
    </div>

    <div class="flex justify-start space-x-2">
        <button type="submit"
            class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded font-semibold text-sm transition">
            Simpan
        </button>
        <a href="{{ route('supplier.index') }}"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded font-medium text-sm transition">
            Batal
        </a>
    </div>
</form>
@endsection