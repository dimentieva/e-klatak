@extends('layouts.navbar')

@section('title', 'Data Supplier - E-KLATAK')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-teal-600">Kelola Supplier</h2>
    <a href="{{ route('supplier.create') }}"
       class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md font-semibold">
        + Tambah
    </a>
</div>

<!-- Form Search -->
<form method="GET" action="{{ route('supplier.index') }}" id="searchForm" class="mb-4">
    <div class="flex items-center space-x-2">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari supplier..."
               class="w-full md:w-64 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500"
               oninput="submitForm()">
    </div>
</form>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto bg-gray-50 p-4 rounded shadow">
    <table class="w-full text-sm text-center text-gray-600 border">
        <thead class="bg-[#0BB4B2] text-white text-xs uppercase">
            <tr>
                <th class="px-3 py-2 border">No</th>
                <th class="px-3 py-2 border">Nama</th>
                <th class="px-3 py-2 border">Kontak</th>
                <th class="px-3 py-2 border">Alamat</th>
                <th class="px-3 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $index => $supplier)
                <tr class="border-b">
                    <td class="px-3 py-2 border">{{ $suppliers->firstItem() + $index }}</td>
                    <td class="px-3 py-2 border">{{ $supplier->nama_supp }}</td>
                    <td class="px-3 py-2 border">{{ $supplier->kontak }}</td>
                    <td class="px-3 py-2 border">{{ $supplier->alamat }}</td>
                    <td class="px-3 py-2 border space-x-2">
                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST"
                              class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center px-3 py-4 text-gray-500">Tidak ada data supplier.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $suppliers->links('pagination::tailwind') }}
    </div>
</div>

<!-- Live Search JS -->
<script>
    let timer;
    function submitForm() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500); // tunggu 0.5 detik sebelum submit saat user berhenti mengetik
    }
</script>
@endsection
