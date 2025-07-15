<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Karyawan - E-KLATAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#0BB4B2] text-white flex flex-col p-4 justify-between">
            <div>
                <div class="flex items-center space-x-2 mb-6">
                    <img src="{{ asset('assets/eklatak.png') }}" alt="Logo" class="w-14 h-14 rounded-full" />
                    <h1 class="text-xl font-bold">E-KLATAK</h1>
                </div>
                <nav class="space-y-3">
                    <a href="{{ route('dashboard.admin') }}"
                        class="flex items-center space-x-2 px-3 py-2 hover:bg-[#6DCDE1] rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10.707 1.293a1 1 0 00-1.414 0L2 8.586V18a1 1 0 001 1h5a1 1 0 001-1V13h2v5a1 1 0 001 1h5a1 1 0 001-1V8.586l-7.293-7.293z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <p class="mt-4 text-sm text-white uppercase">Karyawan</p>
                    <a href="{{ route('karyawan.index') }}"
                        class="flex items-center space-x-2 px-3 py-2 bg-[#6DCDE1] rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 4a2 2 0 100 4 2 2 0 000-4zM2 16a6 6 0 1112 0H2zM16 8a2 2 0 11-4 0 2 2 0 014 0zm0 8h-3.5a8.03 8.03 0 00-.5-2.5 6.97 6.97 0 011.5-1.5c.5.5 1.5 1.5 2.5 4z" />
                        </svg>
                        <span>Kelola Karyawan</span>
                    </a>

                    <p class="mt-4 text-sm text-white uppercase">Supplier</p>
                    <a href="{{ route('supplier.index') }}"
                        class="flex items-center space-x-2 px-3 py-2 hover:bg-[#6DCDE1] rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h3a1 1 0 011 1v4H3V4zM3 9h6v6H3V9zm0 7h6v4a1 1 0 01-1 1H4a1 1 0 01-1-1v-4zm7 0h11v4a1 1 0 01-1 1h-9a1 1 0 01-1-1v-4zm0-7h11v6H10V9zm0-5a1 1 0 011-1h9a1 1 0 011 1v4H10V4z" />
                        </svg>
                        <span>Kelola Supplier</span>
                    </a>
                </nav>
            </div>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit"
                    class="w-full text-center bg-[#F8CF63] hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-md">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-white overflow-y-auto">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-[#0BB4B2] mb-4">Edit Karyawan</h2>

                @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium">Username</label>
                        <input type="text" name="username" value="{{ old('username', $karyawan->username) }}"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email', $karyawan->email) }}"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">No HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full border px-3 py-2 rounded"
                            required>{{ old('alamat', $karyawan->alamat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Tanggal Bergabung</label>
                        <input type="date" name="tanggal_bergabung"
                            value="{{ old('tanggal_bergabung', $karyawan->tanggal_bergabung) }}"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('karyawan.index') }}" class="text-sm text-gray-600 hover:underline">←
                            Kembali</a>
                        <button type="submit"
                            class="bg-[#0BB4B2] hover:bg-teal-700 text-white px-4 py-2 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>