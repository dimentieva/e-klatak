<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', fn() => view('dashboard.admin'))->name('dashboard.admin');
    Route::get('/dashboard/kasir', fn() => view('dashboard.kasir'))->name('dashboard.kasir');
});
Route::resource('supplier', SupplierController::class)->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('karyawan', UserController::class)
    ->middleware('auth')
    ->parameters(['karyawan' => 'user']);
