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
    $totalKaryawan = User::whereIn('role', ['kasir', 'admin'])->count();
    $totalSupplier = Supplier::count();

    // Pendapatan & produk terjual hari ini
    $hariIni = Carbon::today();
    $pendapatanHariIni = Transaksi::whereDate('created_at', $hariIni)->sum('total_harga');
    $produkTerjualHariIni = Transaksi::whereDate('created_at', $hariIni)
        ->with('detailTransaksi')
        ->get()
        ->flatMap->detailTransaksi
        ->sum('jumlah');

    // Pendapatan & produk terjual bulan ini
    $bulanIni = Carbon::now()->format('Y-m');
    $pendapatanBulanIni = Transaksi::whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('total_harga');

    $produkTerjualBulanIni = Transaksi::whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->with('detailTransaksi')
        ->get()
        ->flatMap->detailTransaksi
        ->sum('jumlah');

   // Diganti menjadi: penjualan hari ini
    $penjualanHariIni = Transaksi::with(['user', 'detailTransaksi.produk'])
        ->whereDate('created_at', Carbon::today())
        ->latest()
        ->get();


    // Grafik 7 hari terakhir
    $chartLabels = [];
    $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $tanggal = Carbon::now()->subDays($i);
        $label = $tanggal->format('D, d M');
        $total = Transaksi::whereDate('created_at', $tanggal->toDateString())->sum('total_harga');

        $chartLabels[] = $label;
        $chartData[] = $total;
    }

    return view('dashboard.admin', compact(
        'totalProduk',
        'totalKaryawan',
        'totalSupplier',
        'pendapatanHariIni',
        'pendapatanBulanIni',
        'produkTerjualHariIni',
        'produkTerjualBulanIni',
        'penjualanHariIni',
        'chartLabels',
        'chartData'
    ));
}
}
