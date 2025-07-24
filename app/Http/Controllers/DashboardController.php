<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalPendapatan = Transaksi::sum('total_harga'); // Pastikan kolom 'total' benar
        $totalKaryawan = User::whereIn('role', ['kasir', 'admin'])->count();

        $totalSupplier = Supplier::count();

        $penjualanTerbaru = Transaksi::with(['user', 'detailTransaksi.produk'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'totalProduk',
            'totalPendapatan',
            'totalKaryawan',
            'totalSupplier',
            'penjualanTerbaru'
        ));
    }
}
