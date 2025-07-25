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
        $query = Produk::query();

        if ($request->has('categories') && $request->categories != '') {
            $query->where('id_categories', $request->categories);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_barcode', 'like', '%' . $request->search . '%');
            });
        }

        $produk = $query->paginate(8);
        $categories = Category::all();
        $cart = session()->get('cart', []);

        return view('dashboard.kasir', compact('produk', 'categories', 'cart'));
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
