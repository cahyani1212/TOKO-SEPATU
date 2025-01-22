@extends('layouts.layout')

@section('content')
        <!-- Main Content -->
        <main class=" ">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
                <h2 class="text-2xl font-bold mb-6">Tambah Barang</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-black-700">Nama Barang</label>
                        <input type="text" id="name" name="name" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="kategori" class="block text-black-700">Kategori</label>
                        <select id="kategori" name="id_kategori" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-black-700">Deskripsi Barang</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="ukuran" class="block text-black-700">Ukuran</label>
                        <input type="number" id="ukuran" name="ukuran" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="warna" class="block text-black-700">Warna</label>
                        <input type="text" id="warna" name="warna" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="block text-black-700">Stok</label>
                        <input type="number" id="stok" name="stok" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="harga" class="block text-black-700">Harga</label>
                        <input type="number" id="harga" name="harga" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-black-700">Foto Barang</label>
                        <div class="flex items-center">
                            <input type="file" id="image" name="image" class="w-full p-2 border border-blue-500 rounded mt-1">
                            <span class="ml-2 text-black-500"></span>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="w-1/2 bg-blue-700 text-white p-2 rounded mt-4">TAMBAH BARANG</button>
                    </div>
                </form>
            </div>
        </main>
@endsection