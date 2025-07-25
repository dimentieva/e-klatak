<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->tanggal_mulai;
        $endDate = $request->tanggal_selesai;

        // Query untuk seluruh transaksi (tanpa paginate)
        $queryForTotal = Transaksi::with('detailTransaksi');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $queryForTotal->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        $allTransaksi = $queryForTotal->get();

        // Hitung total dari seluruh transaksi (bukan hanya halaman yang ditampilkan)
        $totalProduk = $allTransaksi->sum(function ($trx) {
            return $trx->detailTransaksi->sum('jumlah');
        });

        $totalPendapatan = $allTransaksi->sum('total_harga');

        // Query ulang untuk paginasi
        $queryPaginated = Transaksi::with('detailTransaksi')->orderBy('created_at', 'asc');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $queryPaginated->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        $transaksi = $queryPaginated->paginate(15);

        return view('laporan.index', compact('transaksi', 'totalProduk', 'totalPendapatan'));
    }



    public function exportPdf(Request $request)
    {
        $query = Transaksi::with(['detailTransaksi.produk', 'user'])->orderBy('created_at', 'asc');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('created_at', [
                $request->tanggal_mulai . ' 00:00:00',
                $request->tanggal_selesai . ' 23:59:59'
            ]);
        }

        $semuaTransaksi = $query->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('semuaTransaksi'))->setPaper('A4', 'portrait');
        return $pdf->stream('laporan_penjualan.pdf');
    }
}