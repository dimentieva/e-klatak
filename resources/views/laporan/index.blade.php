@extends('layouts.navbar')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold text-[#0BB4B2] mb-4">Laporan Transaksi</h2>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4 flex flex-wrap gap-4 items-center">
        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="border rounded p-2" required>
        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="border rounded p-2" required>

        <button type="submit" class="bg-[#0BB4B2] text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('laporan.index') }}" class="px-4 py-2 border rounded">Reset</a>

        <a href="{{ route('laporan.pdf', [
            'tanggal_mulai' => request('tanggal_mulai'),
            'tanggal_selesai' => request('tanggal_selesai')
        ]) }}" 
        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
            Download PDF
        </a>
    </form>

    {{-- Tabel Transaksi --}}
    <table class="w-full table-auto border mb-6">
        <thead class="bg-[#0BB4B2] text-white">
            <tr>
                <th class="border px-2 py-1">Tanggal</th>
                <th class="border px-2 py-1">Kode Transaksi</th>
                <th class="border px-2 py-1">Produk</th>
                <th class="border px-2 py-1">Jumlah Produk</th>
                <th class="border px-2 py-1">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $trx)
                <tr>
                    <td class="border px-2 py-1">{{ $trx->created_at->format('d-m-Y') }}</td>
                    <td class="border px-2 py-1">{{ $trx->nomor_nota }}</td>
                    <td class="border px-2 py-1">
                        <ul class="list-disc pl-5">
                            @foreach ($trx->detailTransaksi as $item)
                                <li>{{ $item->produk->nama_produk ?? 'Produk telah dihapus' }} ({{ $item->jumlah }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border px-2 py-1 text-center">{{ $trx->detailTransaksi->sum('jumlah') }}</td>
                    <td class="border px-2 py-1">Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-2">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if ($transaksi->count() > 0)
        <div class="mb-6">
            {{ $transaksi->appends(request()->query())->links() }}
        </div>
    @endif

    {{-- Statistik Ringkas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        {{-- Pendapatan Kotor --}}
        <div class="bg-white border-l-4 border-green-500 shadow-sm p-4 rounded-md">
            <p class="text-sm text-gray-500">Pendapatan Kotor</p>
            <h4 class="text-2xl font-semibold text-gray-800">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
        </div>

        {{-- Laba --}}
        <div class="bg-white border-l-4 border-blue-500 shadow-sm p-4 rounded-md">
            <p class="text-sm text-gray-500">Total Laba</p>
            <h4 class="text-2xl font-semibold text-gray-800">Rp{{ number_format($laba, 0, ',', '.') }}</h4>
        </div>

        {{-- Rugi --}}
        <div class="bg-white border-l-4 border-red-500 shadow-sm p-4 rounded-md">
            <p class="text-sm text-gray-500">Total Rugi</p>
            <h4 class="text-2xl font-semibold text-gray-800">Rp{{ number_format($rugi, 0, ',', '.') }}</h4>
        </div>
    </div>

    {{-- Produk Paling Banyak Terjual --}}
    <div class="bg-white border-l-4 border-yellow-500 shadow-sm p-4 rounded-md mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Produk Paling Banyak Terjual</h3>
        @if ($produkTerlaris)
            <p class="text-gray-700">
                <span class="font-semibold">{{ $produkTerlaris->produk->nama_produk ?? 'Produk telah dihapus' }}</span> —
                terjual sebanyak <span class="font-bold text-yellow-600">{{ $produkTerlaris->total_terjual }}</span> unit.
            </p>
        @else
            <p class="text-gray-500 italic">Belum ada data produk terlaris.</p>
        @endif
    </div>
</div>
@endsection
