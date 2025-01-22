@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-700 to-gray-900 text-white p-6 rounded-lg mb-8 shadow-xl">
                <h1 class="text-3xl font-extrabold text-center">Selamat Datang di Upik Cabon Store</h1>
                <p class="text-center text-gray-300 mt-2">Pantau stok barang dengan mudah dan cepat!</p>
            </div>

    <!-- Produk Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Daftar Barang</h2>
            <a href="{{ route('products.create') }}" class="bg-pink-600 text-white px-5 py-2 rounded-lg hover:bg-pink-500 transition duration-300">Tambah Barang</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">No</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Id Barang</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Id Kategori</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Nama Barang</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Ukuran</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Warna</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Stok</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Harga</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Foto Barang</th>
                        <th class="px-4 py-3 text-center text-gray-600 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $product->id }}</td>
                            <td class="px-4 py-3">{{ $product->id_kategori }}</td>
                            <td class="px-4 py-3">{{ $product->nama_produk }}</td>
                            <td class="px-4 py-3">{{ $product->deskripsi }}</td>
                            <td class="px-4 py-3">{{ $product->ukuran }}</td>
                            <td class="px-4 py-3">{{ $product->warna }}</td>
                            <td class="px-4 py-3">{{ $product->stok }}</td>
                            <td class="px-4 py-3">{{ $product->price }}</td>
                            <td class="px-4 py-3">
                                @if ($product->foto_produk)
                                    <img src="{{ asset('images/' . $product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="rounded shadow-sm max-w-[100px]">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-wrap gap-2 justify-center">
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-400 transition duration-300 flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Ubah
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-button bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-400 transition duration-300 flex items-center">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                    <a href="{{ route('products.sellForm', $product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-400 transition duration-300 flex items-center">
                                        <i class="fas fa-shopping-cart mr-1"></i> Jual
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                const productName = form.getAttribute('data-product') || 'Produk';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `${productName} akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection