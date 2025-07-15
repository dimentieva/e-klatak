<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - E-KLATAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Layout -->
    <div class="flex min-h-screen">

  <!-- Sidebar -->
<aside class="w-64 bg-[#0bb4b2] text-white flex flex-col p-4 min-h-screen justify-between">
    <div>
        <div class="flex items-center space-x-2 mb-6">
            <img src="{{ asset('assets/eklatak.png') }}" alt="Logo" class="w-14 h-14 rounded-full" />
            <h1 class="text-xl font-bold">E-KLATAK</h1>
        </div>

        <nav class="space-y-3">
            <!-- Dashboard -->
            <a href="{{ route('dashboard.admin') }}"
                class="flex items-center space-x-2 px-3 py-2 rounded-md font-semibold
                    {{ Route::is('dashboard.admin') ? 'bg-white text-[#0bb4b2]' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 {{ Route::is('dashboard.admin') ? 'text-[#0bb4b2]' : 'text-white' }}" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-3a2 2 0 01-2-2V14H9v6a2 2 0 01-2 2H4a2 2 0 01-2-2V10z" />
                </svg>
                <span>Dashboard</span>
            </a>

<<<<<<< HEAD
                    <p class="mt-4 text-sm text-white uppercase">Karyawan</p>
                    <a href="{{ route('karyawan.index') }}" class="flex items-center space-x-2 px-3 py-2 hover:bg-[#6DCDE1] hover:text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 4a2 2 0 100 4 2 2 0 000-4zM2 16a6 6 0 1112 0H2zM16 8a2 2 0 11-4 0 2 2 0 014 0zm0 8h-3.5a8.03 8.03 0 00-.5-2.5 6.97 6.97 0 011.5-1.5c.5.5 1.5 1.5 2.5 4z" />
                        </svg>
                        <span>Kelola Karyawan</span>
                    </a>
=======
            <!-- Karyawan -->
            <p class="mt-4 text-sm text-gray-200 uppercase">Karyawan</p>
            <a href="#"
                class="flex items-center space-x-2 px-3 py-2 rounded-md
                    hover:bg-white hover:text-[#0bb4b2]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20h6M6 20h.01M4 20H2v-2a4 4 0 014-4h1
                          m0-6a4 4 0 108 0 4 4 0 00-8 0z" />
                </svg>
                <span>Kelola Karyawan</span>
            </a>
>>>>>>> 35520ec78be3193dd0ce0459d4f0d03b9e507a9c

            <!-- Supplier -->
            <p class="mt-4 text-sm text-gray-200 uppercase">Suplier</p>
            <a href="{{ route('supplier.index') }}"
                class="flex items-center space-x-2 px-3 py-2 rounded-md
                    {{ Route::is('supplier.*') ? 'bg-white text-[#0bb4b2] font-semibold' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 {{ Route::is('supplier.*') ? 'text-[#0bb4b2]' : 'text-white' }}" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span>Kelola Suplier</span>
            </a>

            <!-- Produk -->
            <p class="mt-4 text-sm text-gray-200 uppercase">Produk</p>
            <a href="#"
                class="flex items-center space-x-2 px-3 py-2 rounded-md
                    hover:bg-white hover:text-[#0bb4b2]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 13V6a2 2 0 00-2-2h-5.586a1 1 0 00-.707.293L7 9H4a1 1 0
                          00-1 1v9a2 2 0 002 2h14a2 2 0 002-2v-5a1 1 0 00-1-1h-3z" />
                </svg>
                <span>Kelola Produk</span>
            </a>

            <!-- Laporan -->
            <p class="mt-4 text-sm text-gray-200 uppercase">Laporan</p>
            <a href="#"
                class="flex items-center space-x-2 px-3 py-2 rounded-md
                    hover:bg-white hover:text-[#0bb4b2]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" />
                </svg>
                <span>Laporan</span>
            </a>
        </nav>
    </div>

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit"
                class="w-full text-center bg-[#F8CF63] hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-md transition duration-200">
            Logout
        </button>
    </form>
</aside>



        <!-- Main Content -->
        <main class="flex-1 p-6 bg-white overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-[#0bb4b2]">Dashboard</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-700">Admin 1</span>
                    <span class="text-gray-600 text-xl">👤</span>
                </div>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-[#0bb4b2] hover:bg-[#0097a7] transition duration-300 cursor-pointer text-white p-4 rounded-lg shadow">
                    <p class="text-sm">Total Produk</p>
                    <h3 class="text-xl font-bold">120</h3>
                </div>
                <div class="bg-[#0bb4b2] hover:bg-[#0097a7] transition duration-300 cursor-pointer text-white p-4 rounded-lg shadow">
                    <p class="text-sm">Total Pendapatan</p>
                    <h3 class="text-xl font-bold">Rp. 80.000.000</h3>
                </div>
                <div class="bg-[#0bb4b2] hover:bg-[#0097a7] transition duration-300 cursor-pointer text-white p-4 rounded-lg shadow">
                    <p class="text-sm">Total Karyawan</p>
                    <h3 class="text-xl font-bold">12</h3>
                </div>
                <div class="bg-[#0bb4b2] hover:bg-[#0097a7] transition duration-300 cursor-pointer text-white p-4 rounded-lg shadow">
                    <p class="text-sm">Total Suplier</p>
                    <h3 class="text-xl font-bold">5</h3>
                </div>
            </div>

            <!-- Table and Chart -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Table -->
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

                <!-- Chart Placeholder -->
                <div class="bg-gray-50 rounded-lg p-4 shadow">
                    <h3 class="font-semibold text-gray-700 mb-2">Statistik Penjualan</h3>
                    <div class="h-40 flex items-center justify-center bg-white border rounded-md">
                        <span class="text-gray-400 text-sm">[ Grafik penjualan ]</span>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>

</html>
