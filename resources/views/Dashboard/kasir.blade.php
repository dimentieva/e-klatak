@extends('layouts.app')
@section('title', 'Halaman Kasir')

@section('content')

<!-- Header -->
<div class="bg-white p-3 sm:p-4 border-b shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/eklatak.png') }}" class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full border-2 border-[#0BB4B2]" />
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0BB4B2] tracking-wide">E-Klatak</h1>
        </div>

        <!-- Dropdown User -->
        <div class="relative" x-data="{ open: false }" x-cloak>
            <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-[#0BB4B2] font-medium transition text-sm sm:text-base">
                <svg class="w-5 h-5 text-[#0BB4B2]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-5.6 5a6.978 6.978 0 0111.2 0A2 2 0 0113 18H7a2 2 0 01-2.6-3z" />
                </svg>
                <span class="truncate max-w-[140px] sm:max-w-none">{{ Auth::user()->name ?? '-' }}</span>
            </button>
            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-md z-20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Konten -->
<div class="bg-gray-50 min-h-[calc(100vh-80px)] pb-20 md:pb-0 md:h-[calc(100vh-80px)] md:overflow-hidden">
        <div class="max-w-7xl mx-auto h-full flex flex-col-reverse md:flex-row gap-0 md:gap-4 overflow-hidden">

        <!-- Sidebar Keranjang -->
        <div id="keranjangSection"
     class="md:basis-2/5 w-full bg-white border-t md:border-t-0 md:border-r p-3 sm:p-4 flex flex-col shadow-md rounded-b-xl md:rounded-tr-xl md:rounded-br-xl h-full min-h-0 overflow-y-auto">


            <!-- Tabel Keranjang -->
            <div class="overflow-x-auto rounded-lg shadow mb-3 sm:mb-4">
                <table class="min-w-full text-center text-gray-700">
                    <thead class="bg-[#0BB4B2] text-white uppercase tracking-wider">
                        <tr class="text-[11px] xs:text-xs sm:text-xs md:text-sm">
                            <th class="px-3 sm:px-4 py-2 sm:py-3">Produk</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3">Harga</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3">Qty</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3">Subtotal</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="keranjang" class="divide-y divide-gray-200 bg-white text-center text-[12px] sm:text-sm">
                        {{-- Diisi dari JS --}}
                    </tbody>
                </table>
            </div>

            <!-- Ringkasan Total & Pajak -->
            <div class="space-y-2 sm:space-y-3 mb-3 sm:mb-4">
                <div class="flex items-center justify-between text-sm sm:text-base">
                    <span>Total</span>
                    <span id="totalCart" class="font-semibold">Rp 0</span>
                </div>
                <div class="flex items-center justify-between text-sm sm:text-base">
                    <span>Pajak (11%)</span>
                    <span id="pajakCart" class="font-semibold">Rp 0</span>
                </div>
                <div class="flex items-center justify-between text-base sm:text-lg bg-gray-100 p-3 rounded-xl font-semibold text-gray-700 shadow-inner">
                    <span>Grand Total</span>
                    <span id="grandTotal" class="text-[#0BB4B2] font-bold">Rp 0</span>
                </div>
            </div>

            <!-- Tombol (desktop/tablet) -->
            <div class="mt-auto flex gap-3 sm:gap-4 hidden md:flex">
                <button onclick="resetKeranjang()" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-xl w-full transition shadow">Reset</button>
                <button onclick="bayar()" class="bg-[#0BB4B2] hover:bg-[#099d9c] text-white py-2 px-4 rounded-xl w-full transition shadow">Bayar</button>
            </div>
        </div>

        <!-- Konten Produk -->
        <div class="md:basis-3/5 w-full bg-white p-3 sm:p-4 shadow-inner flex flex-col h-full min-h-0 overflow-y-auto">

            <!-- Kategori + Search (sticky di mobile) -->
            <div class="sticky -top-1 z-10 bg-white pb-2">
                <!-- Kategori -->
                <div class="flex gap-2 mb-3 sm:mb-4 flex-wrap" id="kategoriBar">
                    @php $katAktif = request('kategori'); @endphp
                    <button onclick="filterKategori(0)" class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-full kategori-button text-xs sm:text-sm shadow hover:brightness-110 transition {{ $katAktif ? '' : 'active-kategori' }}" data-id="0">Semua</button>
                    @foreach ($categories as $kat)
                        <button onclick="filterKategori('{{ $kat->id }}')" class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-full kategori-button text-xs sm:text-sm transition shadow-sm {{ (string)$katAktif === (string)$kat->id ? 'active-kategori' : 'bg-gray-200 text-gray-700 hover:bg-[#0BB4B2] hover:text-white' }}" data-id="{{ $kat->id }}">
                            {{ $kat->name }}
                        </button>
                    @endforeach
                </div>

                <!-- Search (AJAX lintas pagination) -->
                <div class="mb-3 sm:mb-6">
                    <input type="text" id="searchInput" placeholder="Cari nama / Barcode produk..." value="{{ request('q') }}" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm shadow focus:outline-none focus:ring-2 focus:ring-[#0BB4B2] focus:border-[#0BB4B2]">
                </div>
            </div>

            <!-- Produk + Pagination dibungkus untuk AJAX replace -->
            <div id="produkContainer" class="min-h-0">
                {{-- Info mode search (saat q ada) --}}
                @if(!empty(request('q')))
                    <div id="searchInfo" class="text-xs text-gray-500 mb-2">
                        Menampilkan hasil untuk: <strong>"{{ request('q') }}"</strong>
                    </div>
                @endif

                <!-- List Produk -->
                    <div id="produkList" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-3">
                    @forelse ($produk as $item)
                        <div class="produk-card bg-white rounded-xl p-2.5 sm:p-3 flex flex-col items-center text-center shadow-md hover:shadow-lg transition-transform hover:-translate-y-1"
                             data-kategori="{{ $item->id_categories }}"
                             data-nama="{{ strtolower($item->nama_produk) }}"
                             data-barcode="{{ $item->nomor_barcode }}">
                            <img src="{{ asset('storage/foto_produk/'.$item->foto) }}" class="w-full h-28 sm:h-32 md:h-36 object-cover rounded-lg mb-2.5 sm:mb-3 border" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg'" alt="{{ $item->nama_produk }}" loading="lazy" />
                            <div class="text-[12px] sm:text-sm font-semibold text-gray-800 truncate w-full">{{ $item->nama_produk }}</div>
                            <div class="text-[11px] sm:text-xs text-gray-500">{{ $item->nomor_barcode }}</div>
                            <div class="text-[#0BB4B2] font-bold mt-1 text-sm sm:text-base">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                            <button onclick="tambahKeranjang({{ $item->id_produk }}, '{{ addslashes($item->nama_produk) }}', {{ $item->harga_jual }}, {{ $item->stok }})" class="mt-2.5 sm:mt-3 w-full py-1.5 rounded-lg text-xs sm:text-sm bg-[#0BB4B2] text-white hover:bg-[#099d9c] transition shadow">Tambah</button>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-400 py-10">Tidak ada produk tersedia.</div>
                    @endforelse
                </div>

                <!-- Pagination (disembunyikan saat search aktif) -->
                <div id="produkPagination" class="flex justify-center mt-4 sm:mt-6 {{ request('q') ? 'hidden' : '' }}">
                    @if(!request('q'))
                        {{ $produk->links() }}
                    @endif
                </div>
            </div>

            <!-- Print Area -->
            <div id="printArea" class="hidden">
                <div style="font-family: monospace; width: 250px; padding: 10px;">
                    <h2 style="text-align: center; margin: 5px 0;">Fresh Market Pantai Klatak</h2>
                    <p style="text-align: center; margin: 0;">Jalan Pantai Waru Doyong Klatak, Soireng, Keboireng, Kec. Besuki, Kab. Tulungagung</p>
                    <hr>
                    <p>Nota: <span id="printNota"></span></p>
                    <p>Tanggal: <span id="printTanggal"></span></p>
                    <hr>
                    <div id="printItems"></div>
                    <hr>
                    <table style="width: 100%; font-size: 12px;">
                        <tr><td>Total</td><td style="text-align: right;"><span id="printTotal"></span></td></tr>
                        <tr><td>Pajak (11%)</td><td style="text-align: right;"><span id="printPajak"></span></td></tr>
                        <tr><td><strong>Grand Total</strong></td><td style="text-align: right;"><strong><span id="printGrandTotal"></span></strong></td></tr>
                        <tr><td>Bayar</td><td style="text-align: right;"><span id="printBayar"></span></td></tr>
                        <tr><td>Kembalian</td><td style="text-align: right;"><span id="printKembalian"></span></td></tr>
                    </table>
                    <hr>
                    <p style="text-align: center;">Terima kasih telah berbelanja!</p>
                    <p style="text-align: center;">~ E-Klatak ~</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<x-modal-pembayaran />

<!-- Sticky bar total untuk MOBILE -->
<div class="fixed inset-x-0 bottom-0 z-30 bg-white border-t p-3 md:hidden">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-3">
        <div class="text-sm font-semibold flex items-center gap-2">
            <!-- <span id="itemCountBadge" class="inline-flex items-center justify-center min-w-5 px-2 py-0.5 text-xs rounded-full bg-gray-100 border">0</span> -->
            <!-- <span>Grand Total: <span id="grandTotalMobile" class="text-[#0BB4B2] font-bold">Rp 0</span></span> -->
        </div>
        <div class="flex gap-2">
            <button onclick="resetKeranjang()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm shadow">Reset</button>
            <button onclick="bayar()" class="bg-[#0BB4B2] hover:bg-[#099d9c] text-white px-3 py-2 rounded-lg text-sm shadow">Bayar</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/kasir.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ==== Elemen penting keranjang ====
    const tbody            = document.getElementById('keranjang');
    const keranjangSection = document.getElementById('keranjangSection');
    const totalCart        = document.getElementById('totalCart');
    const pajakCart        = document.getElementById('pajakCart');
    const grandTotalDesk   = document.getElementById('grandTotal');
    const grandTotalMobile = document.getElementById('grandTotalMobile');
    const itemCountBadge   = document.getElementById('itemCountBadge');

    // ===== Helper =====
    const parseRupiah = (str) => Number(String(str || '').replace(/[^0-9]/g, '')) || 0;
    const formatRupiah = (num) => 'Rp ' + (Number(num) || 0).toLocaleString('id-ID');

    // ===== Hitung Total/Pajak/Grand dari subtotal kolom =====
    const recalcSummary = () => {
        let total = 0;
        if (tbody) {
            tbody.querySelectorAll('tr').forEach(tr => {
                const td = tr.children[3]; // kolom Subtotal
                if (td) total += parseRupiah(td.textContent);
            });
        }
        const pajak = Math.round(total * 0.11);
        const grand = total + pajak;

        if (totalCart)        totalCart.textContent        = formatRupiah(total);
        if (pajakCart)        pajakCart.textContent        = formatRupiah(pajak);
        if (grandTotalDesk)   grandTotalDesk.textContent   = formatRupiah(grand);
        if (grandTotalMobile) grandTotalMobile.textContent = formatRupiah(grand);
    };

    const updateItemCount = () => {
        if (!tbody || !itemCountBadge) return;
        itemCountBadge.textContent = tbody.querySelectorAll('tr').length;
    };

    // Observer untuk perubahan keranjang
    let prevCount = (tbody && tbody.querySelectorAll('tr').length) || 0;
    const obs = new MutationObserver(() => {
        const current = tbody.querySelectorAll('tr').length;
        updateItemCount();
        recalcSummary();

        if (current > prevCount && window.innerWidth < 768 && keranjangSection) {
            setTimeout(() => keranjangSection.scrollIntoView({ behavior: 'smooth', block: 'end' }), 50);
        }
        prevCount = current;
    });
    if (tbody) obs.observe(tbody, { childList: true, subtree: true, characterData: true });

    // Init awal
    updateItemCount();
    recalcSummary();

    // ====== AJAX PARTIAL LOAD (produk list + pagination) ======
    const produkContainer = document.getElementById('produkContainer');
    const kategoriBar     = document.getElementById('kategoriBar');
    const searchInput     = document.getElementById('searchInput');

    const getParams = () => new URLSearchParams(window.location.search);
    const buildUrl  = (params) => window.location.pathname + '?' + params.toString();

    const updateActiveKategori = () => {
        const params = getParams();
        const aktif = params.get('kategori');
        if (!kategoriBar) return;
        kategoriBar.querySelectorAll('button[data-id]').forEach(btn => {
            const id = btn.getAttribute('data-id');
            if ((aktif === null && id === '0') || (aktif !== null && id === String(aktif))) {
                btn.classList.add('active-kategori');
                btn.classList.remove('bg-gray-200','text-gray-700');
            } else {
                btn.classList.remove('active-kategori');
                btn.classList.add('bg-gray-200','text-gray-700');
            }
        });
    };

    const ajaxLoadProduk = async (url) => {
        try {
            const res  = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const html = await res.text();
            const doc  = new DOMParser().parseFromString(html, 'text/html');

            const newContainer = doc.querySelector('#produkContainer');
            if (newContainer && produkContainer) {
                produkContainer.innerHTML = newContainer.innerHTML;

                // Update URL (tanpa reload)
                window.history.pushState({}, '', url);

                // Perbarui highlight kategori
                updateActiveKategori();

                // Scroll ke atas area produk
                produkContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                window.location.assign(url); // fallback
            }
        } catch (e) {
            console.error('Gagal memuat produk via AJAX:', e);
            window.location.assign(url); // fallback
        }
    };

    // Delegasi klik pada pagination link
    document.addEventListener('click', function(e) {
        const a = e.target.closest('#produkPagination a');
        if (a) {
            e.preventDefault();
            ajaxLoadProduk(a.href);
        }
    });

    // Popstate (Back/Forward)
    window.addEventListener('popstate', function() {
        ajaxLoadProduk(window.location.href);
    });

    // Search (AJAX + debounce, tanpa paginate ketika q ada)
    const debounce = (fn, t=400) => { let id; return (...a)=>{ clearTimeout(id); id=setTimeout(()=>fn(...a), t); }; };
    if (searchInput) {
        const handler = debounce((val) => {
            const p = getParams();
            if (val && val.length >= 2) p.set('q', val); else p.delete('q');
            p.delete('page'); // reset ke halaman 1
            ajaxLoadProduk(buildUrl(p));
        }, 500);
        searchInput.addEventListener('input', e => handler(e.target.value.trim()));
        searchInput.addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const p   = getParams();
                const val = e.target.value.trim();
                if (val) p.set('q', val); else p.delete('q');
                p.delete('page');
                ajaxLoadProduk(buildUrl(p));
            }
        });
    }

    // Filter kategori (AJAX)
    window.filterKategori = function(id) {
        const p = getParams();
        if (Number(id) === 0) p.delete('kategori'); else p.set('kategori', id);
        p.delete('page');
        ajaxLoadProduk(buildUrl(p));
    };
});
</script>
@endpush

@push('styles')
<style>
    .active-kategori { background-color: #0BB4B2 !important; color: white !important; }
    @media (hover: none) { .produk-card:hover { transform: none; box-shadow: 0 1px 2px rgba(0,0,0,.06); } }
    @supports(padding: max(0px)) { .fixed.inset-x-0.bottom-0 { padding-bottom: max(0.75rem, env(safe-area-inset-bottom)); } }
</style>
@endpush
