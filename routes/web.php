<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Kategoricontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;


// Route untuk menampilkan form login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk menangani proses login
Route::post('login', [LoginController::class, 'login']);
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});