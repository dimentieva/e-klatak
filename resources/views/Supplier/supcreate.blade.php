<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Supplier - E-KLATAK</title>
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
               class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-white hover:text-[#0bb4b2]">
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
               class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-white hover:text-[#0bb4b2]">
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
               class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-white hover:text-[#0bb4b2]">
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
        <h2 class="text-2xl font-bold text-[#0bb4b2] mb-4">Tambah Supplier</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 mb-4 rounded border">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('supplier.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nama Supplier</label>
                <input type="text" name="nama_supp" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium">Kontak</label>
                <input type="text" name="kontak" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Alamat</label>
                <textarea name="alamat" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="flex justify-start space-x-2">
                <button type="submit" class="bg-[#0bb4b2] hover:bg-[#0aa5a3] text-white px-4 py-2 rounded transition">Simpan</button>
                <a href="{{ route('supplier.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded transition">Batal</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
