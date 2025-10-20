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
<div class="mb-4">
    <input type="text" id="searchInput" placeholder="Cari supplier..."
        class="w-full md:w-64 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-700 px-4 py-3 mb-4 rounded border">
        {{ session('error') }}
    </div>
@endif

<div class="overflow-x-auto bg-gray-50 p-4 rounded shadow">
    <table class="w-full text-sm text-center text-gray-600 border">
        <thead class="bg-[#0BB4B2] text-white text-xs uppercase">
            <tr>
                <th class="px-3 py-2 border">No</th>
                <th class="px-3 py-2 border">Nama</th>
                <th class="px-3 py-2 border">No Hp</th>
                <th class="px-3 py-2 border">Alamat</th>
                <th class="px-3 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody id="supplierBody">
            @forelse ($suppliers as $index => $supplier)
            <tr class="px-3 py-2 border">
                <td class="px-3 py-2 border">{{ $suppliers->firstItem() + $index }}</td>
                <td class="px-3 py-2 border">{{ $supplier->nama_supp }}</td>
                <td class="px-3 py-2 border">{{ $supplier->kontak ?? 'Belum Ada' }}</td>
                <td class="px-3 py-2 border">{{ $supplier->alamat ?? 'Belum Ada' }}</td>
                <td class="flex flex-wrap gap-1 justify-center">
                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black px-2 py-1 rounded text-sm">Edit</a>
                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST"
                        class="inline-block form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus</button>
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

<!-- JavaScript -->
<script>
    const searchInput = document.getElementById('searchInput');
    const supplierBody = document.getElementById('supplierBody');
    const searchUrl = '/admin/api/supplier/search';

    function debounce(func, delay = 300) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    const fetchAndRenderSuppliers = async (query) => {
        try {
            const response = await fetch(`${searchUrl}?search=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (!response.ok) throw new Error('Network response was not ok');
            const suppliers = await response.json();

            supplierBody.innerHTML = '';

            if (suppliers.length > 0) {
                suppliers.forEach((supplier, index) => {
                    const row = `
                    <tr class="border-b">
                        <td class="px-3 py-2 border">${index + 1}</td>
                        <td class="px-3 py-2 border">${supplier.nama_supp}</td>
                        <td class="px-3 py-2 border">${supplier.kontak ? supplier.kontak : 'Belum Ada'}</td>
                        <td class="px-3 py-2 border">${supplier.alamat ? supplier.alamat : 'Belum Ada'}</td>
                        <td class="px-3 py-2 border space-x-2">
                            <a href="/supplier/${supplier.id}/edit"
                               class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                            <form action="/supplier/${supplier.id}" method="POST"
                                  class="inline-block form-delete">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                `;
                    supplierBody.insertAdjacentHTML('beforeend', row);
                });
                bindDeleteConfirm();
            } else {
                supplierBody.innerHTML = '<tr><td colspan="5" class="text-center px-3 py-4 text-gray-500">Tidak ada data supplier.</td></tr>';
            }
        } catch (error) {
            console.error('Fetch error:', error);
            supplierBody.innerHTML = '<tr><td colspan="5" class="text-center px-3 py-4 text-red-500">Gagal memuat data supplier.</td></tr>';
        }
    };

    // Main event listener for search input
    searchInput.addEventListener('input', debounce((event) => {
        const query = event.target.value.trim();

        // Update URL with search query
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('search', query);
        window.history.pushState({}, '', newUrl);

        // Fetch and update suppliers
        fetchAndRenderSuppliers(query);
    }));

    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const initialQuery = urlParams.get('search') || '';
        if (initialQuery) {
            searchInput.value = initialQuery;
            fetchAndRenderSuppliers(initialQuery);
        }
    });

    // Tambahkan konfirmasi hapus + cegah submit ganda
    function bindDeleteConfirm() {
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            form.onsubmit = function(e) {
                const confirmed = confirm('Yakin ingin menghapus data ini?');
                if (!confirmed) {
                    e.preventDefault();
                    return false;
                }

                const btn = form.querySelector('button[type="submit"]');
                if (btn) {
                    btn.disabled = true;
                    btn.innerText = 'Memproses...';
                }
                return true;
            };
        });
    }

    // Panggil bind saat halaman pertama kali dimuat
    bindDeleteConfirm();
</script>
@endsection