@extends('layouts.layout')

@section('content')
        <!-- Main Content -->
        <div class=" p-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-700 to-gray-900 text-white p-6 rounded-lg mb-8 shadow-xl">
                <h1 class="text-3xl font-extrabold text-center">Selamat Datang di Upik Cabon Store</h1>
                <p class="text-center text-gray-300 mt-2">Pantau stok barang dengan mudah dan cepat!</p>
            </div>

            <!-- Dashboard Section -->
            <div>
                <h2 class="text-2xl font-semibold mb-5 text-gray-700">Dashboard Overview</h2>
                <div class="grid grid-cols-3 gap-6">
                    <!-- Card 1: Barang Tersedia -->
                    <a href="{{route('products.index')}}"
                        class="relative bg-blue-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-blue-600 group">
                        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
                            style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
                        </div>
                        <i class="fas fa-box-open text-4xl mb-3"></i>
                        <h2 class="text-2xl font-bold">{{$product}}</h2>
                        <p class="text-sm">Barang Tersedia</p>
                    </a>
                    <!-- Card 2: Barang Habis -->
                    <a href="#"
                        class="relative bg-green-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-green-600 group">
                        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
                            style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
                        </div>
                        <i class="fas fa-boxes text-4xl mb-3"></i>
                        <h2 class="text-2xl font-bold">8</h2>
                        <p class="text-sm">Barang Habis</p>
                    </a>
                    <!-- Card 3: Kategori -->
                    <a href="{{route('kategori.index')}}"
                        class="relative bg-red-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-red-600 group">
                        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
                            style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
                        </div>
                        <i class="fas fa-tags text-4xl mb-3"></i>
                        <h2 class="text-2xl font-bold">{{$kategori}}</h2>
                        <p class="text-sm">Kategori</p>
                    </a>
                    <!-- Card 4: User -->
                    <a href="{{route('user.index')}}"
                        class="relative bg-yellow-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-yellow-600 group">
                        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
                            style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
                        </div>
                        <i class="fas fa-users text-4xl mb-3"></i>
                        <h2 class="text-2xl font-bold">{{$user}}</h2>
                        <p class="text-sm">User</p>
                    </a>

                    <!-- Card 5: Barang Masuk -->
                    <a href="#"
                        class="relative bg-indigo-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-indigo-600 group">
                        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
                            style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
                        </div>
                        <i class="fas fa-arrow-down text-4xl mb-3"></i>
                        <h2 class="text-2xl font-bold">30</h2>
                        <p class="text-sm">Barang Masuk</p>
                    </a>

                    <!-- Card 6: Barang Keluar -->
                    <a href="{{route('sales.index')}}"
                        class="relative bg-orange-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-orange-600 group">
                        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
                            style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
                        </div>
                        <i class="fas fa-arrow-up text-4xl mb-3"></i>
                        <h2 class="text-2xl font-bold">500</h2>
                        <p class="text-sm">Barang Keluar</p>
                    </a>

                </div>
            </div>
        </div>
    </div>
    @endsection