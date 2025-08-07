<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'E-KLATAK')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom scrollbar for main content */
        .custom-scroll::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background-color: transparent;
        }
        
        /* Height calculation for content */
        .content-height {
            height: calc(100vh - 64px);
        }
        
        /* Smooth transitions */
        .smooth-transition {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans min-h-screen overflow-hidden">

<div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

    <!-- Sidebar - Fixed Position -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-30 inset-y-0 left-0 w-64 bg-[#0BB4B2] text-white transform transition-transform duration-200 ease-in-out
               md:translate-x-0 md:static md:inset-0 flex flex-col border-r border-gray-200">
        
        <!-- Flex container untuk sidebar -->
        <div class="flex flex-col h-full">
            <!-- Logo Section -->
            <div class="flex items-center space-x-2 p-4 border-b border-white/20">
                <img src="{{ asset('assets/eklatak.png') }}" alt="Logo" class="w-14 h-14 rounded-full" />
                <h1 class="text-xl font-bold">E-KLATAK</h1>
            </div>

            <!-- Navigation - Scrollable Content -->
            <div class="flex-1 overflow-y-auto py-2 sidebar-scroll">
                <nav class="space-y-1 px-2">
                    <a href="{{ route('dashboard.admin') }}"
                       class="flex items-center space-x-3 px-3 py-3 rounded-md smooth-transition
                              {{ Route::is('dashboard.admin') ? 'bg-white text-[#0bb4b2] font-semibold' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 1.293a1 1 0 00-1.414 0L2 8.586V18a1 1 0 001 1h5a1 1 0 001-1V13h2v5a1 1 0 001 1h5a1 1 0 001-1V8.586l-7.293-7.293z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <p class="mt-4 px-4 text-xs text-white uppercase tracking-wider">Karyawan</p>
                    <a href="{{ route('karyawan.index') }}"
                       class="flex items-center space-x-3 px-3 py-3 rounded-md smooth-transition
                              {{ Route::is('karyawan.*') ? 'bg-white text-[#0bb4b2] font-semibold' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 4a2 2 0 100 4 2 2 0 000-4zM2 16a6 6 0 1112 0H2zM16 8a2 2 0 11-4 0 2 2 0 014 0zm0 8h-3.5a8.03 8.03 0 00-.5-2.5 6.97 6.97 0 011.5-1.5c.5.5 1.5 1.5 2.5 4z" />
                        </svg>
                        <span>Kelola Akun</span>
                    </a>

                    <p class="mt-4 px-4 text-xs text-white uppercase tracking-wider">Supplier</p>
                    <a href="{{ route('supplier.index') }}"
                       class="flex items-center space-x-3 px-3 py-3 rounded-md smooth-transition
                              {{ Route::is('supplier.*') ? 'bg-white text-[#0bb4b2] font-semibold' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 4a1 1 0 011-1h3a1 1 0 011 1v4H3V4zM3 9h6v6H3V9zm0 7h6v4a1 1 0 01-1 1H4a1 1 0 01-1-1v-4zm7 0h11v4a1 1 0 01-1 1h-9a1 1 0 01-1-1v-4zm0-7h11v6H10V9zm0-5a1 1 0 011-1h9a1 1 0 011 1v4H10V4z" />
                        </svg>
                        <span>Kelola Supplier</span>
                    </a>

                    <p class="mt-4 px-4 text-xs text-white uppercase tracking-wider">Produk</p>
                    <a href="{{ route('produk.index') }}"
                       class="flex items-center space-x-3 px-3 py-3 rounded-md smooth-transition
                              {{ Route::is('produk.*') ? 'bg-white text-[#0bb4b2] font-semibold' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 3a2 2 0 00-2 2v3a2 2 0 001 1.732V14a2 2 0 002 2h2a2 2 0 002-2v-4.268A2 2 0 0010 8V5a2 2 0 00-2-2H4zM8 5v3H4V5h4zM18 8h-4V5h4v3zM18 10a2 2 0 01-1 1.732V14a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4.268A2 2 0 0112 10V5a2 2 0 012-2h2a2 2 0 012 2v5z" />
                        </svg>
                        <span>Kelola Produk</span>
                    </a>

                    <p class="mt-4 px-4 text-xs text-white uppercase tracking-wider">Laporan</p>
                    <a href="{{ route('laporan.index') }}"
                       class="flex items-center space-x-3 px-3 py-3 rounded-md smooth-transition
                              {{ Route::is('laporan.*') ? 'bg-white text-[#0bb4b2] font-semibold' : 'hover:bg-white hover:text-[#0bb4b2]' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 17v-6a2 2 0 00-2-2H5m0 8h2a2 2 0 002-2v-6a2 2 0 012-2h2m0 8h2a2 2 0 002-2v-4a2 2 0 00-2-2h-2" />
                        </svg>
                        <span>Laporan</span>
                    </a>
                </nav>
            </div>

            <!-- Logout Button - Fixed Position -->
            <div class="p-4 border-t border-white/20 bg-[#0BB4B2] sticky bottom-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full text-center bg-[#F8CF63] hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-md transition duration-200 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Overlay (mobile) -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 bg-black bg-opacity-40 z-20 md:hidden"></div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Mobile Header -->
        <header class="w-full bg-white shadow-sm p-4 flex items-center justify-between md:hidden z-10">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="w-6"></div> <!-- Spacer for alignment -->
        </header>

        <!-- Scrollable Content -->
        <main class="flex-1 overflow-y-auto custom-scroll bg-gray-50 p-4 md:p-6">
            {{-- Notifikasi Stok Menipis --}}
            @if(auth()->check() && auth()->user()->role === 'admin' && isset($produkMenipis) && $produkMenipis->count())
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded shadow-sm">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <strong class="text-sm">Stok Menipis:</strong>
                    </div>
                    <ul class="list-disc ml-5 mt-1 text-sm">
                        @foreach($produkMenipis as $produk)
                            <li>{{ $produk->nama_produk }} (Stok: {{ $produk->stok }})</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>