<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
   public function index(Request $request)
{
    $tanggalMulai = $request->get('tanggal_mulai');
    $tanggalSelesai = $request->get('tanggal_selesai');

    $query = \App\Models\Transaksi::with('detailTransaksi.produk');

    if ($tanggalMulai && $tanggalSelesai) {
        $query->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59']);
    }

    $transaksi = $query->orderBy('created_at', 'desc')->paginate(10);

    // Total produk terjual
    $totalProduk = \App\Models\DetailTransaksi::when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
        $q->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59']);
    })->sum('jumlah');

    // Total pendapatan
    $totalPendapatan = \App\Models\Transaksi::when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
        $q->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59']);
    })->sum('total_harga');

    // 🔹 Produk paling banyak dijual
    $produkTerlaris = \App\Models\DetailTransaksi::selectRaw('id_produk, SUM(jumlah) as total_terjual')
        ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
            $q->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59']);
        })
        ->groupBy('id_produk')
        ->orderByDesc('total_terjual')
        ->with('produk')
        ->first();

    // 🔹 Hitung total laba dan rugi
    $detailTransaksi = \App\Models\DetailTransaksi::with('produk')
        ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
            $q->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59']);
        })
        ->get();

    $laba = 0;
    $rugi = 0;

    foreach ($detailTransaksi as $detail) {
        $produk = $detail->produk;
        if ($produk) {
            $hargaBeli = $produk->harga_beli;
            $hargaJual = $produk->harga_jual;
            $selisih = ($hargaJual - $hargaBeli) * $detail->jumlah;

            if ($selisih >= 0) {
                $laba += $selisih;
            } else {
                $rugi += abs($selisih);
            }
        }
    }

    return view('laporan.index', compact(
        'transaksi',
        'totalProduk',
        'totalPendapatan',
        'produkTerlaris',
        'laba',
        'rugi'
    ));
}




    public function exportPdf(Request $request)
{
    $tanggalMulai = $request->tanggal_mulai;
    $tanggalSelesai = $request->tanggal_selesai;

    $query = Transaksi::with('detailTransaksi.produk')->orderBy('created_at', 'desc');

    if ($tanggalMulai && $tanggalSelesai) {
        $query->whereBetween('created_at', [
            $tanggalMulai . ' 00:00:00',
            $tanggalSelesai . ' 23:59:59'
        ]);
    }

    $transaksi = $query->get();

    // Total produk terjual
    $totalProduk = \App\Models\DetailTransaksi::when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
        $q->whereBetween('created_at', [
            $tanggalMulai . ' 00:00:00',
            $tanggalSelesai . ' 23:59:59'
        ]);
    })->sum('jumlah');

    // Total pendapatan
    $totalPendapatan = $transaksi->sum('total_harga');

    // Hitung laba/rugi
    $detailTransaksi = \App\Models\DetailTransaksi::with('produk')
        ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
            $q->whereBetween('created_at', [
                $tanggalMulai . ' 00:00:00',
                $tanggalSelesai . ' 23:59:59'
            ]);
        })->get();

    $laba = 0;
    $rugi = 0;

    foreach ($detailTransaksi as $detail) {
        $produk = $detail->produk;
        if ($produk) {
            $selisih = ($produk->harga_jual - $produk->harga_beli) * $detail->jumlah;
            if ($selisih >= 0) {
                $laba += $selisih;
            } else {
                $rugi += abs($selisih);
            }
        }
    }

    // Produk terlaris
    $produkTerlaris = \App\Models\DetailTransaksi::selectRaw('id_produk, SUM(jumlah) as total_terjual')
        ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
            $q->whereBetween('created_at', [
                $tanggalMulai . ' 00:00:00',
                $tanggalSelesai . ' 23:59:59'
            ]);
        })
        ->groupBy('id_produk')
        ->orderByDesc('total_terjual')
        ->with('produk')
        ->first();

    return Pdf::loadView('laporan.pdf', compact(
        'transaksi',
        'totalProduk',
        'totalPendapatan',
        'laba',
        'rugi',
        'produkTerlaris',
        'tanggalMulai',
        'tanggalSelesai'
    ))->setPaper('A4', 'portrait')->stream('laporan_penjualan.pdf');
}
}