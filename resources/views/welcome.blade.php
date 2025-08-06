@extends('layouts.app')
@section('title', 'Pantai Klatak')

@section('content')
{{-- Navbar --}}
<nav class="bg-white shadow-lg fixed w-full z-20 transition-all duration-300">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
    <div class="text-2xl font-bold text-[#0BB4B2] flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
      Pantai Klatak
    </div>
    <div class="space-x-6 hidden md:flex items-center">
      <a href="#tentang" class="hover:text-[#0BB4B2] transition-colors duration-200 font-medium">Tentang</a>
      <a href="#galeri" class="hover:text-[#0BB4B2] transition-colors duration-200 font-medium">Galeri</a>
      <a href="#fasilitas" class="hover:text-[#0BB4B2] transition-colors duration-200 font-medium">Fasilitas</a>
      <a href="#harga" class="hover:text-[#0BB4B2] transition-colors duration-200 font-medium">Harga</a>
      <a href="{{ route('login') }}" class="btn-primary px-4 py-2 rounded-full hover:bg-[#089c9a] transition-all duration-300 shadow-md hover:shadow-lg">Login</a>
    </div>
    <button class="md:hidden focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>
</nav>

{{-- Hero --}}
<section class="relative h-screen bg-cover bg-center flex items-center" style="background-image:url('{{ asset('assets/pantai-klatak.jpg') }}')">
  <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
  <div class="relative z-10 container mx-auto px-6 text-white">
    <div class="max-w-2xl">
      <h1 class="text-5xl md:text-6xl font-bold mb-4 animate-fadeInUp">Pantai Klatak</h1>
      <p class="text-xl md:text-2xl mb-8 leading-relaxed animate-fadeInUp delay-100">Pesona pasir hitam eksotis & ombak tenang di Kediri</p>
      <div class="flex space-x-4 animate-fadeInUp delay-200">
        <a href="#tentang" class="btn-primary px-8 py-3 rounded-full hover:bg-[#089c9a] transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
          Jelajahi
        </a>
        <a href="#galeri" class="px-8 py-3 rounded-full border-2 border-white hover:bg-white/20 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
          Galeri
        </a>
      </div>
    </div>
  </div>
  <div class="absolute bottom-10 left-0 right-0 flex justify-center animate-bounce">
    <a href="#tentang" class="text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
      </svg>
    </a>
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
      <p class="text-gray-700 mb-4 leading-relaxed">Pantai Klatak terletak di Desa Klatak, Kecamatan Ngadiluwih, Kabupaten Kediri, Jawa Timur. Pantai ini menawarkan pesona alam yang memukau dengan pasir hitamnya yang eksotis dan ombak yang tenang.</p>
      <p class="text-gray-700 mb-6 leading-relaxed">Dengan pemandangan laut yang luas dan udara segar, Pantai Klatak menjadi tempat yang cocok untuk liburan keluarga, healing, maupun fotografi. Anda bisa menikmati sunset yang memukau atau sekadar bersantai di tepi pantai.</p>
      <div class="flex flex-wrap gap-3">
        <span class="bg-[#0BB4B2]/10 text-[#0BB4B2] px-4 py-2 rounded-full">Pasir Hitam</span>
        <span class="bg-[#0BB4B2]/10 text-[#0BB4B2] px-4 py-2 rounded-full">Ombak Tenang</span>
        <span class="bg-[#0BB4B2]/10 text-[#0BB4B2] px-4 py-2 rounded-full">Sunset Indah</span>
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
  </div>
</section>

{{-- Harga & Jam --}}
<section id="harga" class="py-20 bg-[#0BB4B2] text-white">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-2">Harga Tiket & Jam Operasional</h2>
    <div class="w-20 h-1 bg-white/50 mx-auto mb-10"></div>
    
    <div class="grid md:grid-cols-2 gap-8 text-left bg-white/10 backdrop-blur-sm rounded-xl p-8 shadow-lg">
      <div>
        <h3 class="text-xl font-semibold mb-4 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Harga Tiket
        </h3>
        <ul class="space-y-3">
          <li class="flex justify-between py-2 border-b border-white/20">
            <span>Dewasa</span>
            <span class="font-medium">Rp10.000</span>
          </li>
          <li class="flex justify-between py-2 border-b border-white/20">
            <span>Anak-anak</span>
            <span class="font-medium">Rp5.000</span>
          </li>
          <li class="flex justify-between py-2 border-b border-white/20">
            <span>Parkir Motor</span>
            <span class="font-medium">Rp3.000</span>
          </li>
          <li class="flex justify-between py-2">
            <span>Parkir Mobil</span>
            <span class="font-medium">Rp10.000</span>
          </li>
        </ul>
      </div>
      
      <div>
        <h3 class="text-xl font-semibold mb-4 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Jam Operasional
        </h3>
        <div class="bg-white/10 rounded-lg p-4 mb-4">
          <div class="text-2xl font-bold mb-1">06.00 – 18.00 WIB</div>
          <div class="text-sm">Setiap Hari</div>
        </div>
        <p class="text-sm text-white/80">*Jam operasional dapat berubah pada hari libur nasional atau kondisi tertentu</p>
      </div>
    </div>
  </div>
