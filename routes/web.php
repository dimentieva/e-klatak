<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LogPerubahanStokController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('dashboard.admin')
            : redirect()->route('dashboard.kasir');
    }
    return app(AuthController::class)->showLoginForm();
})->name('login');

// Proses login
Route::post('/', [AuthController::class, 'login']);

// Semua route yang memerlukan login
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // =======================
    // ROUTE UNTUK ADMIN SAJA
    // =======================
    Route::middleware('role:admin')->group(function () {
        // Dashboard Admin
        Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');

        // Profil
        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

        // Manajemen Data
        Route::resource('categories', CategoryController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('karyawan', UserController::class)->parameters(['karyawan' => 'user']);
        Route::resource('produk', ProdukController::class);

        // Log Perubahan Stok
        Route::get('kelola_stok/{produk_id}', [LogPerubahanStokController::class, 'index'])->name('produk.kelola_stok');
        Route::post('kelola_stok/{produk_id}', [LogPerubahanStokController::class, 'store'])->name('produk.kelola_stok.store');

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    });

    // =======================
    // ROUTE UNTUK KASIR SAJA
    // =======================
    Route::middleware('role:kasir')->group(function () {
        // Dashboard Kasir
        Route::get('/dashboard/kasir', [TransaksiController::class, 'index'])->name('dashboard.kasir');

        // Transaksi (POS)
        Route::post('/kasir', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::post('/kasir/tambah/{id}', [TransaksiController::class, 'addToCart'])->name('transaksi.add');
        Route::post('/kasir/hapus/{id}', [TransaksiController::class, 'remove'])->name('transaksi.remove');
        Route::post('/kasir/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');

        // Simpan transaksi dari modal pembayaran
        Route::post('/transaksi/simpan', [TransaksiController::class, 'store'])->name('components.modal-pembayaran');
    });
});
