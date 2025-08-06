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

/**
 * LANDING PAGE
 */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**
 * LOGIN
 */
Route::get('/login', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('dashboard.admin')
            : redirect()->route('dashboard.kasir');
    }
    return app(AuthController::class)->showLoginForm();
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

/**
 * LOGOUT
 */
Route::middleware(['auth'])->post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * ADMIN ROUTES
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::resource('categories', CategoryController::class);
    Route::get('/api/supplier/search', [SupplierController::class, 'search'])->name('suppliers.search');
    Route::get('/api/karyawan/search', [UserController::class, 'search'])->name('karyawan.search');
    Route::get('/api/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::get('/api/produk/search', [ProdukController::class, 'search'])->name('produk.search');

    Route::resource('supplier', SupplierController::class);
    Route::resource('karyawan', UserController::class)->parameters(['karyawan' => 'user']);
    Route::resource('produk', ProdukController::class);

    Route::get('kelola_stok/{produk_id}', [LogPerubahanStokController::class, 'index'])->name('produk.kelola_stok');
    Route::post('kelola_stok/{produk_id}', [LogPerubahanStokController::class, 'store'])->name('produk.kelola_stok.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
});

/**
 * KASIR ROUTES
 */
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('/dashboard', [TransaksiController::class, 'index'])->name('dashboard.kasir');

    Route::post('/', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/tambah/{id}', [TransaksiController::class, 'addToCart'])->name('transaksi.add');
    Route::post('/hapus/{id}', [TransaksiController::class, 'remove'])->name('transaksi.remove');
    Route::post('/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');

    Route::post('/simpan', [TransaksiController::class, 'store'])->name('components.modal-pembayaran');
});

/**
 * CETAK NOTA
 */
Route::get('/nota-print/{id}', [TransaksiController::class, 'printNota'])->name('transaksi.print');
