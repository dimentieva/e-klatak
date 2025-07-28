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
                <tr class="border-b">
                    <td class="px-3 py-2 border">{{ $suppliers->firstItem() + $index }}</td>
                    <td class="px-3 py-2 border">{{ $supplier->nama_supp }}</td>
                    <td class="px-3 py-2 border">{{ $supplier->kontak }}</td>
                    <td class="px-3 py-2 border">{{ $supplier->alamat }}</td>
                    <td class="px-3 py-2 border space-x-2">
                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST"
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
    // Pencarian AJAX
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value;

        fetch(`/supplier?search=${encodeURIComponent(keyword)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('supplierBody');
            tbody.innerHTML = '';

            if (data.length > 0) {
                data.forEach((supplier, index) => {
                    const row = `
                        <tr class="border-b">
                            <td class="px-3 py-2 border">${index + 1}</td>
                            <td class="px-3 py-2 border">${supplier.nama_supp}</td>
                            <td class="px-3 py-2 border">${supplier.kontak}</td>
                            <td class="px-3 py-2 border">${supplier.alamat}</td>
                            <td class="px-3 py-2 border space-x-2">
                                <a href="/supplier/${supplier.id}/edit"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                                <form action="/supplier/${supplier.id}" method="POST"
                                      class="inline-block form-delete">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

                bindDeleteConfirm(); // bind ulang event konfirmasi
            } else {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center px-3 py-4 text-gray-500">Tidak ada data supplier.</td></tr>`;
            }
        });
    });

    // Tambahkan konfirmasi hapus + cegah submit ganda
    function bindDeleteConfirm() {
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            form.onsubmit = function (e) {
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
