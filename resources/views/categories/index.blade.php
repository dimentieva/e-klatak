@extends('layouts.navbar')

@section('title', 'Kelola Kategori')

@section('content')
<div x-data="{ showModal: false }">

    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('produk.index') }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-semibold">
            ← Kembali ke Produk
        </a>
    </div>

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-teal-600">Kelola Kategori</h2>
        <button @click="showModal = true"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md font-semibold">
            + Tambah Kategori
        </button>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('categories.index') }}" class="mb-4">
        <input type="text" name="search"
            placeholder="Cari kategori..."
            value="{{ request('search') }}"
            oninput="this.form.submit()"
            class="border border-gray-300 rounded px-4 py-2 w-full md:w-1/3 focus:outline-none focus:ring focus:border-teal-400" />
    </form>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto bg-white p-4 rounded shadow">
        <table class="w-full text-sm text-left text-gray-600 border">
            <thead class="bg-[#0BB4B2] text-white text-xs uppercase text-center">
                <tr>
                    <th class="px-3 py-2 border">No</th>
                    <th class="px-3 py-2 border">Nama Kategori</th>
                    <th class="px-3 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr class="border-b text-center">
                    <td class="px-3 py-2 border">{{ $categories->firstItem() + $index }}</td>
                    <td class="px-3 py-2 border">{{ $category->name }}</td>
                    <td class="px-3 py-2 border">
                        <div class="flex flex-wrap gap-2 justify-center">
                            {{-- Tombol Edit --}}
                            <div x-data="{ showEdit{{ $category->id }}: false }">
                                <button @click="showEdit{{ $category->id }} = true"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm whitespace-nowrap">
                                    Edit
                                </button>

                                {{-- Modal Edit --}}
                                <div x-show="showEdit{{ $category->id }}" x-transition
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                    <div @click.away="showEdit{{ $category->id }} = false"
                                        class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <h3 class="text-lg font-bold mb-4 text-gray-700">Edit Kategori</h3>
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <label for="name{{ $category->id }}" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                                                <input type="text" name="name" id="name{{ $category->id }}" value="{{ $category->name }}" required
                                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-teal-400">
                                            </div>
                                            <div class="flex justify-end gap-2">
                                                <button type="button" @click="showEdit{{ $category->id }} = false"
                                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                                                    Batal
                                                </button>
                                                <button type="submit"
                                                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded font-semibold">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center px-3 py-4 text-gray-500">Tidak ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $categories->links('pagination::tailwind') }}
        </div>
    </div>

    {{-- MODAL TAMBAH KATEGORI --}}
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        x-transition>
        <div @click.away="showModal = false"
            class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
            <h3 class="text-lg font-bold mb-4 text-gray-700">Tambah Kategori</h3>
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-teal-400">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showModal = false"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded font-semibold">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
