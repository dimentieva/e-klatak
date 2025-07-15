<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Supplier - E-KLATAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#0bb4b2] text-white flex flex-col p-4 min-h-screen">
        <div class="flex items-center space-x-2 mb-6">
            <img src="https://via.placeholder.com/40" alt="Logo" class="w-10 h-10 rounded-full" />
            <h1 class="text-xl font-bold">E-KLATAK</h1>
        </div>
        <nav class="space-y-3">
            <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-[#0bb4b2] rounded-md">
                <span>🏠</span><span>Dashboard</span>
            </a>
            <p class="mt-4 text-sm text-gray-200 uppercase">Karyawan</p>
            <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-[#0bb4b2] rounded-md">
                <span>👥</span><span>Kelola Karyawan</span>
            </a>
            <p class="mt-4 text-sm text-gray-200 uppercase">Suplier</p>
            <a href="{{ route('supplier.index') }}" class="flex items-center space-x-2 px-3 py-2 bg-white text-[#0bb4b2] rounded-md font-semibold">
                <span>🏭</span><span>Kelola Suplier</span>
            </a>
            <p class="mt-4 text-sm text-gray-200 uppercase">Produk</p>
            <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-[#0bb4b2] rounded-md">
                <span>📦</span><span>Kelola Produk</span>
            </a>
            <p class="mt-4 text-sm text-gray-200 uppercase">Laporan</p>
            <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-white hover:text-[#0bb4b2] rounded-md">
                <span>📑</span><span>Laporan</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-white overflow-y-auto">
        <h2 class="text-2xl font-bold text-[#0bb4b2] mb-4">Edit Supplier</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 mb-4 rounded border">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-medium text-gray-700">Nama Supplier</label>
                <input type="text" name="nama_supp" value="{{ $supplier->nama_supp }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-[#0bb4b2] focus:outline-none" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Kontak</label>
                <input type="text" name="kontak" value="{{ $supplier->kontak }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-[#0bb4b2] focus:outline-none">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-[#0bb4b2] focus:outline-none">{{ $supplier->alamat }}</textarea>
            </div>
            <div class="flex justify-start space-x-2">
                <button type="submit" class="bg-[#0bb4b2] hover:bg-[#0097a7] text-white px-4 py-2 rounded transition">Update</button>
                <a href="{{ route('supplier.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition">Batal</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