</section>

{{-- Galeri --}}
<section id="galeri" class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-bold text-[#0BB4B2] mb-3">Galeri Pantai</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">Momen indah yang bisa Anda abadikan di Pantai Klatak</p>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      <div class="group relative overflow-hidden rounded-xl shadow-lg">
        <img src="{{ asset('assets/pantai1.jpg') }}" alt="Foto 1" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
          </svg>
        </div>
      </div>
      <div class="group relative overflow-hidden rounded-xl shadow-lg">
        <img src="{{ asset('assets/pantai2.jpg') }}" alt="Foto 2" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
          </svg>
        </div>
      </div>
      <div class="group relative overflow-hidden rounded-xl shadow-lg">
        <img src="{{ asset('assets/pantai3.jpg') }}" alt="Foto 3" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
          </svg>
        </div>
      </div>
    </div>
    <div class="text-center mt-10">
      <button class="px-6 py-3 bg-[#0BB4B2] text-white rounded-full hover:bg-[#089c9a] transition duration-300 shadow-md hover:shadow-lg inline-flex items-center">
        Lihat Lebih Banyak
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
      </button>
    </div>
  </div>
</section>

{{-- Peta Lokasi --}}
<section class="py-20 bg-gray-50">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-bold text-[#0BB4B2] mb-3">Lokasi Pantai Klatak</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">Desa Klatak, Kecamatan Ngadiluwih, Kabupaten Kediri, Jawa Timur</p>
    </div>
    <div class="rounded-xl overflow-hidden shadow-2xl">
      <iframe src="https://maps.google.com/maps?q=Desa Klatak Kediri&t=&z=13&ie=UTF8&iwloc=&output=embed" class="w-full h-96 border-0"></iframe>
    </div>
    <div class="mt-8 text-center">
      <a href="https://maps.google.com/maps?q=Desa Klatak Kediri" target="_blank" class="inline-flex items-center px-6 py-3 bg-[#0BB4B2] text-white rounded-full hover:bg-[#089c9a] transition duration-300 shadow-md hover:shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Buka di Google Maps
      </a>
    </div>
  </div>
</section>

{{-- Testimoni --}}
<section class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-bold text-[#0BB4B2] mb-3">Apa Kata Pengunjung?</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">Testimoni dari pengunjung Pantai Klatak</p>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Testimoni 1" class="w-full h-full object-cover">
          </div>
          <div>
            <h4 class="font-semibold">Dian Sastro</h4>
            <div class="flex text-yellow-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
          </div>
        </div>
        <p class="text-gray-600 italic">"Pantainya sangat indah dengan pasir hitam yang unik. Cocok untuk healing dan foto-foto. Fasilitasnya juga cukup lengkap."</p>
      </div>
      
      <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Testimoni 2" class="w-full h-full object-cover">
          </div>
          <div>
            <h4 class="font-semibold">Rudi Hartono</h4>
            <div class="flex text-yellow-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
          </div>
        </div>
        <p class="text-gray-600 italic">"Tempatnya bagus untuk liburan keluarga. Harga tiket masuknya terjangkau. Hanya saja parkirnya agak sempit saat weekend."</p>
      </div>
      
      <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Testimoni 3" class="w-full h-full object-cover">
          </div>
          <div>
            <h4 class="font-semibold">Siti Aminah</h4>
            <div class="flex text-yellow-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
          </div>
        </div>
        <p class="text-gray-600 italic">"Sunset di Pantai Klatak sangat memukau! Spot fotonya banyak dan instagramable. Toiletnya juga bersih. Recommended banget!"</p>
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
        <p class="text-gray-400">Pesona pasir hitam eksotis & ombak tenang di Kediri</p>
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
          <li><a href="#galeri" class="text-gray-400 hover:text-[#0BB4B2] transition duration-200">Galeri</a></li>
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
            Desa Klatak, Kec. Ngadiluwih, Kab. Kediri, Jawa Timur
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
          <p class="text-sm text-gray-500">*Tutup pada hari libur tertentu</p>
        </div>
      </div>
    </div>
    
    <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
      <p>&copy; {{ date('Y') }} Pantai Klatak. All rights reserved.</p>
      <p class="mt-2 text-sm">Developed with ❤️ for Kediri Tourism</p>
    </div>
  </div>
</footer>
@endsection