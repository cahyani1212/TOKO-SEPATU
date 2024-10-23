<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\kategoricontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

// Route untuk menampilkan form login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk menangani proses login
Route::post('login', [LoginController::class, 'login']);

// Route untuk menangani proses logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('/kategori', kategoricontroller::class);
// Rute untuk dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Resource Route untuk Product (CRUD otomatis di-generate oleh Laravel)
Route::resource('products', ProductController::class);

// Rute tambahan untuk proses penjualan produk
Route::get('products/{product}/sell', [ProductController::class, 'sell'])->name('products.sell');
Route::post('products/{product}/sell', [ProductController::class, 'processSell'])->name('products.processSell');

// Route khusus untuk menyimpan transaksi penjualan produk
Route::post('products/sell', [ProductController::class, 'storeSale'])->name('products.storeSale');
