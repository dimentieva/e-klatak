<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalPendapatan = Transaksi::sum('total_harga');
        $totalKaryawan = User::whereIn('role', ['kasir', 'admin'])->count();
        $totalSupplier = Supplier::count();

        $penjualanTerbaru = Transaksi::with(['user', 'detailTransaksi.produk'])
            ->latest()
            ->take(5)
            ->get();

        // Tambahan untuk grafik pendapatan 7 hari terakhir
        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
            $label = $tanggal->format('d M');
            $total = Transaksi::whereDate('created_at', $tanggal->toDateString())->sum('total_harga');

            $chartLabels[] = $label;
            $chartData[] = $total;
        }

        return view('dashboard.admin', compact(
            'totalProduk',
            'totalPendapatan',
            'totalKaryawan',
            'totalSupplier',
            'penjualanTerbaru',
            'chartLabels',
            'chartData'
        ));
    }
}
