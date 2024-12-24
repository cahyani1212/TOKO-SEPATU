<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\PageController; 
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\HitungController;

// Rute untuk login dan register
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [LoginController::class, 'register']);

// Rute dengan proteksi middleware auth
Route::middleware(['auth'])->group(function () {
    // Dashboard hanya bisa diakses oleh pengguna yang sudah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource untuk kategori
    Route::resource('/kategori', KategoriController::class);

    // Resource untuk produk
    Route::resource('products', ProductController::class);

    // Rute tambahan untuk proses penjualan produk
    Route::get('products/{product}/sell', [ProductController::class, 'sell'])->name('products.sell');
    Route::post('products/{product}/sell', [ProductController::class, 'storeSale'])->name('products.storeSale');

    // Rute untuk data user
    Route::get('/datauser', [DataUserController::class, 'index'])->name('datauser');
});

// Rute untuk Telegram Bot
Route::post('/webhook', [TelegramBotController::class, 'handle']);

// Halaman Home
Route::get('/home', [PageController::class,'home'])->name('home');

// Rute alternatif dan kriteria
Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
Route::resource('alternatif', AlternatifController::class);
Route::resource('kriteria', KriteriaController::class);
Route::resource('/nilai', NilaiController::class);

// Rute untuk menghitung
Route::get('/hitung', [HitungController::class, 'index'])->name('hitung.index');

// Rute TPK
Route::get('/tpk', [KriteriaController::class, 'index'])->name('tpk.index');
Route::post('/tpk/hitung', [KriteriaController::class, 'hitungTerlaris'])->name('tpk.hitung');
