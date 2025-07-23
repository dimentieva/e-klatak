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

class TransaksiController extends Controller
{
    public function index(Request $request)
{
    $query = Produk::query();

    // Filter kategori
    if ($request->has('categories')) {
        $query->where('id_categories', $request->categories);
    }

    // Pencarian
    if ($request->has('search')) {
        $query->where(function($q) use ($request) {
            $q->where('nama_produk', 'like', '%' . $request->search . '%')
              ->orWhere('nomor_barcode', 'like', '%' . $request->search . '%');
        });
    }

    $produk = $query->paginate(8); // gunakan query yang sudah difilter
    $categories = Category::all(); // ambil semua kategori
    $cart = session()->get('cart', []); // ambil isi keranjang

    return view('dashboard.kasir', compact('produk', 'categories', 'cart')); // ✅ hanya return ini
}

    public function addToCart(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            $cart[$id] = [
                'id_produk' => $produk->id,
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

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $request->validate([
            'metode_bayar' => 'required|string',
            'jumlah_pembayaran' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $total_harga = 0;

            foreach ($cart as $item) {
                $subtotal = $item['harga'] * $item['jumlah'];
                $total_harga += $subtotal;
            }

            $pajak = $total_harga * 0.11;
            $grand_total = $total_harga + $pajak;
            $kembalian = $request->jumlah_pembayaran - $grand_total;

            if ($kembalian < 0) {
                return back()->with('error', 'Jumlah pembayaran kurang.');
            }

            $transaksi = Transaksi::create([
                'id_user' => Auth::id(),
                'waktu_transaksi' => now(),
                'nomor_nota' => 'NOTA-' . strtoupper(Str::random(6)),
                'metode_bayar' => $request->metode_bayar,
                'total_harga' => $grand_total,
                'jumlah_pembayaran' => $request->jumlah_pembayaran,
                'kembalian' => $kembalian,
                'pajak' => $pajak,
            ]);

            foreach ($cart as $item) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $item['id_produk'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga'],
                    'diskon' => 0,
                    'sub_total' => $item['harga'] * $item['jumlah'],
                ]);

                // Kurangi stok produk
                $produk = Produk::find($item['id_produk']);
                if ($produk) {
                    $produk->stok -= $item['jumlah'];
                    $produk->save();
                }
            }

            session()->forget('cart');

            DB::commit();
            return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
