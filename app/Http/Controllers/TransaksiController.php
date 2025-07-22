<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('detailTransaksi.produk')->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('transaksi.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk.*.id_produk' => 'required|exists:produk,id',
            'produk.*.jumlah' => 'required|integer|min:1',
            'metode_bayar' => 'required|string',
            'jumlah_pembayaran' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $total_harga = 0;

            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['id_produk']);
                $harga = $produk->harga;
                $subtotal = $harga * $item['jumlah'];
                $total_harga += $subtotal;
            }

            $pajak = $total_harga * 0.11;
            $grand_total = $total_harga + $pajak;
            $kembalian = $request->jumlah_pembayaran - $grand_total;

            $transaksi = Transaksi::create([
                'id_user' => auth::user()->role ?? 'kasir',
                'waktu_transaksi' => now(),
                'nomor_nota' => 'NOTA-' . strtoupper(Str::random(6)),
                'metode_bayar' => $request->metode_bayar,
                'total_harga' => $grand_total,
                'jumlah_pembayaran' => $request->jumlah_pembayaran,
                'kembalian' => $kembalian,
                'pajak' => $pajak,
            ]);

            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['id_produk']);
                $subtotal = $produk->harga * $item['jumlah'];

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi, // Gunakan 'id' bukan 'id_transaksi'
                    'id_produk' => $produk->id,
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $produk->harga,
                    'diskon' => 0,
                    'sub_total' => $subtotal,
                ]);
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
