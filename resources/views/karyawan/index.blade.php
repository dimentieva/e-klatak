@extends('layouts.navbar')

@section('title', 'Kelola Akun')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-teal-600">Kelola Akun</h2>
    <a href="{{ route('karyawan.create') }}"
        class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md font-semibold">
        + Tambah
    </a>
</div>

<!-- Form Search -->
<div class="mb-4">
    <input type="text" id="searchInput" placeholder="Cari akun..."
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
                <th class="px-3 py-2 border">Nama</th>
                <th class="px-3 py-2 border">Email</th>
                <th class="px-3 py-2 border">Role</th>
                <th class="px-3 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody id="userBody">
            @forelse ($users as $index => $user)
            <tr class="border-b">
                <td class="px-3 py-2 border">{{ $users->firstItem() + $index }}</td>
                <td class="px-3 py-2 border">{{ $user->name }}</td>
                <td class="px-3 py-2 border">{{ $user->email }}</td>
                <td class="px-3 py-2 border capitalize">{{ $user->role }}</td>
                <td class="flex flex-col sm:flex-row sm:flex-wrap gap-1 justify-center items-center">
                    <a href="{{ route('karyawan.edit', $user->id) }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                    <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST"
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
                <td colspan="5" class="text-center px-3 py-4 text-gray-500">Tidak ada data akun.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links('pagination::tailwind') }}
    </div>
</div>

<!-- JavaScript -->
<script>
    const searchInput = document.getElementById('searchInput');
    const userBody = document.getElementById('userBody');
    const searchUrl = '/admin/api/karyawan/search';

    function debounce(func, delay = 300) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    const fetchAndRenderUsers = async (query) => {
        try {
            const response = await fetch(`${searchUrl}?search=${encodeURIComponent(query)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) throw new Error('Gagal ambil data');
            const users = await response.json();

            userBody.innerHTML = '';

            if (users.length > 0) {
                users.forEach((user, index) => {
                    const row = `
                        <tr class="border-b">
                            <td class="px-3 py-2 border">${index + 1}</td>
                            <td class="px-3 py-2 border">${user.name}</td>
                            <td class="px-3 py-2 border">${user.email}</td>
                            <td class="px-3 py-2 border capitalize">${user.role}</td>
                            <td class="flex flex-col sm:flex-row sm:flex-wrap gap-2 justify-center items-center">
                                <a href="${user.edit_url}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                                <form action="${user.delete_url}" method="POST" class="inline-block form-delete">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    userBody.insertAdjacentHTML('beforeend', row);
                });
                bindDeleteConfirm();
            } else {
                userBody.innerHTML = '<tr><td colspan="5" class="text-center px-3 py-4 text-gray-500">Tidak ada data akun.</td></tr>';
            }
        } catch (error) {
            userBody.innerHTML = '<tr><td colspan="5" class="text-center px-3 py-4 text-red-500">Gagal memuat data akun.</td></tr>';
        }
    };

    searchInput.addEventListener('input', debounce((event) => {
        const query = event.target.value.trim();
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('search', query);
        window.history.pushState({}, '', newUrl);
        fetchAndRenderUsers(query);
    }));

    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const initialQuery = urlParams.get('search') || '';
        if (initialQuery) {
            searchInput.value = initialQuery;
            fetchAndRenderUsers(initialQuery);
        }
        bindDeleteConfirm();
    });


    function bindDeleteConfirm() {
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            form.onsubmit = function(e) {
                if (!confirm('Yakin ingin menghapus akun ini?')) {
                    e.preventDefault();
                    return false;
                }
                const btn = form.querySelector('button[type="submit"]');
                if (btn) {
                    btn.disabled = true;
                    btn.innerText = 'Menghapus...';
                }
                return true;
            };
        });
    }
</script>
@endsection
