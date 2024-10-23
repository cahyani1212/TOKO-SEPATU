<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);

// Route untuk menampilkan form login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk menangani proses login
Route::post('login', [LoginController::class, 'login']);

// Rute untuk dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Route untuk menangani proses logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Rute untuk menyimpan produk baru
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::resource('products', ProductController::class);


// Rute untuk mengedit produk
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Rute untuk mengupdate produk (menggunakan metode PUT atau PATCH)
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::get('products/{id}/sell', [ProductsController::class, 'sell'])->name('products.sell');
Route::post('products/{id}/sell', [ProductsController::class, 'processSell'])->name('products.processSell');
// Rute untuk menjual produk
Route::get('products/{product}/sell', [ProductController::class, 'sell'])->name('products.sell');
Route::post('products/sell', [ProductController::class, 'storeSale'])->name('products.storeSale');
