<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/admin', fn() => view('dashboard.admin'))->name('dashboard.admin');
    Route::get('/dashboard/kasir', fn() => view('dashboard.kasir'))->name('dashboard.kasir');

    Route::resource('supplier', SupplierController::class);

    Route::resource('karyawan', UserController::class)
        ->parameters(['karyawan' => 'user']);

    Route::resource('produk', ProdukController::class);
});

Route::post('/', [AuthController::class, 'logout'])->name('logout');
