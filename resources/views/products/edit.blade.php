@extends('layouts.layout')

@section('content')



        <!-- Main Content: Edit Form -->
        <div class=" p-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6">Edit Produk</h2>

                <!-- Tampilkan pesan sukses jika ada -->
                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tampilkan pesan error jika ada -->
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Nama Produk</label>
                            <input type="text" name="nama_produk" value="{{ old('name', $product->nama_produk) }}" class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Kategori</label>
                            <select name="id_kategori"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('id_kategori', $product->id_kategori) == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">{{ old('description', $product->deskripsi) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700">Ukuran</label>
                            <input type="text" name="ukuran" value="{{ old('ukuran', $product->ukuran) }}" class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Warna</label>
                            <input type="text" name="warna" value="{{ old('warna', $product->warna) }}" class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $product->stok) }}" class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Harga</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Foto Produk</label>
                            <input type="file" name="foto_produk" class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                            @if ($product->foto_produk)
                                <img src="{{ asset('images/' . $product->foto_produk) }}" alt="{{ $product->name }}" class="mt-2 rounded-md" style="max-width: 100px;">
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
