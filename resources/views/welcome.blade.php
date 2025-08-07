@extends('layouts.app')
@section('title', 'Pantai Klatak')

@section('content')
{{-- Modern Navbar --}}
<nav class="fixed w-full z-50 transition-all duration-500 bg-white/90 backdrop-blur-md shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-20">
      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center">
        <div class="flex items-center space-x-2">
          <img src="{{ asset('assets/eklatak.png') }}" alt="Logo Pantai Klatak" class="h-10 w-10">
          <span class="text-2xl font-bold bg-gradient-to-r from-[#0BB4B2] to-[#089c9a] bg-clip-text text-transparent">Pantai Klatak</span>
        </div>
      </div>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="#tentang" class="relative group text-gray-700 hover:text-[#0BB4B2] transition-colors duration-300 font-medium">
          Tentang
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0BB4B2] transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="#gallery" class="relative group text-gray-700 hover:text-[#0BB4B2] transition-colors duration-300 font-medium">
          Galeri
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0BB4B2] transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="#fasilitas" class="relative group text-gray-700 hover:text-[#0BB4B2] transition-colors duration-300 font-medium">
          Fasilitas
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0BB4B2] transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="#market" class="relative group text-gray-700 hover:text-[#0BB4B2] transition-colors duration-300 font-medium">
          Fresh Market
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0BB4B2] transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="{{ route('login') }}" class="ml-4 px-6 py-2 bg-gradient-to-r from-[#0BB4B2] to-[#089c9a] text-white rounded-full font-medium hover:shadow-lg transition-all duration-300 hover:from-[#089c9a] hover:to-[#0BB4B2] transform hover:-translate-y-0.5">
          Login
        </a>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center">
        <button class="mobile-menu-button p-2 rounded-md text-gray-700 hover:text-[#0BB4B2] focus:outline-none">
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div class="mobile-menu hidden md:hidden bg-white shadow-xl">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="#tentang" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#0BB4B2] hover:bg-gray-100">Tentang</a>
      <a href="#gallery" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#0BB4B2] hover:bg-gray-100">Galeri</a>
      <a href="#fasilitas" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#0BB4B2] hover:bg-gray-100">Fasilitas</a>
      <a href="#market" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#0BB4B2] hover:bg-gray-100">Fresh Market</a>
      <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-[#0BB4B2] to-[#089c9a] mt-2">Login</a>
    </div>
  </div>
</nav>
{{-- Modern Hero Slider --}}
<section class="relative h-screen overflow-hidden">
  <div class="glide h-full">
    <div class="glide__track h-full" data-glide-el="track">
      <ul class="glide__slides h-full">
        <!-- Slide 1 -->
        <li class="glide__slide h-full bg-cover bg-center relative flex items-center justify-center transition-all duration-1000 ease-in-out" style="background-image:url('{{ asset('assets/pantaiklatak.jpg') }}')">
          <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent transition-all duration-1000"></div>
          <div class="relative z-10 container mx-auto px-6 text-white">
            <div class="max-w-2xl">
              <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight animate-fadeInUp">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">Pantai Klatak</span>
              </h1>
              <p class="text-lg md:text-xl mb-10 leading-relaxed animate-fadeInUp delay-100 max-w-lg">
                Surga pesisir di Tulungagung dengan keindahan alam, kampung nelayan, fresh market, dan ragam produk olahan lokal yang menggoda selera.
              </p>
              <div class="flex flex-wrap gap-4 animate-fadeInUp delay-200">
                <a href="#tentang" class="px-8 py-3.5 bg-gradient-to-r from-[#0BB4B2] to-[#089c9a] text-white rounded-full font-medium hover:shadow-lg transition-all duration-300 hover:from-[#089c9a] hover:to-[#0BB4B2] transform hover:-translate-y-0.5 flex items-center">
                  Jelajahi
                 </a>
                <a href="#gallery" class="px-8 py-3.5 border-2 border-white text-white rounded-full font-medium hover:bg-white/10 transition-all duration-300 flex items-center">
                  Galeri
                </a>
              </div>
            </div>
          </div>
        </li>
        
        <!-- Slide 2 -->
        <li class="glide__slide h-full bg-cover bg-center relative flex items-center justify-center transition-all duration-1000 ease-in-out" style="background-image:url('{{ asset('assets/klatak2.jpg') }}')">
          <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent transition-all duration-1000"></div>
          <div class="relative z-10 container mx-auto px-6 text-white">
            <div class="max-w-2xl">
              <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight animate-fadeInUp">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">Kampung Nelayan</span>
              </h1>
              <p class="text-lg md:text-xl mb-10 leading-relaxed animate-fadeInUp delay-100 max-w-lg">
                Menyaksikan langsung kehidupan nelayan tradisional dan hasil tangkapan laut segar setiap hari.
              </p>
              <div class="flex flex-wrap gap-4 animate-fadeInUp delay-200">
                <a href="#aktivitas" class="px-8 py-3.5 bg-gradient-to-r from-[#0BB4B2] to-[#089c9a] text-white rounded-full font-medium hover:shadow-lg transition-all duration-300 hover:from-[#089c9a] hover:to-[#0BB4B2] transform hover:-translate-y-0.5 flex items-center">
                  Aktivitas
                </a>
              </div>
            </div>
          </div>
        </li>
        
        <!-- Slide 3 -->
        <li class="glide__slide h-full bg-cover bg-center relative flex items-center justify-center transition-all duration-1000 ease-in-out" style="background-image:url('{{ asset('assets/freshmarket.jpg') }}')">
          <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent transition-all duration-1000"></div>
          <div class="relative z-10 container mx-auto px-6 text-white">
            <div class="max-w-2xl">
              <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight animate-fadeInUp">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">Fresh Market</span>
              </h1>
              <p class="text-lg md:text-xl mb-10 leading-relaxed animate-fadeInUp delay-100 max-w-lg">
                Nikmati hasil laut segar langsung dari nelayan lokal dan temukan aneka olahan khas di Fresh Market Pantai Klatak yang siap memanjakan lidah Anda.
              </p>
              <div class="flex flex-wrap gap-4 animate-fadeInUp delay-200">
                <a href="#market" class="px-8 py-3.5 bg-gradient-to-r from-[#0BB4B2] to-[#089c9a] text-white rounded-full font-medium hover:shadow-lg transition-all duration-300 hover:from-[#089c9a] hover:to-[#0BB4B2] transform hover:-translate-y-0.5 flex items-center">
                  Jelajahi Market
                </a>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    
    <!-- Navigation Arrows -->
    <div class="glide__arrows absolute w-full top-1/2 transform -translate-y-1/2 z-20 px-4" data-glide-el="controls">
      <button class="glide__arrow glide__arrow--left absolute left-4 bg-white/20 hover:bg-white/40 backdrop-blur-sm rounded-full p-3 transition-all duration-300 shadow-lg" data-glide-dir="<">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button class="glide__arrow glide__arrow--right absolute right-4 bg-white/20 hover:bg-white/40 backdrop-blur-sm rounded-full p-3 transition-all duration-300 shadow-lg" data-glide-dir=">">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
    
    <!-- Bullet Indicators -->
    <div class="glide__bullets absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20" data-glide-el="controls[nav]">
      <button class="glide__bullet w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-glide-dir="=0"></button>
      <button class="glide__bullet w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-glide-dir="=1"></button>
      <button class="glide__bullet w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-glide-dir="=2"></button>
    </div>
  </div>
</section>

{{-- Tentang --}}
<section id="tentang" class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
    <div class="relative group">
      <img src="{{ asset('assets/pantai-klatak.jpg') }}" alt="Pantai" class="rounded-xl shadow-2xl transform group-hover:scale-105 transition duration-500">
      <div class="absolute -inset-4 border-2 border-[#0BB4B2]/30 rounded-xl pointer-events-none transform group-hover:scale-105 transition duration-500"></div>
    </div>
    <div>
      <h2 class="text-3xl font-bold text-[#0BB4B2] mb-6">Tentang Pantai Klatak</h2>
      <p class="text-gray-700 mb-4 leading-relaxed" style="text-align: justify;">
        Pantai Klatak terletak di Desa Keboireng, Kecamatan Besuki, Kabupaten Tulungagung, Jawa Timur. Pantai ini menyuguhkan pesona alam yang memikat dengan pasir hitam yang eksotis, ombak yang tenang, dan suasana khas pesisir selatan.
      </p>
      <p class="text-gray-700 mb-6 leading-relaxed" style="text-align: justify;">
        Lebih dari sekadar destinasi wisata, Pantai Klatak memberikan pengalaman yang unik melalui kampung nelayan yang ramah dan hangat. Wisatawan bisa menyaksikan aktivitas para nelayan melaut, melihat perahu-perahu tradisional yang berlabuh, hingga menikmati langsung hasil tangkapan segar serta  beragam produk olahan laut khas Pantai Klatak di fresh market yang dikelola oleh warga setempat.
      </p>
      <div class="flex flex-wrap gap-3">
        <span class="bg-[#0BB4B2]/10 text-[#0BB4B2] px-4 py-2 rounded-full">Pasir Hitam</span>
        <span class="bg-[#0BB4B2]/10 text-[#0BB4B2] px-4 py-2 rounded-full">Kampung Nelayan</span>
        <span class="bg-[#0BB4B2]/10 text-[#0BB4B2] px-4 py-2 rounded-full">Sunset Indah</span>
        <span class="bg-[#0BB4B2]/10 text-[#0BB4B2] px-4 py-2 rounded-full">Fresh Market</span>
      </div>
    </div>
  </div>
</section>

{{-- Fasilitas --}}
<section id="fasilitas" class="bg-gray-50 py-20">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-bold text-[#0BB4B2] mb-3">Fasilitas Unggulan</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai fasilitas untuk kenyamanan pengunjung</p>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 text-center">
        <div class="bg-[#0BB4B2]/10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#0BB4B2] mb-3">Toilet Bersih</h3>
        <p class="text-gray-600">Toilet yang selalu terjaga kebersihannya untuk kenyamanan pengunjung</p>
      </div>
      
      <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 text-center">
        <div class="bg-[#0BB4B2]/10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#0BB4B2] mb-3">Warung Makan</h3>
        <p class="text-gray-600">Berbagai kuliner khas pantai dengan harga terjangkau</p>
      </div>
      
      <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 text-center">
        <div class="bg-[#0BB4B2]/10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#0BB4B2] mb-3">Spot Foto</h3>
        <p class="text-gray-600">Berbagai spot instagramable dengan pemandangan laut yang indah</p>
      </div>
    </div>

     <div class="grid md:grid-cols-3 gap-8 mt-8">
      <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 text-center">
        <div class="bg-[#0BB4B2]/10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1.5-4.5A2 2 0 016.4 7h11.2a2 2 0 011.9 1.5L21 13v4a1 1 0 01-1 1h-1a2 2 0 11-4 0H9a2 2 0 11-4 0H4a1 1 0 01-1-1v-4zM5 16h.01M19 16h.01" />
        </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#0BB4B2] mb-3">Parkir Luas</h3>
        <p class="text-gray-600">Halaman parkir yang luas dan aman untuk kenyamanan pengunjung</p>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 text-center">
        <div class="bg-[#0BB4B2]/10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0BB4B2]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a1 1 0 011-1h1a2 2 0 014 0h6a2 2 0 014 0h1a1 1 0 011 1v6a1 1 0 01-1 1h-1a2 2 0 01-4 0H9a2 2 0 01-4 0H4a1 1 0 01-1-1V9z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8" />
        </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#0BB4B2] mb-3">Tiket Masuk Gratis</h3>
        <p class="text-gray-600">Anda tidak dikenakan tiket masuk. Nikmati keindahan pantai secara gratis, terbuka untuk umum setiap hari!</p>
      </div>
      
      <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 text-center">
        <div class="bg-[#0BB4B2]/10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#0BB4B2] mb-3">Fresh Market</h3>
        <p class="text-gray-600">Tersedia berbagai oalahan hasil laut segar, jajanan tradisional, hingga oleh-oleh khas lokal.</p>
      </div>
    </div>
    </div>
  </div>
</section>

{{-- Fresh Market Section --}}
<section id="market" class="py-20 bg-[#f8f9fa]">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-[#0BB4B2] mb-4">Fresh Market Pantai Klatak</h2>
      <div class="w-24 h-1 bg-[#0BB4B2] mx-auto mb-6"></div>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">Hasil Olahan yang dikelola oleh BUM Desa Karyaw</p>
    </div>

    <div class="grid md:grid-cols-2 gap-10 items-start">
      {{-- Market Info --}}
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
          <div class="flex items-center mb-6">
            <div class="bg-[#0BB4B2]/10 p-3 rounded-full mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-800">Jam Operasional</h3>
              <p class="text-gray-600">Waktu terbaik untuk berbelanja</p>
            </div>
          </div>
          
          <div class="space-y-4 pl-16">
            <div class="flex items-center bg-[#0BB4B2]/5 p-4 rounded-lg">
              <div class="bg-white p-2 rounded-lg shadow-sm mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800">Senin - Jumat</h4>
                <p class="text-gray-600">05.00 - 17.00 WIB</p>
              </div>
            </div>
            
            <div class="flex items-center bg-[#0BB4B2]/5 p-4 rounded-lg">
              <div class="bg-white p-2 rounded-lg shadow-sm mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800">Weekend & Libur</h4>
                <p class="text-gray-600">04.00 - 18.00 WIB</p>
              </div>
            </div>
          </div>

          {{-- Consolidated Market Information --}}
          <div class="mt-8 pl-16">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pasar</h4>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0BB4B2] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span class="text-gray-600">Produk Segar</span>
              </div>
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0BB4B2] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span class="text-gray-600">Tunai/Non Tunai</span>
              </div>
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0BB4B2] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                </svg>
                <span class="text-gray-600">Parkir Luas</span>
              </div>
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0BB4B2] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="text-gray-600">Toilet Bersih</span>
              </div>
            </div>

            
          </div>
        </div>
      </div>

      {{-- Product Gallery --}}
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
          <div class="flex items-center mb-6">
            <div class="bg-[#0BB4B2]/10 p-3 rounded-full mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#0BB4B2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-800">Produk Unggulan</h3>
              <p class="text-gray-600">Hasil laut segar pilihan</p>
            </div>
          </div>
          
          <div class="grid grid-cols-2 gap-4">
            {{-- Product 1 --}}
            <div class="group relative overflow-hidden rounded-lg h-40">
              <img src="{{ asset('assets/market/ikan-tongkol.jpg') }}" alt="Ikan Tongkol" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
                  <h4 class="font-bold">Ikan Tongkol</h4>
                  <p class="text-sm">Rp35.000/kg</p>
                </div>
              </div>
            </div>
            
            {{-- Product 2 --}}
            <div class="group relative overflow-hidden rounded-lg h-40">
              <img src="{{ asset('assets/market/cumi.jpg') }}" alt="Cumi-Cumi" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
                  <h4 class="font-bold">Cumi-Cumi</h4>
                  <p class="text-sm">Rp65.000/kg</p>
                </div>
              </div>
            </div>
            
            {{-- Product 3 --}}
            <div class="group relative overflow-hidden rounded-lg h-40">
              <img src="{{ asset('assets/market/udang.jpg') }}" alt="Udang Vaname" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
                  <h4 class="font-bold">Udang Vaname</h4>
                  <p class="text-sm">Rp75.000/kg</p>
                </div>
              </div>
            </div>
            
            {{-- Product 4 --}}
            <div class="group relative overflow-hidden rounded-lg h-40">
              <img src="{{ asset('assets/market/kerang.jpg') }}" alt="Kerang Hijau" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
                  <h4 class="font-bold">Kerang Hijau</h4>
                  <p class="text-sm">Rp25.000/kg</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="mt-6 text-center">
            <button class="px-6 py-2 bg-[#0BB4B2] text-white rounded-full hover:bg-[#089c9a] transition duration-300 font-medium flex items-center mx-auto">
              Lihat Semua Produk
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Gallery Section --}}
<section id="gallery" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-[#0BB4B2] mb-4">Galeri Pantai Klatak</h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">Kumpulan momen indah di Pantai Klatak yang akan membuat Anda jatuh cinta</p>
    </div>

    {{-- Gallery Filter --}}
    <div class="flex flex-wrap justify-center gap-3 mb-12">
      <button class="gallery-filter px-6 py-2 rounded-full bg-[#0BB4B2] text-white font-medium" data-filter="all">Semua</button>
      <button class="gallery-filter px-6 py-2 rounded-full bg-gray-200 hover:bg-[#0BB4B2] hover:text-white transition font-medium" data-filter="pantai">Pemandangan</button>
      <button class="gallery-filter px-6 py-2 rounded-full bg-gray-200 hover:bg-[#0BB4B2] hover:text-white transition font-medium" data-filter="aktivitas">Aktivitas</button>
      <button class="gallery-filter px-6 py-2 rounded-full bg-gray-200 hover:bg-[#0BB4B2] hover:text-white transition font-medium" data-filter="fasilitas">Fasilitas</button>
    </div>

    {{-- Gallery Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 gallery-container">
      {{-- Item 1 --}}
      <div class="gallery-item pantai" data-category="pantai">
        <div class="relative overflow-hidden rounded-xl shadow-lg group h-80">
          <img src="{{ asset('assets/gallery/pantai1.jpg') }}" alt="Pemandangan Pantai Klatak" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
            <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
              <h3 class="text-xl font-bold mb-2">Sunset di Pantai Klatak</h3>
              <p class="text-sm">Momen matahari terbenam yang memukau</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Item 2 --}}
      <div class="gallery-item pantai" data-category="pantai">
        <div class="relative overflow-hidden rounded-xl shadow-lg group h-80">
          <img src="{{ asset('assets/gallery/pantai2.jpg') }}" alt="Pasir Hitam Pantai Klatak" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
            <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
              <h3 class="text-xl font-bold mb-2">Pasir Hitam Eksotis</h3>
              <p class="text-sm">Keunikan pasir vulkanik Pantai Klatak</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Item 3 --}}
      <div class="gallery-item aktivitas" data-category="aktivitas">
        <div class="relative overflow-hidden rounded-xl shadow-lg group h-80">
          <img src="{{ asset('assets/gallery/aktivitas1.jpg') }}" alt="Berenang di Pantai Klatak" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
            <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
              <h3 class="text-xl font-bold mb-2">Berenang Santai</h3>
              <p class="text-sm">Nikmati ombak tenang Pantai Klatak</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Item 4 --}}
      <div class="gallery-item aktivitas" data-category="aktivitas">
        <div class="relative overflow-hidden rounded-xl shadow-lg group h-80">
          <img src="{{ asset('assets/gallery/aktivitas2.jpg') }}" alt="Foto di Pantai Klatak" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
            <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
              <h3 class="text-xl font-bold mb-2">Spot Foto Instagramable</h3>
              <p class="text-sm">Abadikan momen terbaik Anda</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Item 5 --}}
      <div class="gallery-item fasilitas" data-category="fasilitas">
        <div class="relative overflow-hidden rounded-xl shadow-lg group h-80">
          <img src="{{ asset('assets/gallery/fasilitas1.jpg') }}" alt="Warung Makan Pantai Klatak" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
            <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
              <h3 class="text-xl font-bold mb-2">Kuliner Pantai</h3>
              <p class="text-sm">Nikmati hidangan laut segar</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Item 6 --}}
      <div class="gallery-item fasilitas" data-category="fasilitas">
        <div class="relative overflow-hidden rounded-xl shadow-lg group h-80">
          <img src="{{ asset('assets/gallery/fasilitas2.jpg') }}" alt="Area Parkir Pantai Klatak" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
            <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
              <h3 class="text-xl font-bold mb-2">Area Parkir Luas</h3>
              <p class="text-sm">Parkir aman untuk kendaraan Anda</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- View More Button --}}
    <div class="text-center mt-12">
      <button class="px-8 py-3 bg-transparent border-2 border-[#0BB4B2] text-[#0BB4B2] rounded-full hover:bg-[#0BB4B2] hover:text-white transition duration-300 font-medium">
        Lihat Lebih Banyak Foto
      </button>
    </div>
  </div>
