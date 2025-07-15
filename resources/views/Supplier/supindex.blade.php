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


    <!-- Sidebar disalin dari dashboard -->
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
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-teal-600">Data Supplier</h2>
            <a href="{{ route('supplier.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">+ Tambah</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden text-sm">
            <thead class="bg-teal-600 text-white">
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
