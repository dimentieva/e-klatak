<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LogPerubahanStokController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransaksiController;

// Halaman login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// Semua route yang butuh login
Route::middleware(['auth'])->group(function () {

    // Dashboard admin dan kasir
    Route::get('/dashboard/admin', fn() => view('dashboard.admin'))->name('dashboard.admin');
    Route::get('/dashboard/kasir', [TransaksiController::class, 'index'])->name('dashboard.kasir');

    // Profil
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    // Manajemen data
    Route::resource('categories', CategoryController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('karyawan', UserController::class)->parameters(['karyawan' => 'user']);
    Route::resource('produk', ProdukController::class);

    // Transaksi kasir (POS)
    Route::get('/kasir', [TransaksiController::class, 'index'])->name('transaksi.index'); // Halaman kasir
    Route::post('/kasir', [TransaksiController::class, 'store'])->name('transaksi.store'); // Simpan transaksi
    Route::post('/kasir/tambah/{id}', [TransaksiController::class, 'addToCart'])->name('transaksi.add'); // Tambah item ke keranjang
    Route::post('/kasir/hapus/{id}', [TransaksiController::class, 'remove'])->name('transaksi.remove'); // Hapus item dari keranjang
    Route::post('/kasir/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout'); // Proses pembayaran

    // Log perubahan stok
    Route::get('kelola_stok/{produk_id}', [LogPerubahanStokController::class, 'index'])->name('produk.kelola_stok');
    Route::post('kelola_stok/{produk_id}', [LogPerubahanStokController::class, 'store'])->name('produk.kelola_stok.store');


    Route::post('/transaksi/simpan', [TransaksiController::class, 'store'])->name('components.modal-pembayaran');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
