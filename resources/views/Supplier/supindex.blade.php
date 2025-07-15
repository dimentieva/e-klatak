<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Supplier - E-KLATAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
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

            <!-- Karyawan -->
            <p class="mt-4 text-sm text-gray-200 uppercase">Karyawan</p>
            <a href="{{ route('karyawan.index') }}"
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
            <h2 class="text-2xl font-bold text-[#0bb4b2]">Data Supplier</h2>
            <a href="{{ route('supplier.create') }}" class="bg-[#0bb4b2] text-white px-4 py-2 rounded hover:bg-[#0aa5a3] transition">+ Tambah</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden text-sm">
            <thead class="bg-[#0bb4b2] text-white">
                <tr>
                    <th class="py-2 px-4 text-left">No</th>
                    <th class="py-2 px-4 text-left">Nama</th>
                    <th class="py-2 px-4 text-left">Kontak</th>
                    <th class="py-2 px-4 text-left">Alamat</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $supplier->nama_supp }}</td>
                        <td class="py-2 px-4">{{ $supplier->kontak }}</td>
                        <td class="py-2 px-4">{{ $supplier->alamat }}</td>
                        <td class="py-2 px-4 space-x-2">
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-gray-500 py-4">Belum ada data supplier.</td></tr>
                @endforelse
            </tbody>
        </table>
    </main>
</div>
</body>
</html>
