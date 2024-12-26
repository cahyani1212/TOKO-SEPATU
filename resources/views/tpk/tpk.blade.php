@extends('layouts.layout')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-700 to-gray-900 text-white p-6 rounded-lg mb-8 shadow-xl">
        <h1 class="text-3xl font-extrabold text-center">Selamat Datang di Upik Cabon Store</h1>
        <p class="text-center text-gray-300 mt-2">Pantau stok barang dengan mudah dan cepat!</p>
    </div>

    <!-- Produk Table -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold mb-4">Daftar Produk</h2>

        <!-- Tabel Produk (product_jual) -->
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">No</th>
                    <th class="px-4 py-2 text-left text-gray-600">Nama Produk</th>
                    <th class="px-4 py-2 text-left text-gray-600">Jumlah Terjual</th>
                    <th class="px-4 py-2 text-left text-gray-600">Harga</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($produkKelompok as $index => $p)
            <tr class="border-b hover:bg-gray-100">
                <!-- Menampilkan Nomor Urut -->
                <td class="px-4 py-2">{{ (int)$index + 1 }}</td>

                <!-- Menampilkan Nama Barang -->
                <td class="px-4 py-2">{{ $p['nama_brg'] }}</td>

                <!-- Menampilkan Total Jumlah -->
                <td class="px-4 py-2">{{ $p['total_jumlah'] }}</td>

                <!-- Menampilkan Total Harga -->
                <td class="px-4 py-2">{{ number_format($p['total_harga'], 2) }}</td>
            </tr>
        @endforeach
    </tbody>
        </table>

        <!-- Tombol Hitung -->
        <form action="{{ route('tpk.ahp') }}" method="GET" class="mt-6">
    @csrf
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600">Hitung Bobot AHP</button>
</form>

        </form>
    </div>

    @if(isset($produkTerlaris))
        <!-- Tabel Hasil Perhitungan SAW -->
        <div class="bg-white p-6 rounded-lg shadow-lg mt-8">
            <h3 class="text-2xl font-bold mb-4">Hasil Perhitungan SAW</h3>

            <!-- Tabel Hasil SAW -->
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">No</th>
                        <th class="px-4 py-2 text-left text-gray-600">Nama Produk</th>
                        <th class="px-4 py-2 text-left text-gray-600">Jumlah Terjual</th>
                        <th class="px-4 py-2 text-left text-gray-600">Harga</th>
                        <th class="px-4 py-2 text-left text-gray-600">Nilai SAW</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produkTerlaris as $index => $p)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $p->nama_produk }}</td>
                            <td class="px-4 py-2">{{ $p->jumlah_terjual }}</td>
                            <td class="px-4 py-2">{{ number_format($p->harga, 2) }}</td>
                            <td class="px-4 py-2">{{ number_format($p->nilai_saw ?? 0, 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- Tabel hasil perhitungan kosong jika belum dihitung -->
        <div class="bg-white p-6 rounded-lg shadow-lg mt-8">
            <h3 class="text-2xl font-bold mb-4">Hasil Perhitungan SAW</h3>
            <p class="text-gray-500">Perhitungan produk terlaris belum dilakukan. Klik tombol "Hitung Produk Terlaris" untuk memulai perhitungan.</p>
        </div>
    @endif
</div>
@endsection
