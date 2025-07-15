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
    <aside class="w-64 bg-teal-600 text-white flex flex-col p-4">
        <div class="flex items-center space-x-2 mb-6">
            <img src="https://via.placeholder.com/40" alt="Logo" class="w-10 h-10 rounded-full" />
            <h1 class="text-xl font-bold">E-KLATAK</h1>
        </div>
        <nav class="space-y-3">
            <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-teal-600 rounded-md">
                <span>🏠</span><span>Dashboard</span>
            </a>
            </a>
        <p class="mt-4 text-sm text-gray-200 uppercase">Karyawan</p>
            <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-teal-600 rounded-md">
            <span>👥</span><span>Kelola Karyawan</span>
            </a>
        <p class="mt-4 text-sm text-gray-200 uppercase">Suplier</p>
            <a href="{{ route('supplier.index') }}" class="flex items-center space-x-2 px-3 py-2 bg-white text-teal-600 rounded-md font-semibold">
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
        <h2 class="text-2xl font-bold text-teal-600 mb-4">Tambah Supplier</h2>

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
                <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('supplier.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
