@extends('layouts.navbar')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-[#0BB4B2] mb-4">Edit Produk</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="form-edit-produk" action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Kategori</label>
            <select name="id_categories" class="w-full border px-3 py-2 rounded" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $produk->id_categories == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium">Supplier</label>
            <select name="id_supplier" class="w-full border px-3 py-2 rounded" required>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $produk->id_supplier == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama_supp }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Nomor Barcode</label>
            <input type="text" name="nomor_barcode" value="{{ old('nomor_barcode', $produk->nomor_barcode ?? '') }}" class="w-full border px-3 py-2 rounded" placeholder="(Opsional)">
        </div>

        <div>
            <label class="block text-sm font-medium">Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Harga Jual</label>
                <input type="number" step="0.01" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Harga Beli</label>
                <input type="number" step="0.01" name="harga_beli" value="{{ old('harga_beli', $produk->harga_beli) }}" class="w-full border px-3 py-2 rounded" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Stok</label>
                <input type="number" name="stok" value="{{ $produk->stok }}" class="w-full border px-3 py-2 rounded bg-gray-100 cursor-not-allowed" readonly>
                <p class="text-sm text-gray-500 mt-1">Gunakan <strong>Tambah Stok</strong> untuk mengubah stok.</p>
            </div>
            <div>
                <label class="block text-sm font-medium">Batas Stok Minimal</label>
                <input type="number" name="batas_stok_minimal" value="{{ old('batas_stok_minimal', $produk->batas_stok_minimal) }}" class="w-full border px-3 py-2 rounded" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded" required>
                <option value="dijual" {{ $produk->status == 'dijual' ? 'selected' : '' }}>Dijual</option>
                <option value="tidak dijual" {{ $produk->status == 'tidak dijual' ? 'selected' : '' }}>Tidak Terjual</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Foto Produk</label>
            @if($produk->foto)
            <img src="{{ asset('storage/foto_produk/'.$produk->foto) }}" class="w-24 h-24 object-cover mb-2 rounded" alt="Foto Produk">
            @endif
            <input type="file" name="foto" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('produk.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm font-medium transition">
                Batal
            </a>
            <button id="btn-update" type="submit" class="bg-[#0BB4B2] hover:bg-teal-700 text-white px-4 py-2 rounded text-sm font-medium transition">
                Update
            </button>
        </div>
    </form>
</div>

{{-- Script untuk mencegah double submit --}}
<script>
    document.getElementById('form-edit-produk').addEventListener('submit', function () {
        const btn = document.getElementById('btn-update');
        btn.disabled = true;
        btn.innerText = 'Memperbarui...';
    });
</script>
@endsection