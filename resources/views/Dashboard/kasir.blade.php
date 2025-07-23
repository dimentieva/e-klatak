@extends('layouts.app')
@section('title', 'Halaman Kasir')

@section('content')
<div class="flex h-screen">
    <!-- Sidebar Keranjang -->
    <div class="w-1/2 bg-white border-r p-4 flex flex-col">
        <div class="flex items-center gap-2 mb-4">
            <img src="{{ asset('assets/eklatak.png') }}" class="w-14 h-14 rounded-full" />
            <h1 class="text-2xl font-bold text-[#0BB4B2]">E-Klatak</h1>
        </div>

        <table class="w-full text-left border mb-2 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="keranjang"></tbody>
        </table>

        <div class="mt-auto space-y-3">
            <div class="highlight text-center p-3 rounded text-lg">
                Grand Total : Rp. <span id="grandTotal">0</span>
            </div>
            <div class="flex gap-2">
                <button onclick="resetKeranjang()" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded w-full">Reset</button>
                <button onclick="bayar()" class="btn-primary py-2 px-4 rounded w-full">Bayar</button>
            </div>
        </div>
    </div>

    <!-- Konten Produk -->
    <div class="w-1/2 bg-white p-6 overflow-auto">
        <div class="flex justify-end mb-4">
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-[#0BB4B2] font-semibold dropdown-button">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-5.6 5a6.978 6.978 0 0111.2 0A2 2 0 0113 18H7a2 2 0 01-2.6-3z" />
                    </svg>
                    <span>{{ Auth::user()->name ?? '-' }}</span>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white border rounded shadow z-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex gap-2 mb-4 flex-wrap">
            <button onclick="filterKategori(0)" class="px-3 py-1 rounded kategori-button active-kategori text-sm">Semua</button>
            @foreach ($categories as $kat)
            <button onclick="filterKategori('{ $kat->id }')" class="px-3 py-1 rounded kategori-button text-sm">
                {{ $kat->name }}
            </button>
            @endforeach
        </div>

        <div class="mb-4">
            <input type="text" id="searchInput" oninput="searchProduk()" placeholder="Cari nama / ID produk..." class="w-full border border-[#0BB4B2] rounded px-4 py-2 focus:ring-[#0BB4B2] focus:border-[#0BB4B2]">
        </div>

        <div id="produkList" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($produk as $item)
            <div class="produk-card bg-white rounded-lg p-3 flex flex-col items-center text-center"
                data-kategori="{{ $item->id_categories }}"
                data-nama="{{ strtolower($item->nama_produk) }}"
                data-barcode="{{ $item->nomor_barcode }}">
                <img src="{{ asset('storage/foto_produk/'.$item->foto) }}"
                    class="w-[120px] h-[120px] object-cover rounded-lg mb-3"
                    onerror="this.src='https://via.placeholder.com/80x80?text=No+Image'" />
                <div class="text-sm font-semibold">{{ $item->nama_produk }}</div>
                <div class="text-xs text-gray-500">{{ $item->nomor_barcode }}</div>
                <div class="text-[#0BB4B2] font-bold mt-1">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                <button
                    onclick='tambahKeranjang("{{ $item->id_produk }}", "{{ addslashes($item->nama_produk) }}", "{{ $item->harga_jual }}")'
                    class="btn-primary mt-2 w-full py-1 rounded text-sm">
                    Tambah
                </button>


            </div>
            @endforeach
        </div>

        <div class="flex justify-center mt-4">
            {{ $produk->links() }}
        </div>
    </div>
</div>

<!-- Modal -->
<x-modal-pembayaran />
@endsection

@push('scripts')
<script src="{{ asset('js/kasir.js') }}"></script>
@endpush