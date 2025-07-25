@extends('layouts.app')
@section('title', 'Halaman Kasir')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar Keranjang -->
    <div class="w-1/3 bg-white border-r p-6 flex flex-col shadow-md rounded-tr-xl rounded-br-xl">
        <div class="flex items-center gap-3 mb-6">
            <img src="{{ asset('assets/eklatak.png') }}" class="w-14 h-14 rounded-full border-2 border-[#0BB4B2]" />
            <h1 class="text-3xl font-extrabold text-[#0BB4B2] tracking-wide">E-Klatak</h1>
        </div>

        <!-- TABEL KERANJANG -->
        <div class="overflow-x-auto rounded-lg shadow mb-4">
            <table class="min-w-full text-sm text-center text-gray-700">
                <thead class="bg-[#0BB4B2] text-white text-xs uppercase tracking-wider">
                    <tr>
                        <th scope="col" class="px-4 py-3">Produk</th>
                        <th scope="col" class="px-4 py-3">Harga</th>
                        <th scope="col" class="px-4 py-3">Qty</th>
                        <th scope="col" class="px-4 py-3">Subtotal</th>
                        <th scope="col" class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody id="keranjang" class="divide-y divide-gray-200 bg-white text-center">
                    {{-- Diisi dari JavaScript --}}
                </tbody>
            </table>
        </div>

        <div class="mt-auto space-y-4">
            <div class="text-center bg-gray-100 p-4 rounded-xl text-lg font-semibold text-gray-700 shadow-inner">
                Grand Total: <span id="grandTotal" class="text-[#0BB4B2] font-bold">0</span>
            </div>
            <div class="flex gap-4">
                <button onclick="resetKeranjang()" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-xl w-full transition shadow">
                    Reset
                </button>
                <button onclick="bayar()" class="bg-[#0BB4B2] hover:bg-[#099d9c] text-white py-2 px-4 rounded-xl w-full transition shadow">
                    Bayar
                </button>
            </div>
        </div>
    </div>

    <!-- Konten Produk -->
    <div class="w-2/3 bg-white p-6 overflow-auto shadow-inner">
        <!-- Akun -->
        <div class="flex justify-end mb-6">
            <div class="relative" x-data="{ open: false }" x-cloak>
                <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-[#0BB4B2] font-medium transition">
                    <svg class="w-5 h-5 text-[#0BB4B2]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-5.6 5a6.978 6.978 0 0111.2 0A2 2 0 0113 18H7a2 2 0 01-2.6-3z" />
                    </svg>
                    <span>{{ Auth::user()->name ?? '-' }}</span>
                </button>
                <div x-show="open" @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-md z-20">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filter Kategori -->
        <div class="flex gap-2 mb-4 flex-wrap">
            <button
                onclick="filterKategori(0)"
                class="px-4 py-2 rounded-full kategori-button text-sm shadow hover:brightness-110 transition active-kategori"
                data-id="0">
                Semua
            </button>
            @foreach ($categories as $kat)
            <button
                onclick="filterKategori('{{ $kat->id }}')"
                class="px-4 py-2 rounded-full kategori-button text-sm bg-gray-200 text-gray-700 hover:bg-[#0BB4B2] hover:text-white transition shadow-sm"
                data-id="{{ $kat->id }}">
                {{ $kat->name }}
            </button>
            @endforeach
        </div>


        <!-- Search Produk -->
        <div class="mb-6">
            <input type="text" id="searchInput" oninput="searchProduk()"
                placeholder="Cari nama / ID produk..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm shadow focus:outline-none focus:ring-2 focus:ring-[#0BB4B2] focus:border-[#0BB4B2]">
        </div>

        <!-- List Produk -->
        <div id="produkList" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach ($produk as $item)
            <div class="produk-card bg-white rounded-xl p-4 flex flex-col items-center text-center shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1"
                data-kategori="{{ $item->id_categories }}"
                data-nama="{{ strtolower($item->nama_produk) }}"
                data-barcode="{{ $item->nomor_barcode }}">
                <img src="{{ asset('storage/foto_produk/'.$item->foto) }}"
                    class="w-[150px] h-[150px] object-cover rounded-lg mb-3 border"
                    onerror="this.src='https://via.placeholder.com/150x150?text=No+Image'" />
                <div class="text-sm font-semibold text-gray-800">{{ $item->nama_produk }}</div>
                <div class="text-xs text-gray-500">{{ $item->nomor_barcode }}</div>
                <div class="text-[#0BB4B2] font-bold mt-1 text-sm">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                <button
                    onclick="tambahKeranjang({{ $item->id_produk }}, '{{ addslashes($item->nama_produk) }}', {{ $item->harga_jual }}, {{ $item->stok }})"
                    class="mt-3 w-full py-1.5 rounded-lg text-sm bg-[#0BB4B2] text-white hover:bg-[#099d9c] transition shadow">
                    Tambah
                </button>
            </div>
            @endforeach
        </div>
        <!-- Print Area -->
        <div id="printArea" class="hidden">
            <div style="font-family: monospace; width: 250px; padding: 10px;">
                <!-- Header -->
                <h2 style="text-align: center; margin: 5px 0;">E-Klatak</h2>
                <p style="text-align: center; margin: 0;">Jalan Pantai Waru Doyong Klatak, Soireng, Keboireng, Kec. Besuki, Kab. Tulungagung</p>
                <hr>

                <!-- Info Transaksi -->
                <p>Nota: <span id="printNota"></span></p>
                <p>Tanggal: <span id="printTanggal"></span></p>
                <hr>

                <!-- Daftar Item -->
                <div id="printItems"></div>

                <hr>
                <!-- Total dan Pembayaran -->
                <table style="width: 100%; font-size: 12px;">
                    <tr>
                        <td>Total</td>
                        <td style="text-align: right;"><span id="printTotal"></span></td>
                    </tr>
                    <tr>
                        <td>Pajak (11%)</td>
                        <td style="text-align: right;"><span id="printPajak"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        <td style="text-align: right;"><strong><span id="printGrandTotal"></span></strong></td>
                    </tr>
                    <tr>
                        <td>Bayar</td>
                        <td style="text-align: right;"><span id="printBayar"></span></td>
                    </tr>
                    <tr>
                        <td>Kembalian</td>
                        <td style="text-align: right;"><span id="printKembalian"></span></td>
                    </tr>
                </table>

                <hr>
                <p style="text-align: center;">Terima kasih telah berbelanja!</p>
                <p style="text-align: center;">~ E-Klatak POS ~</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            {{ $produk->links() }}
        </div>
    </div>
</div>
<!-- Modal Pembayaran -->
<x-modal-pembayaran />
@endsection

@push('scripts')
<script src="{{ asset('js/kasir.js') }}"></script>
@endpush

<style>
    .active-kategori {
        background-color: #0BB4B2 !important;
        color: white !important;
    }
</style>