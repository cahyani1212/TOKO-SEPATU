@extends('layouts.layout')

@section('content')
<div class="p-6">
<div class="bg-gradient-to-r from-red-700 to-gray-900 text-white p-6 rounded-lg mb-8 shadow-xl">
                <h1 class="text-3xl font-extrabold text-center">Selamat Datang di Upik Cabon Store</h1>
                <p class="text-center text-gray-300 mt-2">Pantau stok barang dengan mudah dan cepat!</p>
            </div>
    <div class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6">Daftar Penjualan</h2>

            <!-- Tabel Penjualan -->
            <table class="min-w-full table-auto mb-6">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600">Nama Barang</th>
                        <th class="px-4 py-2 text-left text-gray-600">Jumlah</th>
                        <th class="px-4 py-2 text-left text-gray-600">Ukuran</th>
                        <th class="px-4 py-2 text-left text-gray-600">Warna</th>
                        <th class="px-4 py-2 text-left text-gray-600">Total Harga</th>
                        <th class="px-4 py-2 text-left text-gray-600">Tanggal Keluar</th>
                        <th class="px-4 py-2 text-left text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $sale->id }}</td>
                            <td class="px-4 py-2">{{ $sale->nama_brg }}</td>
                            <td class="px-4 py-2">{{ $sale->jumlah }}</td>
                            <td class="px-4 py-2">{{ $sale->ukuran }}</td>
                            <td class="px-4 py-2">{{ $sale->warna }}</td>
                            <td class="px-4 py-2">{{ number_format($sale->total_harga, 0, ',', '.') }} IDR</td>
                            <td class="px-4 py-2">{{ $sale->tgl_keluar }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('sales.show', $sale->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center text-gray-500">Tidak ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $sales->links() }}
            </div>
        </div>
    </div>
@endsection
