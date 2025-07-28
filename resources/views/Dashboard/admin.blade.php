@extends('layouts.navbar')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#0BB4B2]">Dashboard Admin</h2>
        <div class="flex items-center space-x-4 mt-4 md:mt-0 bg-white px-4 py-2 rounded shadow-sm border border-gray-200">
            <div class="w-8 h-8 rounded-full bg-[#0BB4B2] text-white flex items-center justify-center font-semibold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="text-sm text-gray-700">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="text-gray-500 text-xs">{{ Auth::user()->email }}</div>
            </div>
            <a href="{{ route('profile.edit') }}" class="text-[#0BB4B2] hover:text-teal-800 text-sm font-medium flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6M4 20h4l10-10a1.414 1.414 0 00-2-2L6 18v2z" />
                </svg>
                <span>Edit</span>
            </a>
        </div>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
            <p class="text-sm">Total Produk </p>
            <h3 class="text-xl font-bold">{{ $totalProduk }}</h3>
        </div>
        <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
            <p class="text-sm">Pendapatan Hari ini</p>
            <h3 class="text-xl font-bold">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
            <p class="text-sm">Total Karyawan</p>
            <h3 class="text-xl font-bold">{{ $totalKaryawan }}</h3>
        </div>
        <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
            <p class="text-sm">Total Supplier</p>
            <h3 class="text-xl font-bold">{{ $totalSupplier }}</h3>
        </div>
    </div>

    <!-- Table & Chart -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Table -->
        <div class="md:col-span-2 bg-gray-50 rounded-lg p-4 shadow">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-gray-700">Data Penjualan Hari Ini</h3>
                <a href="{{ route('laporan.index') }}" class="text-sm text-[#0BB4B2] hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-200 text-xs uppercase">
                        <tr>
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Kasir</th>
                            <th class="px-3 py-2">Tanggal</th>
                            <th class="px-3 py-2">Produk</th>
                            <th class="px-3 py-2">Qty</th>
                            <th class="px-3 py-2">Harga</th>
                            <th class="px-3 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rowNumber = 1; @endphp
                        @forelse ($penjualanHariIni as $transaksi)
                            @foreach ($transaksi->detailTransaksi as $detail)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ $rowNumber++ }}</td>
                                    <td class="px-3 py-2">{{ $transaksi->user->name }}</td>
                                    <td class="px-3 py-2">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y') }}</td>
                                    <td class="px-3 py-2">{{ $detail->produk->nama_produk ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $detail->jumlah }} pcs</td>
                                    <td class="px-3 py-2">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-3 py-2">
                                        Rp {{ number_format($detail->sub_total + ($transaksi->pajak / max(count($transaksi->detailTransaksi), 1)), 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 py-4">Belum ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-gray-50 rounded-lg p-4 shadow">
            <h3 class="font-semibold text-gray-700 mb-2">Statistik Penjualan</h3>
            <canvas id="penjualanChart" class="w-full h-48"></canvas>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Chart Script --}}
<script>
    const ctx = document.getElementById('penjualanChart').getContext('2d');
    const penjualanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Penjualan',
                data: {!! json_encode($chartData) !!},
                backgroundColor: '#0BB4B2',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed.y;
                            return ' ' + new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            }).format(value);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>
@endsection
