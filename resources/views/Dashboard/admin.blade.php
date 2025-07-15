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
        <aside class="w-64 bg-teal-600 text-white flex flex-col p-4">
            <div class="flex items-center space-x-2 mb-6">
                <img src="https://via.placeholder.com/40" alt="Logo" class="w-10 h-10 rounded-full" />
                <h1 class="text-xl font-bold">E-KLATAK</h1>
            </div>
            <nav class="space-y-3">
                <a href="#" class="flex items-center space-x-2 px-3 py-2 bg-white text-teal-600 rounded-md font-semibold">
                    <span>🏠</span><span>Dashboard</span>
                </a>
                <p class="mt-4 text-sm text-gray-200 uppercase">Karyawan</p>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-teal-600 rounded-md">
                    <span>👥</span><span>Kelola Karyawan</span>
                </a>
                <p class="mt-4 text-sm text-gray-200 uppercase">Suplier</p>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-teal-600 rounded-md">
                    <span>🏭</span><span>Kelola Suplier</span>
                </a>
                <p class="mt-4 text-sm text-gray-200 uppercase">Produk</p>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-teal-600 rounded-md">
                    <span>📦</span><span>Kelola Produk</span>
                </a>
                <p class="mt-4 text-sm text-gray-200 uppercase">Laporan</p>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-teal-600 rounded-md">
                    <span>📑</span><span>Laporan</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-white overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-teal-600">Dashboard</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-700">Admin 1</span>
                    <span class="text-gray-600 text-xl">👤</span>
                </div>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-teal-500 text-white p-4 rounded-lg shadow">
                    <p class="text-sm">Total Produk</p>
                    <h3 class="text-xl font-bold">120</h3>
                </div>
                <div class="bg-teal-500 text-white p-4 rounded-lg shadow">
                    <p class="text-sm">Total Pendapatan</p>
                    <h3 class="text-xl font-bold">Rp. 80.000.000</h3>
                </div>
                <div class="bg-teal-500 text-white p-4 rounded-lg shadow">
                    <p class="text-sm">Total Karyawan</p>
                    <h3 class="text-xl font-bold">12</h3>
                </div>
                <div class="bg-teal-500 text-white p-4 rounded-lg shadow">
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
                                <!-- Tambahkan baris lainnya sesuai data -->
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