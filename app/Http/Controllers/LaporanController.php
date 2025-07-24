<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with('detailTransaksi')->orderBy('created_at', 'asc'); // Tampilkan data lama ke baru

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('created_at', [
                $request->tanggal_mulai . ' 00:00:00',
                $request->tanggal_selesai . ' 23:59:59'
            ]);
        }

        $transaksi = $query->get();

        return view('laporan.index', compact('transaksi'));
    }

    public function exportPdf()
    {
        // Ambil semua transaksi tanpa filter
        $semuaTransaksi = Transaksi::with(['detailTransaksi.produk', 'user'])
            ->orderBy('created_at', 'asc') // Agar konsisten: lama ke baru
            ->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('semuaTransaksi'))->setPaper('A4', 'portrait');
        return $pdf->stream('laporan_penjualan.pdf');
    }
}
