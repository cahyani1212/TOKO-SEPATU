@extends('layouts.layout')

@section('content')
<div class="p-6 container">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-700 to-gray-900 text-white p-6 rounded-lg mb-8 shadow-xl">
        <h1 class="text-3xl font-extrabold text-center">Selamat Datang di Upik Cabon Store</h1>
        <p class="text-center text-gray-300 mt-2">Pantau stok barang dengan mudah dan cepat!</p>
    </div>

    <!-- Produk Table -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Produk</h2>
            <a href="{{ route('products.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded-lg">Tambah
                Produk</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">No</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Id Produk</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Id Kategori</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Nama Produk</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Deskripsi</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Ukuran</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Warna</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Stok</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Harga</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Foto Produk</th>
                        <th class="px-4 py-2 text-left text-gray-600 text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $product->id }}</td>
                            <td class="px-4 py-2">{{ $product->id_kategori }}</td>
                            <td class="px-4 py-2">{{ $product->nama_produk }}</td>
                            <td class="px-4 py-2">{{ $product->deskripsi }}</td>
                            <td class="px-4 py-2">{{ $product->ukuran }}</td>
                            <td class="px-4 py-2">{{ $product->warna }}</td>
                            <td class="px-4 py-2">{{ $product->stok }}</td>
                            <td class="px-4 py-2">{{ $product->price }}</td>
                            <td class="px-4 py-2">
                                @if ($product->foto_produk)
                                    <img src="{{ asset('images/' . $product->foto_produk) }}" alt="{{ $product->nama_produk }}"
                                        class="rounded" style="max-width: 100px;">
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex flex-col space-y-2">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded-lg">Ubah</a>
                                      <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-button bg-red-500 text-white px-3 py-1 rounded-lg">Hapus</button>
                                    </form>



                                    <a href="{{ route('products.sellForm', $product->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded-lg">Jual</a>
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
                const productName = form.getAttribute('data-product');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Produk "${productName}" akan dihapus secara permanen.`,
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