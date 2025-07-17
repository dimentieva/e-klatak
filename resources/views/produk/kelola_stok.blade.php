@extends('layouts.navbar')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Kelola Stok Produk</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    {{-- Form Perubahan Stok --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form action="{{ route('produk.kelola_stok') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="produk_id" class="block font-semibold mb-1">Produk:</label>
                <select name="produk_id" id="produk_id" required class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produkList as $produk)
                    <option value="{{ $produk->id_produk }}">{{ $produk->nama_produk }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="jenis" class="block font-semibold mb-1">Jenis Perubahan:</label>
                <select name="jenis" id="jenis" required class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="tambah">Tambah</option>
                    <option value="kurang">Kurang</option>
                </select>
            </div>

            <div>
                <label for="jumlah_perubahan" class="block font-semibold mb-1">Jumlah:</label>
                <input type="number" name="jumlah_perubahan" id="jumlah_perubahan" required class="w-full border border-gray-300 rounded p-2">
            </div>

            <div>
                <label for="keterangan" class="block font-semibold mb-1">Keterangan (opsional):</label>
                <input type="text" name="keterangan" id="keterangan" class="w-full border border-gray-300 rounded p-2">
            </div>

            <div class="flex gap-3 mt-4">
                <a href="{{ url()->previous() }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Kembali</a>
                <button type="reset" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-[#0BB4B2] hover:bg-[#099e9c] text-white px-4 py-2 rounded">Simpan</button>

            </div>
        </form>
    </div>
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Riwayat Perubahan Stok</h2>
    {{-- Filter Bulan & Tahun --}}
    <form method="GET" class="mb-4 flex flex-wrap gap-3 items-center bg-white p-4 rounded-lg shadow">
        <div>
            <label for="bulan" class="block text-sm font-semibold">Bulan:</label>
            <select name="bulan" id="bulan" class="border border-gray-300 rounded p-2">
                <option value="">Semua</option>
                @foreach(range(1,12) as $b)
                <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tahun" class="block text-sm font-semibold">Tahun:</label>
            <select name="tahun" id="tahun" class="border border-gray-300 rounded p-2">
                <option value="">Semua</option>
                @foreach(range(date('Y'), 2020) as $t)
                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-[#0BB4B2] hover:bg-[#099e9c] text-white px-4 py-2 rounded self-end">
            Filter
        </button>
    </form>

    {{-- Tabel Log --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Produk</th>
                    <th class="px-4 py-2 border">Jenis</th>
                    <th class="px-4 py-2 border">Sebelum</th>
                    <th class="px-4 py-2 border">Sesudah</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Keterangan</th>
                    <th class="px-4 py-2 border">Oleh</th>
                    <th class="px-4 py-2 border">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $log->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($log->jenis) }}</td>
                    <td class="px-4 py-2 border">{{ $log->stok_awal }}</td>
                    <td class="px-4 py-2 border">{{ $log->stok_akhir }}</td>
                    <td class="px-4 py-2 border">{{ $log->jumlah_perubahan }}</td>
                    <td class="px-4 py-2 border">{{ $log->keterangan }}</td>
                    <td class="px-4 py-2 border">{{ $log->created_by }}</td>
                    <td class="px-4 py-2 border">{{ $log->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">Tidak ada data log stok</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="mt-4 px-4">
            {{ $logs->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection