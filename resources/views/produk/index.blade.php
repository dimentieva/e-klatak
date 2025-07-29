@extends('layouts.navbar')

@section('title', 'Kelola Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-teal-600">Kelola Produk</h2>
    <div class="flex gap-2">
        <a href="{{ route('produk.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md font-semibold">+ Tambah</a>
        <a href="{{ route('categories.index') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md font-semibold">Kategori</a>
    </div>
</div>

{{-- Search --}}
<div class="mb-4">
    <input type="text" id="searchInput" placeholder="Cari produk..." class="w-full md:w-64 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
</div>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="overflow-x-auto bg-white p-4 rounded shadow">
    <table class="w-full text-sm text-left text-gray-600 border">
        <thead class="bg-[#0BB4B2] text-white text-xs uppercase text-center">
            <tr>
                <th class="px-3 py-2 border">No</th>
                <th class="px-3 py-2 border">Barcode</th>
                <th class="px-3 py-2 border">Nama Produk</th>
                <th class="px-3 py-2 border">Kategori</th>
                <th class="px-3 py-2 border">Supplier</th>
                <th class="px-3 py-2 border">Harga Jual</th>
                <th class="px-3 py-2 border">Harga Beli</th>
                <th class="px-3 py-2 border">Stok</th>
                <th class="px-3 py-2 border">Status</th>
                <th class="px-3 py-2 border">Foto</th>
                <th class="px-3 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody id="produkBody">
            @foreach($produks as $index => $produk)
            <tr class="border-b text-center">
                <td class="px-3 py-2 border">{{ $produks->firstItem() + $index }}</td>
                <td class="px-3 py-2 border">{{ $produk->nomor_barcode }}</td>
                <td class="px-3 py-2 border">{{ $produk->nama_produk }}</td>
                <td class="px-3 py-2 border">{{ $produk->category->name ?? '-' }}</td>
                <td class="px-3 py-2 border">{{ $produk->supplier->nama_supp ?? '-' }}</td>
                <td class="px-3 py-2 border">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                <td class="px-3 py-2 border">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                <td class="px-3 py-2 border">{{ $produk->stok }}</td>
                <td class="px-3 py-2 border capitalize">{{ $produk->status }}</td>
                <td class="px-3 py-2 border">
                    @if($produk->foto)
                    <img src="{{ asset('storage/foto_produk/'.$produk->foto) }}" class="w-14 h-14 object-cover rounded" alt="foto">
                    @else
                    <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-3 py-2 border">
                    <div class="flex flex-wrap gap-2 justify-center">
                        <a href="{{ route('produk.edit', $produk->id_produk) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                        <a href="{{ route('produk.kelola_stok', $produk->id_produk) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Stok</a>
                        <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST" class="inline-block form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4" id="pagination">
        {{ $produks->links('pagination::tailwind') }}
    </div>
</div>

{{-- JavaScript --}}
<script>
    const produkBody = document.getElementById('produkBody');
    const pagination = document.getElementById('pagination');
    const searchInput = document.getElementById('searchInput');
    const searchUrl = '{{ route("produk.search") }}';

    function debounce(func, delay = 300) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    const fetchAndRenderProduk = async (query) => {
        try {
            const response = await fetch(`${searchUrl}?search=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const produks = await response.json();
            produkBody.innerHTML = '';
            pagination.innerHTML = '';

            if (produks.length === 0) {
                produkBody.innerHTML = `<tr><td colspan="11" class="text-center px-3 py-4 text-gray-500">Tidak ada produk ditemukan.</td></tr>`;
                return;
            }

            produks.forEach((produk, index) => {
                produkBody.innerHTML += `
                    <tr class="border-b text-center">
                        <td class="px-3 py-2 border">${index + 1}</td>
                        <td class="px-3 py-2 border">${produk.nomor_barcode}</td>
                        <td class="px-3 py-2 border">${produk.nama_produk}</td>
                        <td class="px-3 py-2 border">${produk.category ? produk.category.name : '-'}</td>
                        <td class="px-3 py-2 border">${produk.supplier ? produk.supplier.nama_supp : '-'}</td>
                        <td class="px-3 py-2 border">Rp ${parseInt(produk.harga_jual).toLocaleString('id-ID')}</td>
                        <td class="px-3 py-2 border">Rp ${parseInt(produk.harga_beli).toLocaleString('id-ID')}</td>
                        <td class="px-3 py-2 border">${produk.stok}</td>
                        <td class="px-3 py-2 border">${produk.status}</td>
                        <td class="px-3 py-2 border">
                            ${produk.foto ? `<img src="/storage/foto_produk/${produk.foto}" class="w-14 h-14 object-cover rounded">` : '<span class="text-gray-400">-</span>'}
                        </td>
                        <td class="px-3 py-2 border">
                            <div class="flex flex-wrap gap-2 justify-center">
                                <a href="/produk/${produk.id_produk}/edit" class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                                <a href="/produk/${produk.id_produk}/kelola-stok" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Stok</a>
                                <form action="/produk/${produk.id_produk}" method="POST" class="inline-block form-delete" onsubmit="return confirmDelete(event, this)">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            console.error('Gagal memuat data produk:', error);
            produkBody.innerHTML = '<tr><td colspan="11" class="text-center px-3 py-4 text-red-500">Gagal memuat data.</td></tr>';
        }
    };

    searchInput.addEventListener('input', debounce((e) => {
        const query = e.target.value.trim();
        fetchAndRenderProduk(query);
    }));

    function confirmDelete(event, form) {
        const confirmed = confirm('Yakin ingin menghapus produk ini?');
        if (!confirmed) {
            event.preventDefault();
            return false;
        }

        const button = form.querySelector('button');
        if (button) {
            button.disabled = true;
            button.innerText = 'Menghapus...';
        }
        return true;
    }
</script>
@endsection
