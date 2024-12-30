@extends('layouts.layout')

@section('content')
    <div class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6">Detail Penjualan</h2>

            <table class="min-w-full table-auto mb-6">
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-bold">ID Penjualan</td>
                        <td class="px-4 py-2">{{ $sale->id }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Nama Barang</td>
                        <td class="px-4 py-2">{{ $sale->nama_brg }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Jumlah</td>
                        <td class="px-4 py-2">{{ $sale->jumlah }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Ukuran</td>
                        <td class="px-4 py-2">{{ $sale->ukuran }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Warna</td>
                        <td class="px-4 py-2">{{ $sale->warna }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Harga Satuan</td>
                        <td class="px-4 py-2">{{ number_format($sale->harga_satuan, 0, ',', '.') }} IDR</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Total Harga</td>
                        <td class="px-4 py-2">{{ number_format($sale->total_harga, 0, ',', '.') }} IDR</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Tanggal Keluar</td>
                        <td class="px-4 py-2">{{ $sale->tgl_keluar }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold">Catatan</td>
                        <td class="px-4 py-2">{{ $sale->catatan }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('sales.index') }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg">Kembali</a>
        </div>
    </div>
@endsection
