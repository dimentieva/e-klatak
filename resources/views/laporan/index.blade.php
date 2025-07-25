@extends('layouts.navbar')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold text-[#0BB4B2] mb-4">Laporan Transaksi</h2>

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
                    <td class="border px-2 py-1 text-center">
                        {{ $trx->detailTransaksi->sum('jumlah') }}
                    </td>
                    <td class="border px-2 py-1">Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-2">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Info dan Navigasi Pagination --}}
    @if ($transaksi->count() > 0)
        <div class="mb-6">
            {{ $transaksi->appends(request()->query())->links() }}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="bg-white border-l-4 border-[#0BB4B2] shadow-sm p-4 rounded-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Produk Terjual</p>
                        <h4 class="text-2xl font-semibold text-gray-800">{{ $totalProduk }}</h4>
                    </div>
                    <div class="bg-[#0BB4B2]/10 text-[#0BB4B2] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h18M9 3v18m6-18v18M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-[#0BB4B2] shadow-sm p-4 rounded-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Pendapatan</p>
                        <h4 class="text-2xl font-semibold text-gray-800">
                            Rp{{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h4>
                    </div>
                    <div class="bg-[#0BB4B2]/10 text-[#0BB4B2] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3m0 0c1.657 0 3-1.343 3-3s-1.343-3-3-3m0 0v12m0 0H6m6 0h6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection