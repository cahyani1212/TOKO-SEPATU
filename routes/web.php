<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\DataUserController;
use Telegram\Bot\Api;

// Route untuk login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rute dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Resource untuk kategori
Route::resource('/kategori', KategoriController::class);

// Resource untuk produk (CRUD otomatis)
Route::resource('products', ProductController::class);

// Rute tambahan untuk proses penjualan produk
Route::get('products/{product}/sell', [ProductController::class, 'sell'])->name('products.sell');
Route::post('products/{product}/sell', [ProductController::class, 'storeSale'])->name('products.storeSale');

// Rute untuk menghapus produk
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Rute untuk data user
Route::get('/data-user', [DataUserController::class, 'index'])->middleware('auth')->name('data-user');

// Rute Telegram Bot
Route::prefix('telegram')->group(function () {
    Route::get('/', [TelegramBotController::class, 'handle']); // Halaman awal
    Route::get('/messages', [TelegramBotController::class, 'getMessages']); // Pesan Telegram
    Route::get('/messages/{id}', [TelegramBotController::class, 'sendMessage']); // Kirim pesan
    Route::post('/telegram/send-message', [TelegramBotController::class, 'sendMessage']);
    // Rute untuk mendapatkan pesan terbaru dari Telegram
    Route::get('/telegram/messages', [TelegramBotController::class, 'getMessages']);
    Route::post('/webhook', [TelegramBotController::class, 'webhook']);

});