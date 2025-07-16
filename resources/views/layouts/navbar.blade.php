<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'E-KLATAK')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#0BB4B2] text-white flex flex-col p-4 justify-between">
            <div>
                <!-- Logo -->
                <div class="flex items-center space-x-2 mb-6">
                    <img src="{{ asset('assets/eklatak.png') }}" alt="Logo" class="w-14 h-14 rounded-full" />
                    <h1 class="text-xl font-bold">E-KLATAK</h1>
                </div>

                <!-- Navigation -->
                <nav class="space-y-3">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-white hover:text-[#0bb4b2] {{ Route::is('dashboard.admin') ? 'bg-white text-[#0bb4b2] font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 1.293a1 1 0 00-1.414 0L2 8.586V18a1 1 0 001 1h5a1 1 0 001-1V13h2v5a1 1 0 001 1h5a1 1 0 001-1V8.586l-7.293-7.293z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Karyawan -->
                    <p class="mt-4 text-sm text-white uppercase">Karyawan</p>
                    <a href="{{ route('karyawan.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-white hover:text-[#0bb4b2] {{ Route::is('karyawan.*') ? 'bg-white text-[#0bb4b2] font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 4a2 2 0 100 4 2 2 0 000-4zM2 16a6 6 0 1112 0H2zM16 8a2 2 0 11-4 0 2 2 0 014 0zm0 8h-3.5a8.03 8.03 0 00-.5-2.5 6.97 6.97 0 011.5-1.5c.5.5 1.5 1.5 2.5 4z" />
                        </svg>
                        <span>Kelola Karyawan</span>
                    </a>

                    <!-- Supplier -->
                    <p class="mt-4 text-sm text-white uppercase">Supplier</p>
                    <a href="{{ route('supplier.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md {{ Route::is('supplier.*') ? 'bg-white text-[#0bb4b2] font-semibold' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v4H3V4zM3 9h6v6H3V9zm0 7h6v4a1 1 0 01-1 1H4a1 1 0 01-1-1v-4zm7 0h11v4a1 1 0 01-1 1h-9a1 1 0 01-1-1v-4zm0-7h11v6H10V9zm0-5a1 1 0 011-1h9a1 1 0 011 1v4H10V4z" />
                        </svg>
                        <span>Kelola Supplier</span>
                    </a>

                    <!-- Produk -->
                    <p class="mt-4 text-sm text-white uppercase">Produk</p>
                    <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-white hover:text-[#0bb4b2]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 00-2 2v3a2 2 0 001 1.732V14a2 2 0 002 2h2a2 2 0 002-2v-4.268A2 2 0 0010 8V5a2 2 0 00-2-2H4zM8 5v3H4V5h4zM18 8h-4V5h4v3zM18 10a2 2 0 01-1 1.732V14a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4.268A2 2 0 0112 10V5a2 2 0 012-2h2a2 2 0 012 2v5z" />
                        </svg>
                        <span>Kelola Produk</span>
                    </a>

                    <!-- Laporan -->
                    <p class="mt-4 text-sm text-white uppercase">Laporan</p>
                    <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-white hover:text-[#0bb4b2]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H5m0 8h2a2 2 0 002-2v-6a2 2 0 012-2h2m0 8h2a2 2 0 002-2v-4a2 2 0 00-2-2h-2" />
                        </svg>
                        <span>Laporan</span>
                    </a>
                </nav>
            </div>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full text-center bg-[#F8CF63] hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-md transition duration-200">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 bg-white overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
