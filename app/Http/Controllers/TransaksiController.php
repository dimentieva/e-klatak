<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\LogPerubahanStok;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $q        = trim($request->get('q', ''));
    $kategori = $request->get('kategori');
    $limitAll = 200; // batas maksimum item saat mode search (q ada)

    $base = Produk::query()
        ->when($kategori, fn($qq) => $qq->where('id_categories', $kategori)) // pakai kolom yg benar
        ->when($q, function ($qq) use ($q) {
            $qq->where(function ($s) use ($q) {
                $s->where('nama_produk', 'like', "%{$q}%")
                  ->orWhere('nomor_barcode', 'like', "%{$q}%");
            });
        })
        ->orderBy('nama_produk');

    // Search tidak terpengaruh paginate: saat q ada -> tanpa paginate
    if ($q !== '') {
        $produk = $base->limit($limitAll)->get();
    } else {
        $produk = $base->paginate(5)->appends($request->query());
    }

    $categories = Category::orderBy('name')->get();

    return view('dashboard.kasir', compact('produk', 'categories'));
    }

    public function addToCart(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            $cart[$id] = [
                'id_produk' => $produk->id_produk,
                'nama_produk' => $produk->nama_produk,
                'harga' => $produk->harga,
                'jumlah' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function updateCart(Request $request)
    {
        $cart = [];
        foreach ($request->cart as $item) {
            $cart[$item['id']] = [
                'id_produk' => $item['id'],
                'nama_produk' => $item['nama'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

   public function store(Request $request)
{
    try {
        // Validasi data dasar
        $request->validate([
            'total_harga' => 'required|numeric',
            'jumlah_pembayaran' => 'required|numeric',
            'kembalian' => 'required|numeric',
            'metode_bayar' => 'required|string',
            'pajak' => 'required|numeric',
            'keranjang' => 'required|array|min:1',
            'keranjang.*.id_produk' => 'required|exists:produk,id_produk',
            'keranjang.*.jumlah' => 'required|integer|min:1',
            'keranjang.*.harga' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        // Simpan transaksi utama
        $transaksi = Transaksi::create([
            'id_user' => Auth::id(),
            'waktu_transaksi' => now(),
            'nomor_nota' => 'NOTA-' . strtoupper(Str::random(8)),
            'metode_bayar' => $request->metode_bayar,
            'total_harga' => $request->total_harga,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'kembalian' => $request->kembalian,
            'pajak' => $request->pajak,
        ]);

        // Loop setiap produk di keranjang
        foreach ($request->keranjang as $item) {
            $produk = Produk::findOrFail($item['id_produk']);
            $stokAwal = $produk->stok;

            // Kurangi stok
            if ($produk->stok < $item['jumlah']) {
                throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi.");
            }

            $produk->stok -= $item['jumlah'];
            $produk->save();

            // Simpan detail transaksi
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga'],
                'diskon' => $item['diskon'] ?? 0,
                'sub_total' => $item['sub_total'],
            ]);

            // Simpan log stok
            LogPerubahanStok::create([
                'id_produk' => $item['id_produk'],
                'jenis' => 'kurang',
                'jumlah_perubahan' => -$item['jumlah'],
                'stok_awal' => $stokAwal,
                'stok_akhir' => $produk->stok,
                'keterangan' => 'Transaksi #' . $transaksi->nomor_nota,
                'created_by' => Auth::check() ? Auth::user()->name : 'admin',
            ]);
        }

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil disimpan']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}
    public function getSubtotalDashboard()
    {
        $subtotal = DetailTransaksi::sum('sub_total');
        return $subtotal;
    }
}
