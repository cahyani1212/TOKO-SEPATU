<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Kategoricontroller;
use App\Models\Product;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\PageController; 
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AHPController; // Pastikan AHPController diimport dengan benar


// Rute untuk login dan register
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [LoginController::class, 'register']);

// Route untuk menangani proses logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::resource('/kategori', kategoricontroller::class);
// Rute untuk dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


// Resource Route untuk Product (CRUD otomatis di-generate oleh Laravel)
Route::resource('products', ProductController::class);

// Rute tambahan untuk proses penjualan produk
Route::get('products/{product}/sell', [ProductController::class, 'sell'])->name('products.sell');
Route::post('products/{product}/sell', [ProductController::class, 'storeSale'])->name('products.storeSale');

// Rute untuk dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::middleware([RoleMiddleware::class.':karyawan'])->group(function () {
    // Route::get('user', [UserController::class,'index'])->name('user.index');
});
Route::resource('user', UserController::class);
Route::middleware([RoleMiddleware::class.':admin'])->group(function () {
});
Route::middleware(['auth'])->group(function () {
    // Dashboard hanya bisa diakses oleh pengguna yang sudah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource untuk kategori
    Route::resource('/kategori', KategoriController::class);

    // Resource untuk produk
    Route::resource('products', ProductController::class);

    Route::resource('penjualan', PenjualanController::class);
    Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::get('/penjualan/create/{productId}', [PenjualanController::class, 'create'])->name('penjualan.create');

    // Rute tambahan untuk proses penjualan produk
    Route::get('/products/{id}/sell', [ProductController::class, 'showSaleForm'])->name('products.sellForm');
    Route::post('/products/{id}/sell', [ProductController::class, 'storeSale'])->name('products.storeSale');
    
    // Rute untuk data user
    // Route::get('/datauser', [DataUserController::class, 'index'])->name('datauser');
});

// Rute untuk Telegram Bot
Route::post('/webhook', [TelegramBotController::class, 'handle']);

// Halaman Home
// Route::get('/home', [PageController::class,'home'])->name('home');
Route::group(['prefix' => 'telegram'], function(){
    Route::get('messages', [TelegramBotController::class, 'messages']);
});
// Rute alternatif dan kriteria
// Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
// Route::resource('alternatif', AlternatifController::class);
// Route::resource('kriteria', KriteriaController::class);
// Route::resource('/nilai', NilaiController::class);

// Rute untuk menghitung
// Route::get('/hitung', [HitungController::class, 'index'])->name('hitung.index');

// Rute TPK
Route::get('/tpk', [KriteriaController::class, 'index'])->name('tpk.index');
Route::post('/tpk/hitung', [KriteriaController::class, 'hitungTerlaris'])->name('tpk.hitung');

// Rute untuk AHP
Route::get('/ahp', [AHPController::class, 'index'])->name('ahp.index');
Route::post('/ahp/store', [AHPController::class, 'store'])->name('ahp.store'); // Perbaikan rute untuk menyimpan nilai perbandingan AHP
Route::post('/ahp/calculate', [AHPController::class, 'calculateAHP'])->name('ahp.calculate'); // Rute untuk menghitung bobot AHP
Route::get('/hitung', [AHPController::class, 'hitung'])->name('ahp.hitung');
Route::get('/tpk/ahp', [AHPController::class, 'index'])->name('tpk.ahp');