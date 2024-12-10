<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataUserController;

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

    // Rute untuk menghapus produk
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Rute untuk data user
    Route::get('/data-user', [DataUserController::class, 'index'])->name('data-user');
});

// Rute untuk Telegram Bot
Route::prefix('telegram')->group(function () {
    Route::get('/', [TelegramBotController::class, 'handle'])->name('telegram.index');
    Route::get('/messages', [TelegramBotController::class, 'getMessages'])->name('telegram.messages');
    Route::post('/send-message', [TelegramBotController::class, 'sendMessage'])->name('telegram.sendMessage');
    Route::post('/webhook', [TelegramBotController::class, 'webhook'])->name('telegram.webhook');
});
