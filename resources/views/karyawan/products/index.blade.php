@extends('layouts.layout')

@section('content')
    <div class="container">
        
 <!-- Main Content -->
            <div class=" p-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Produk</h2>
                        <a href="{{ route('products.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded-lg">Tambah Produk</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto table-border">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-600">No</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Kategori</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Nama Produk</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Deskripsi</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Ukuran</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Warna</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Stok</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Harga</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Foto Produk</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $no => $product)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="px-4 py-2">{{ $no + 1 }}</td>
                                        <td class="px-4 py-2">{{ $product->Category->nama_kategori ?? '' }}</td>
                                        <td class="px-4 py-2">{{ $product->nama_produk ?? '' }}</td>
                                        <td class="px-4 py-2">{{ $product->deskripsi ?? '' }}</td>
                                        <td class="px-4 py-2">{{ $product->ukuran ?? '' }}</td>
                                        <td class="px-4 py-2">{{ $product->warna ?? '' }}</td>
                                        <td class="px-4 py-2">{{ $product->stok ?? '' }}</td>
                                        <td class="px-4 py-2">{{ $product->price ?? '' }}</td>
                                        <td class="px-4 py-2">
                                            @if ($product->foto_produk)
                                                <img src="{{ asset('images/' . $product->foto_produk) }}" alt="{{ $product->nama_produk ?? '' }}" class="rounded" style="max-width: 100px;">
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex flex-col space-y-2">
                                                <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-lg">Ubah</a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg">Hapus</button>
                                                </form>
                                                <a href="{{ route('products.sell', $product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg">Jual</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

