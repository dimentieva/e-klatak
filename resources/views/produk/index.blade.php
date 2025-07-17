@extends('layouts.navbar')

@section('title', 'Kelola Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-teal-600">Kelola Produk</h2>
    <a href="{{ route('produk.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md font-semibold">
        + Tambah
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="overflow-x-auto bg-white p-4 rounded shadow">
    <table class="w-full text-sm text-left text-gray-600 border">
        <thead class="bg-[#0BB4B2] text-white text-xs uppercase text-center">
            <tr>
                <th class="px-3 py-2 border">No</th>
                <th class="px-3 py-2 border">Barcode</th>
                <th class="px-3 py-2 border">Nama Produk</th>
                <th class="px-3 py-2 border">Kategori</th>
                <th class="px-3 py-2 border">Supplier</th>
                <th class="px-3 py-2 border">Harga Jual</th>
                <th class="px-3 py-2 border">Harga Beli</th>
                <th class="px-3 py-2 border">Stok</th>
                <th class="px-3 py-2 border">Status</th>
                <th class="px-3 py-2 border">Foto</th>
                <th class="px-3 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $index => $produk)
            <tr class="border-b text-center">
                <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                <td class="px-3 py-2 border">{{ $produk->nomor_barcode }}</td>
                <td class="px-3 py-2 border">{{ $produk->nama_produk }}</td>
                <td class="px-3 py-2 border">{{ $produk->kategori }}</td>
                <td class="px-3 py-2 border">{{ $produk->supplier->nama_supp }}</td>
                <td class="px-3 py-2 border">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                <td class="px-3 py-2 border">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                <td class="px-3 py-2 border">{{ $produk->stok }}</td>
                <td class="px-3 py-2 border capitalize">{{ $produk->status }}</td>
                <td class="px-3 py-2 border">
                    @if($produk->foto)
                    <img src="{{ asset('storage/foto_produk/'.$produk->foto) }}" class="w-14 h-14 object-cover rounded" alt="foto">
                    @else
                    <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-3 py-2 border">
                    <div class="flex flex-wrap gap-2 justify-center">
                        <a href="{{ route('produk.edit', $produk->id_produk) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm whitespace-nowrap">
                            Edit
                        </a>
                        <a href="{{ route('produk.kelola_stok', $produk->id_produk) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                            Stok
                        </a>
                        <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection