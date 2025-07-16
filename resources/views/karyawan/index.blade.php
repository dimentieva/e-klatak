@extends('layouts.navbar')

@section('title', 'Kelola Karyawan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-teal-600">Kelola Karyawan</h2>
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

    <div class="overflow-x-auto bg-gray-50 p-4 rounded shadow">
        <table class="w-full text-sm text-center text-gray-600 border">
            <thead class="bg-gray-200 text-xs uppercase">
                <tr>
                    <th class="px-3 py-2 border">No</th>
                    <th class="px-3 py-2 border">Username</th>
                    <th class="px-3 py-2 border">Email</th>
                    <th class="px-3 py-2 border">No HP</th>
                    <th class="px-3 py-2 border">Alamat</th>
                    <th class="px-3 py-2 border">Tanggal Bergabung</th>
                    <th class="px-3 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawans as $index => $row)
                    <tr class="border-b">
                        <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-3 py-2 border">{{ $row->username }}</td>
                        <td class="px-3 py-2 border">{{ $row->email }}</td>
                        <td class="px-3 py-2 border">{{ $row->no_hp }}</td>
                        <td class="px-3 py-2 border">{{ $row->alamat }}</td>
                        <td class="px-3 py-2 border">{{ $row->tanggal_bergabung }}</td>
                        <td class="px-3 py-2 border space-x-2">
                            <a href="{{ route('karyawan.edit', $row->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                            <form action="{{ route('karyawan.destroy', $row->id) }}" method="POST"
                                  class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <td colspan="7" class="text-center px-3 py-4 text-gray-500">Tidak ada data karyawan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection