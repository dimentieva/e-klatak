<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\LogPerubahanStok;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai   = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        // ================= TRANSAKSI =================
        $transaksi = Transaksi::with('detailTransaksi.produk')
            ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->whereBetween('created_at', [
                    $tanggalMulai . ' 00:00:00',
                    $tanggalSelesai . ' 23:59:59'
                ]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // ================= TOTAL PRODUK TERJUAL =================
        $totalProduk = DetailTransaksi::when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
            $q->whereBetween('created_at', [
                $tanggalMulai . ' 00:00:00',
                $tanggalSelesai . ' 23:59:59'
            ]);
        })->sum('jumlah');

        // ================= TOTAL PENDAPATAN =================
        $totalPendapatan = Transaksi::when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
            $q->whereBetween('created_at', [
                $tanggalMulai . ' 00:00:00',
                $tanggalSelesai . ' 23:59:59'
            ]);
        })->sum('total_harga');

        // ================= PRODUK TERLARIS =================
        // 🔹 Produk paling banyak dijual
        $produkTerlaris = \App\Models\DetailTransaksi::selectRaw('id_produk, SUM(jumlah) as total_terjual')
            ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59']);
            })
            ->groupBy('id_produk')
            ->orderByDesc('total_terjual')
            ->with('produk')
            ->first();

        // ================= LABA =================
        $laba = DetailTransaksi::with('produk')
            ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->whereBetween('created_at', [
                    $tanggalMulai . ' 00:00:00',
                    $tanggalSelesai . ' 23:59:59'
                ]);
            })
            ->get()
            ->sum(function ($detail) {
                if (!$detail->produk) return 0;
                return ($detail->produk->harga_jual - $detail->produk->harga_beli) * $detail->jumlah;
            });

        // ================= 🔥 RUGI DARI EXPIRED =================
        $rugi = LogPerubahanStok::with('produk')
            ->where('keterangan', 'like', '%expired%')
            ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->whereBetween('created_at', [
                    $tanggalMulai . ' 00:00:00',
                    $tanggalSelesai . ' 23:59:59'
                ]);
            })
            ->get()
            ->sum(function ($log) {
                if (!$log->produk) return 0;

                $stokHilang = $log->stok_awal - $log->stok_akhir;
                return $stokHilang * $log->produk->harga_beli;
            });

        return view('laporan.index', compact(
            'transaksi',
            'totalProduk',
            'totalPendapatan',
            'produkTerlaris',
            'laba',
            'rugi'
        ));
    }

    // ================= EXPORT PDF =================
    public function exportPdf(Request $request)
    {
        $tanggalMulai   = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        $transaksi = Transaksi::with('detailTransaksi.produk')
            ->when($tanggalMulai && $tanggalSelesai, function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->whereBetween('created_at', [
                    $tanggalMulai . ' 00:00:00',
                    $tanggalSelesai . ' 23:59:59'
                ]);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $totalProduk = DetailTransaksi::sum('jumlah');
        $totalPendapatan = $transaksi->sum('total_harga');

        $laba = DetailTransaksi::with('produk')->get()
            ->sum(
                fn($d) => $d->produk
                    ? ($d->produk->harga_jual - $d->produk->harga_beli) * $d->jumlah
                    : 0
            );

        $rugi = LogPerubahanStok::with('produk')
            ->where('keterangan', 'like', '%expired%')
            ->get()
            ->sum(
                fn($log) => $log->produk
                    ? ($log->stok_awal - $log->stok_akhir) * $log->produk->harga_beli
                    : 0
            );

        $produkTerlaris = DetailTransaksi::selectRaw('id_produk, SUM(jumlah) as total_terjual')
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
        ))->stream('laporan_penjualan.pdf');
    }
}
