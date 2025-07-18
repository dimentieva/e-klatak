@extends('layouts.navbar')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h2 class="text-3xl font-bold mb-6 text-[#0BB4B2] text-center">Edit Profil</h2>

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0BB4B2] shadow-sm transition duration-150">
        </div>

        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0BB4B2] shadow-sm transition duration-150">
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ url()->previous() }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition duration-150">
                Batal
            </a>
            <button type="submit"
                class="bg-[#0BB4B2] hover:bg-teal-700 text-white font-semibold px-5 py-2 rounded-lg transition duration-150 shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