</section>

{{-- Lightbox Modal --}}
<div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
  <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white text-4xl z-10 hover:text-[#0BB4B2] transition">
    &times;
  </button>
  
  <div class="relative w-full max-w-6xl h-full max-h-[90vh]">
    <img id="lightbox-img" src="" alt="" class="w-full h-full object-contain">
    
    <div class="absolute bottom-6 left-0 right-0 text-center text-white">
      <h3 id="lightbox-title" class="text-xl font-bold"></h3>
      <p id="lightbox-desc" class="text-sm"></p>
    </div>
  </div>
</div>

<style>
  .gallery-item {
    transition: all 0.3s ease;
  }
  
  .gallery-item.hidden {
    display: none;
  }
</style>

<script>
  // Gallery Filter Functionality
  document.querySelectorAll('.gallery-filter').forEach(button => {
    button.addEventListener('click', function() {
      // Update active button
      document.querySelectorAll('.gallery-filter').forEach(btn => {
        btn.classList.remove('bg-[#0BB4B2]', 'text-white');
        btn.classList.add('bg-gray-200');
      });
      this.classList.add('bg-[#0BB4B2]', 'text-white');
      this.classList.remove('bg-gray-200');
      
      // Filter items
      const filter = this.dataset.filter;
      const items = document.querySelectorAll('.gallery-item');
      
      items.forEach(item => {
        if (filter === 'all' || item.dataset.category === filter) {
          item.classList.remove('hidden');
        } else {
          item.classList.add('hidden');
        }
      });
    });
  });

  // Lightbox Functionality
  function openLightbox(imgSrc, title, desc) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDesc = document.getElementById('lightbox-desc');
    
    lightboxImg.src = imgSrc;
    lightboxTitle.textContent = title;
    lightboxDesc.textContent = desc;
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.body.style.overflow = 'auto';
  }

  // Initialize gallery items to open lightbox when clicked
  document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', function() {
      const imgSrc = this.querySelector('img').src;
      const title = this.querySelector('h3')?.textContent || '';
      const desc = this.querySelector('p')?.textContent || '';
      openLightbox(imgSrc, title, desc);
    });
  });

  // Close lightbox when clicking outside image
  document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
      closeLightbox();
    }
  });

  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    if (!document.getElementById('lightbox').classList.contains('hidden')) {
      if (e.key === 'Escape') {
        closeLightbox();
      }
    }
  });
