@extends('layouts.navbar')

@section('title', 'Edit Supplier - E-KLATAK')

@section('content')
<h2 class="text-2xl font-bold text-[#0bb4b2] mb-4">Edit Supplier</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-3 mb-4 rounded border">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="formEditSupplier" action="{{ route('supplier.update', $supplier->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium">Nama Supplier</label>
        <input type="text" name="nama_supp" value="{{ $supplier->nama_supp }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block font-medium">Kontak</label>
        <input type="text" name="kontak" value="{{ $supplier->kontak }}" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block font-medium">Alamat</label>
        <textarea name="alamat" class="w-full border rounded px-3 py-2">{{ $supplier->alamat }}</textarea>
    </div>

    <div class="flex justify-start space-x-2">
        <button id="updateBtn" type="submit" class="bg-[#0bb4b2] hover:bg-[#0aa5a3] text-white px-4 py-2 rounded transition">
            Update
        </button>
        <a href="{{ route('supplier.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded transition">
            Batal
        </a>
    </div>
</form>

<script>
    document.getElementById('formEditSupplier').addEventListener('submit', function () {
        const updateBtn = document.getElementById('updateBtn');
        updateBtn.disabled = true;
        updateBtn.innerText = 'Mengupdate...';
    });
</script>
@endsection