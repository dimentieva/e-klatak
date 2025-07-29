@extends('layouts.navbar')

@section('title', 'Data Kategori - E-KLATAK')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-teal-600">Kelola Kategori</h2>
    <button onclick="openCreateModal()"
        class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md font-semibold">
        + Tambah
    </button>
</div>

<!-- Form Search -->
<div class="mb-4">
    <input type="text" id="searchInput" placeholder="Cari kategori..."
        class="w-full md:w-64 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
</div>

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
                <th class="px-3 py-2 border">Nama Kategori</th>
                <th class="px-3 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody id="categoryBody">
            @forelse ($categories as $index => $category)
            <tr class="border-b">
                <td class="px-3 py-2 border">{{ $categories->firstItem() + $index }}</td>
                <td class="px-3 py-2 border">{{ $category->name }}</td>
                <td class="px-3 py-2 border space-x-2">
                    <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</button>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        class="inline-block form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center px-3 py-4 text-gray-500">Tidak ada data kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $categories->links('pagination::tailwind') }}
    </div>
</div>

<!-- Modal Tambah -->
<div id="createModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Tambah Kategori</h3>
        <form action="{{ route('categories.store') }}" method="POST" onsubmit="return disableSubmit(this);">
            @csrf
            <input type="text" name="name" required
                class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:outline-none focus:ring focus:border-teal-400">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeCreateModal()"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Batal</button>
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded font-semibold submit-btn">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Edit Kategori</h3>
        <form id="editForm" method="POST" onsubmit="return disableSubmit(this);">
            @csrf
            @method('PUT')
            <input type="text" name="name" id="editName" required
                class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:outline-none focus:ring focus:border-teal-400">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Batal</button>
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded font-semibold submit-btn">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    const searchInput = document.getElementById('searchInput');
    const categoryBody = document.getElementById('categoryBody');
    const searchUrl = '/admin/api/categories/search';

    function debounce(func, delay = 300) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    const fetchAndRenderCategories = async (query) => {
        try {
            const response = await fetch(`${searchUrl}?search=${encodeURIComponent(query)}`);
            const categories = await response.json();

            categoryBody.innerHTML = '';

            if (categories.length > 0) {
                categories.forEach((cat, index) => {
                    const row = `
                        <tr class="border-b">
                            <td class="px-3 py-2 border">${index + 1}</td>
                            <td class="px-3 py-2 border">${cat.name}</td>
                            <td class="px-3 py-2 border space-x-2">
                                <button onclick="openEditModal(${cat.id}, '${cat.name}')"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</button>
                                <form action="/categories/${cat.id}" method="POST" class="inline-block form-delete">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>`;
                    categoryBody.insertAdjacentHTML('beforeend', row);
                });
                bindDeleteConfirm();
            } else {
                categoryBody.innerHTML = '<tr><td colspan="3" class="text-center px-3 py-4 text-gray-500">Tidak ada data kategori.</td></tr>';
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    };

    searchInput.addEventListener('input', debounce((e) => {
        const query = e.target.value.trim();
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('search', query);
        window.history.pushState({}, '', newUrl);
        fetchAndRenderCategories(query);
    }));

    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const initialQuery = urlParams.get('search') || '';
        if (initialQuery) {
            searchInput.value = initialQuery;
            fetchAndRenderCategories(initialQuery);
        }
        bindDeleteConfirm();
    });

    function bindDeleteConfirm() {
        const forms = document.querySelectorAll('.form-delete');
        forms.forEach(form => {
            form.onsubmit = function (e) {
                const confirmed = confirm('Yakin ingin menghapus data ini?');
                if (!confirmed) {
                    e.preventDefault();
                    return false;
                }
                const btn = form.querySelector('button');
                if (btn) {
                    btn.disabled = true;
                    btn.innerText = 'Memproses...';
                }
                return true;
            };
        });
    }

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.getElementById('createModal').classList.add('flex');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.getElementById('createModal').classList.remove('flex');
    }

    function openEditModal(id, name) {
        const form = document.getElementById('editForm');
        form.action = `/categories/${id}`;
        document.getElementById('editName').value = name;
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    function disableSubmit(form) {
        const btn = form.querySelector('.submit-btn');
        if (btn) {
            btn.disabled = true;
            btn.innerText = 'Memproses...';
        }
        return true;
    }
</script>
@endsection