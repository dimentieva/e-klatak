<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
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
    \Log::debug('Request masuk:', $request->all());
    \Log::debug('Data keranjang:', $request->keranjang);
    try {
        
        DB::beginTransaction();

        $transaksi = Transaksi::create([
            'id_user' => Auth::id(),
            'waktu_transaksi' => now(),
            'nomor_nota' => Str::random(10),
            'metode_bayar' => $request->metode_bayar,
            'total_harga' => $request->total_harga,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'kembalian' => $request->kembalian,
            'pajak' => $request->pajak,
        ]);

        foreach ($request->keranjang as $item) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga'],
                'diskon' => $item['diskon'] ?? 0,
                'sub_total' => $item['sub_total'],
            ]);
        }

        DB::commit();
        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error("Gagal menyimpan transaksi: " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menyimpan transaksi.',
            'error' => $e->getMessage(),
        ], 500);
    }
}
}
