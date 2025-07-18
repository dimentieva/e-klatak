@extends('layouts.navbar')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Header Dashboard + Info User -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#0BB4B2]">Dashboard Admin</h2>

        <div class="flex items-center space-x-4 mt-4 md:mt-0 bg-white px-4 py-2 rounded shadow-sm border border-gray-200">
            <!-- Avatar user -->
            <div class="w-8 h-8 rounded-full bg-[#0BB4B2] text-white flex items-center justify-center font-semibold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <!-- Nama dan email -->
            <div class="text-sm text-gray-700">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="text-gray-500 text-xs">{{ Auth::user()->email }}</div>
            </div>

            <!-- Tombol edit -->
            <a href="{{ route('profile.edit') }}" class="text-[#0BB4B2] hover:text-teal-800 text-sm font-medium flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6M4 20h4l10-10a1.414 1.414 0 00-2-2L6 18v2z" />
                </svg>
                <span>Edit</span>
            </a>
        </div>
    </div>

{{-- Cards --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
        <p class="text-sm">Total Produk</p>
        <h3 class="text-xl font-bold">120</h3>
    </div>
    <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
        <p class="text-sm">Total Pendapatan</p>
        <h3 class="text-xl font-bold">Rp. 80.000.000</h3>
    </div>
    <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
        <p class="text-sm">Total Karyawan</p>
        <h3 class="text-xl font-bold">12</h3>
    </div>
    <div class="bg-[#0BB4B2] text-white p-4 rounded-lg shadow">
        <p class="text-sm">Total Supplier</p>
        <h3 class="text-xl font-bold">5</h3>
    </div>
</div>

{{-- Table + Chart --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- Table --}}
    <div class="md:col-span-2 bg-gray-50 rounded-lg p-4 shadow">
        <h3 class="font-semibold text-gray-700 mb-2">Data Penjualan Terbaru</h3>
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
                    <tr class="border-b">
                        <td class="px-3 py-2">1</td>
                        <td class="px-3 py-2">Bela</td>
                        <td class="px-3 py-2">15/01/2025</td>
                        <td class="px-3 py-2">Ikan Asap</td>
                        <td class="px-3 py-2">4 pcs</td>
                        <td class="px-3 py-2">25.000</td>
                        <td class="px-3 py-2">100.000</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-3 py-2">2</td>
                        <td class="px-3 py-2">John</td>
                        <td class="px-3 py-2">15/01/2025</td>
                        <td class="px-3 py-2">Indomie Kuah</td>
                        <td class="px-3 py-2">5 pcs</td>
                        <td class="px-3 py-2">3.000</td>
                        <td class="px-3 py-2">15.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart Placeholder --}}
    <div class="bg-gray-50 rounded-lg p-4 shadow">
        <h3 class="font-semibold text-gray-700 mb-2">Statistik Penjualan</h3>
        <div class="h-40 flex items-center justify-center bg-white border rounded-md">
            <span class="text-gray-400 text-sm">[ Grafik penjualan ]</span>
        </div>
    </div>
</div>
@endsection
