<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.core.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.core.min.css"></noscript>

    <!-- Critical CSS (Inline) -->
    <style>
      
      /* Base Styles to prevent FOUC */
      :root {
        --primary-color: #0BB4B2;
        --primary-hover: #089f9d;
        --text-color: #374151;
      }
      
      body {
        visibility: hidden;
        opacity: 0;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background-color: #f4f4f4;
        color: var(--text-color);
        transition: opacity 0.4s ease, visibility 0.4s ease;
      }
      
     /* Loader minimal langsung muncul */
  #initial-loader {
    position: fixed;
    inset: 0;
    background: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    z-index: 9999;
  }
  .loader-spinner {
    border: 4px solid rgba(11, 180, 178, 0.2);
    border-top: 4px solid #0BB4B2;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
  }
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
      
      /* Critical Navbar Styles */
      .navbar-critical {
        position: fixed;
        width: 100%;
        z-index: 50;
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
      }
      
      /* Critical Hero Section Styles */
      .hero-section {
        height: 100vh;
        width: 100%;
        position: relative;
        overflow: hidden;
      }

        .glide__slide {
        height: 100vh; /* pastikan penuh layar */
        background-size: cover;
        background-position: center;
      }

      .hero-content {
        position: relative;
        z-index: 10;
        color: white;
      }
      
      .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);
      }

      a {
        text-decoration: none !important;
    }
      
      /* Basic Typography */
      h1, h2, h3 {
        font-weight: bold;
        line-height: 1.2;
      }
      
      h1 { font-size: 2.25rem; }
      h2 { font-size: 1.875rem; }
      h3 { font-size: 1.5rem; }
      
      .btn-primary {
        display: inline-block;
        padding: 0.5rem 1rem;
        /* border-radius: 9999px; */
        background-color: var(--primary-color);
        text-decoration: none;
        color: white;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none; 
      }
      
      .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
      }
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Pantai Klatak')</title>
    
    <!-- Load Tailwind CSS Immediately After Head -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        important: true,
        theme: {
          extend: {
            colors: {
              primary: '#0BB4B2',
              'primary-hover': '#089f9d',
            },
            fontFamily: {
              sans: ['Segoe UI', 'system-ui', '-apple-system', 'sans-serif'],
            },
          }
        },
        corePlugins: {
          preflight: true, // Disable default styles to prevent conflicts
        }
      }
    </script>
    
    <!-- Optional Custom CSS -->
    @stack('styles')
</head>

<body class="bg-gray-100">
    <!-- Initial Loader -->
    <div id="initial-loader">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat...</div>
    </div>
    
    @yield('content')

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Glide.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Main Script -->
   <script>
  // 1. Sembunyikan body dan tampilkan loader segera
  document.body.style.visibility = 'hidden';
  document.body.style.opacity = '0';
  document.getElementById('initial-loader').style.display = 'flex';
  document.getElementById('initial-loader').style.opacity = '1';

  // 2. Saat DOM siap (HTML terparsing)
  document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan body secara halus
    document.body.style.visibility = 'visible';
    document.body.style.opacity = '1';
    
    // Tunggu 100ms untuk memastikan CSS sudah diterapkan
    setTimeout(function() {
      // Mulai proses menghilangkan loader
      document.getElementById('initial-loader').style.opacity = '0';
      
      // Setelah transisi selesai, sembunyikan loader
      setTimeout(function() {
        document.getElementById('initial-loader').style.display = 'none';
      }, 300); // Harus sama dengan durasi transisi CSS
    }, 100);
  });

  // 3. Backup untuk event load (resource eksternal selesai)
  window.addEventListener('load', function() {
    // Jika loader masih terlihat
    if (parseFloat(getComputedStyle(document.getElementById('initial-loader')).opacity) > 0) {
      document.getElementById('initial-loader').style.opacity = '0';
      setTimeout(function() {
        document.getElementById('initial-loader').style.display = 'none';
      }, 300);
    }
    
    // Inisialisasi komponen JS
    if (typeof Glide !== 'undefined') {
      document.querySelectorAll('.glide').forEach(function(element) {
        new Glide(element, {
          type: 'carousel',
          autoplay: 4000,
          animationDuration: 600,
          perView: 1
        }).mount();
      });
    }
  });

  // 4. Fallback timeout (3 detik)
  setTimeout(function() {
    document.body.style.visibility = 'visible';
    document.body.style.opacity = '1';
    document.getElementById('initial-loader').style.opacity = '0';
    setTimeout(function() {
      document.getElementById('initial-loader').style.display = 'none';
    }, 300);
  }, 3000);
</script>
    
    <!-- Optional Custom JS -->
    @stack('scripts')

  <script>
document.addEventListener("DOMContentLoaded", function () {
    const galleryItems = document.querySelectorAll(".gallery-item");
    const loadMoreBtn = document.getElementById("loadMoreBtn");
    const filterButtons = document.querySelectorAll(".gallery-filter");

    let currentFilter = "all";
    let itemsToShow = 6;

    function updateGallery() {
        let visibleCount = 0;

        galleryItems.forEach(item => {
            const category = item.getAttribute("data-category");

            if (currentFilter === "all" || category === currentFilter) {
                if (visibleCount < itemsToShow) {
                    item.classList.remove("hidden");
                } else {
                    item.classList.add("hidden");
                }
                visibleCount++;
            } else {
                item.classList.add("hidden");
            }
        });

        // Update tombol load more
        const totalVisibleItems = document.querySelectorAll(`.gallery-item[data-category="${currentFilter}"], .gallery-item[data-category]:not([data-category])`).length;
        const filteredItems = Array.from(galleryItems).filter(item => currentFilter === "all" || item.getAttribute("data-category") === currentFilter);

        if (itemsToShow >= filteredItems.length) {
            loadMoreBtn.textContent = "Lihat Lebih Sedikit";
        } else {
            loadMoreBtn.textContent = "Lihat Lebih Banyak Foto";
        }
    }

    // Event klik filter
    filterButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            filterButtons.forEach(b => b.classList.remove("bg-[#0BB4B2]", "text-white"));
            this.classList.add("bg-[#0BB4B2]", "text-white");

            currentFilter = this.getAttribute("data-filter");
            itemsToShow = 6; // reset tampilan awal
            updateGallery();
        });
    });

    // Event klik load more
    loadMoreBtn.addEventListener("click", function () {
        const filteredItems = Array.from(galleryItems).filter(item => currentFilter === "all" || item.getAttribute("data-category") === currentFilter);

        if (itemsToShow >= filteredItems.length) {
            itemsToShow = 6; // kembali ke awal
        } else {
            itemsToShow += 6; // tambah 6 lagi
        }

        updateGallery();
    });

    // Inisialisasi awal
    updateGallery();
});
</script>
</body>
</html>