</script>

{{-- Peta Lokasi --}}
<section class="py-20 bg-gray-50">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-bold text-[#0BB4B2] mb-3">Lokasi Pantai Klatak</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">Desa Besole, Kecamatan Besuki, Kabupaten Tulungagung, Jawa Timur</p>
    </div>
    <div class="rounded-xl overflow-hidden shadow-2xl">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.326292156196!2d111.90222227601848!3d-8.144990481990619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78c3f847deb1e5%3A0x5b4a7a7e9f4a8b0a!2sPantai%20Klatak!5e0!3m2!1sen!2sid!4v1712345678901!5m2!1sen!2sid" 
        width="100%" 
        height="450" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        class="w-full h-96 border-0">
      </iframe>
    </div>
    <div class="mt-8 text-center">
      <a 
        href="https://maps.app.goo.gl/FdX3y3AsnofYuctx5" 
        target="_blank" 
        rel="noopener noreferrer"
        class="inline-flex items-center px-6 py-3 bg-[#0BB4B2] text-white rounded-full hover:bg-[#089c9a] transition duration-300 shadow-md hover:shadow-lg"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Buka di Google Maps
      </a>
    </div>
  </div>
</section>

{{-- Goa Glogok --}}
<section class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6">

    {{-- Judul & Deskripsi --}}
    <div class="text-center mb-16">
      <h2 class="text-3xl font-bold text-[#0BB4B2] mb-3">Eksplorasi Goa Glogok</h2>
          {{-- Gambar Goa --}}
<div class="mb-8 text-center">
  <img 
    src="{{ asset('assets/goa-glogok.jpg') }}" 
    alt="Goa Glogok" 
    class="w-[200px] h-[200px] object-cover rounded-xl shadow-md mx-auto"
  >
</div>

      <p class="text-gray-600 max-w-2xl mx-auto">
        Goa Glogok adalah salah satu destinasi alam tersembunyi yang berada di kawasan Pantai Klatak, Tulungagung. Tempat ini menawarkan pengalaman berwisata yang berbeda dengan suasana goa alami yang sejuk dan penuh keindahan alam.
      </p>
    </div>

    {{-- Tiga Kolom Informasi --}}
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-gray-700">
        <h3 class="text-xl font-semibold mb-4">Keunikan Goa</h3>
        <p>
          Goa Glogok memiliki formasi batuan alami yang eksotis serta suara tetesan air yang menciptakan suasana hening dan damai. Cocok untuk wisatawan yang menyukai ketenangan dan eksplorasi alam.
        </p>
      </div>
      <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-gray-700">
        <h3 class="text-xl font-semibold mb-4">Akses dan Lokasi</h3>
        <p>
          Goa ini dapat diakses dengan berjalan kaki dari area utama Pantai Klatak. Perjalanan menuju goa melewati jalur alami yang memberikan sensasi petualangan tersendiri bagi para pengunjung.
        </p>
      </div>
      <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-gray-700">
        <h3 class="text-xl font-semibold mb-4">Tips Berkunjung</h3>
        <p>
          Disarankan untuk membawa senter dan mengenakan alas kaki yang nyaman karena jalurnya cukup berbatu dan lembap. Waktu terbaik untuk berkunjung adalah pagi atau sore hari saat cuaca tidak terlalu panas.
        </p>
      </div>
    </div>
  </div>
</section>



{{-- CTA --}}
<section class="py-16 bg-[#0BB4B2] text-white">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-6">Siap Mengunjungi Pantai Klatak?</h2>
    <p class="text-xl mb-8 max-w-2xl mx-auto">Pesan tiket Anda sekarang dan nikmati pengalaman liburan yang tak terlupakan</p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="#" class="px-8 py-4 bg-white text-[#0BB4B2] rounded-full font-semibold hover:bg-gray-100 transition duration-300 shadow-lg hover:shadow-xl">
        Pesan Tiket Sekarang
      </a>
      <a href="#kontak" class="px-8 py-4 border-2 border-white rounded-full font-semibold hover:bg-white/10 transition duration-300 shadow-lg hover:shadow-xl">
        Hubungi Kami
      </a>
    </div>
  </div>
</section>

{{-- Footer --}}
<footer class="bg-gray-900 text-white pt-16 pb-8">
  <div class="max-w-6xl mx-auto px-6">
    <div class="grid md:grid-cols-4 gap-8 mb-12">
      <div>
        <h3 class="text-xl font-bold text-[#0BB4B2] mb-4 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Pantai Klatak
        </h3>
        <p class="text-gray-400">Pesona pasir hitam eksotis & ombak tenang di Tulungagung/p>
        <div class="flex space-x-4 mt-4">
          <a href="#" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
            </svg>
          </a>
        </div>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
        <ul class="space-y-2">
          <li><a href="#tentang" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">Tentang</a></li>
          <li><a href="#gallery" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">Galeri</a></li>
          <li><a href="#fasilitas" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">Fasilitas</a></li>
          <li><a href="#harga" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">Harga Tiket</a></li>
          <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">Login</a></li>
        </ul>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Kontak Kami</h4>
        <ul class="space-y-2 text-gray-400">
          <li class="flex items-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Jalan Pantai Waru Doyong Klatak, Soireng, Keboireng, Kec. Besuki, Kabupaten Tulungagung, Jawa Timur 66275
          </li>
          <li class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            0812-XXXX-XXXX
          </li>
          <li class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            info@pantaiklatak.com
          </li>
        </ul>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Jam Operasional</h4>
        <div class="bg-gray-800/50 rounded-lg p-4">
          <div class="flex justify-between items-center mb-2">
            <span class="text-gray-400">Senin - Minggu</span>
            <span class="font-medium">06.00 - 18.00</span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
      <p>&copy; {{ date('Y') }} Pantai Klatak. All rights reserved.</p>
      <p class="mt-2 text-sm">Developed by PPK Ormawa Biro Sistem Informasi Udinus Kampus Kota Kediri</p>
    </div>
  </div>
</footer>
@endsection

<style>
  /* Navbar animation */
  nav {
    transition: all 0.5s ease;
  }
  
  nav.scrolled {
    @apply shadow-md bg-white/95;
  }
  
  /* Mobile menu animation */
  .mobile-menu {
    transition: all 0.3s ease;
    max-height: 0;
    overflow: hidden;
  }
  
  .mobile-menu.active {
    max-height: 500px;
  }
  
  /* Hero section animations */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .animate-fadeInUp {
    animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
  }
  
  .animate-fadeInUp.delay-100 {
    animation-delay: 0.2s;
  }
  
  .animate-fadeInUp.delay-200 {
    animation-delay: 0.4s;
  }
  
  /* Scroll indicator animation */
  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateY(0);
    }
    40% {
      transform: translateY(-20px);
    }
    60% {
      transform: translateY(-10px);
    }
  }
  
  .animate-bounce {
    animation: bounce 2s infinite;
  }
  
  @keyframes scroll {
    0% {
      transform: translateY(0);
      opacity: 1;
    }
    100% {
      transform: translateY(10px);
      opacity: 0;
    }
  }
  
  .animate-scroll {
    animation: scroll 1.5s infinite;
  }
  
  /* Glide slider styles */
  .glide__slide {
    opacity: 0.8;
    transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }
  
  .glide__slide.glide__slide--active {
    opacity: 1;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    mobileMenuButton.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
      mobileMenu.classList.toggle('active');
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.querySelector('nav').classList.add('scrolled');
      } else {
        document.querySelector('nav').classList.remove('scrolled');
      }
    });
    
    // Initialize Glide slider
    new Glide('.glide', {
      type: 'carousel',
      autoplay: 4000,
      hoverpause: true,
      animationDuration: 800,
      animationTimingFunc: 'cubic-bezier(0.4, 0, 0.2, 1)',
      rewind: true,
      gap: 0,
      perView: 1
    }).mount();
  });
</script>

