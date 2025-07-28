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

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

{{-- Input Search --}}
<div class="mb-4">
    <input type="text" name="search" id="search" placeholder="Cari akun..."
        value="{{ request('search') }}"
        class="border border-gray-300 rounded px-4 py-2 w-full max-w-sm"
        oninput="searchUsers()" />
</div>

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
        <tbody>
            @forelse ($users as $index => $user)
            <tr class="border-b">
                <td class="px-3 py-2 border">{{ $users->firstItem() + $index }}</td>
                <td class="px-3 py-2 border">{{ $user->name }}</td>
                <td class="px-3 py-2 border">{{ $user->email }}</td>
                <td class="px-3 py-2 border capitalize">{{ $user->role }}</td>
                <td class="px-3 py-2 border space-x-2">
                    <a href="{{ route('karyawan.edit', $user->id) }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>

                    {{-- Form Hapus dengan proteksi double submit --}}
                    <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST"
                        class="inline-block"
                        onsubmit="return handleDelete(this, event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                            Hapus
                        </button>
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

    <div class="mt-4">
        {{ $users->withQueryString()->links() }}
    </div>
</div>

{{-- JavaScript --}}
<script>
    function searchUsers() {
        const search = document.getElementById('search').value;
        const params = new URLSearchParams(window.location.search);
        if (search) {
            params.set('search', search);
        } else {
            params.delete('search');
        }
        window.location.search = params.toString();
    }

    function handleDelete(form, event) {
        const confirmed = confirm('Yakin ingin menghapus akun ini?');
        if (!confirmed) return false;

        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.innerText = 'Menghapus...';

        return true;
    }
</script>
@endsection