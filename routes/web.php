<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

// Route untuk menampilkan form login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk menangani proses login
Route::post('login', [LoginController::class, 'login']);

// Rute untuk dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Route untuk menangani proses logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
