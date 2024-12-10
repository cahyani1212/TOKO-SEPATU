@extends('layouts.layout')

@section('content')
    <!-- Main Content -->
    <div class=" p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6">Penjualan - Informasi Produk</h2>
            
            <!-- Informasi Produk -->
            <table class="min-w-full table-auto mb-6">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Id Produk</th>
                        <th class="px-4 py-2 text-left text-gray-600">Nama Barang</th>
                        <th class="px-4 py-2 text-left text-gray-600">Deskripsi</th>
                        <th class="px-4 py-2 text-left text-gray-600">Ukuran</th>
                        <th class="px-4 py-2 text-left text-gray-600">Warna</th>
                        <th class="px-4 py-2 text-left text-gray-600">Harga</th>
                        <th class="px-4 py-2 text-left text-gray-600">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $product->id }}</td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->description }}</td>
                        <td class="px-4 py-2">{{ $product->ukuran }}</td>
                        <td class="px-4 py-2">{{ $product->warna }}</td>
                        <td class="px-4 py-2">{{ number_format($product->price, 0, ',', '.') }} IDR</td>
                        <td class="px-4 py-2">{{ $product->stok }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Form Penjualan -->
            <h3 class="text-2xl font-bold mb-4">Detail Penjualan</h3>
            <form action="{{ route('products.storeSale', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_brg" value="{{ $product->name }}" required class="border rounded px-2 py-1 w-full" >
                    </div>
                    <div>
                        <label class="block text-gray-700">Warna</label>
                        <input type="text" name="warna" value="{{ $product->warna }}" required class="border rounded px-2 py-1 w-full" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700">Ukuran</label>
                        <input type="text" name="ukuran" value="{{ $product->ukuran }}" required class="border rounded px-2 py-1 w-full" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700">Harga Satuan</label>
                        <input type="text" name="harga_satuan" value="{{ $product->price }}" required class="border rounded px-2 py-1 w-full" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700">Jumlah Penjualan</label>
                        <input type="number" id="quantity" name="jumlah" min="1" max="{{ $product->stok }}" required class="border rounded px-2 py-1 w-full" placeholder="Jumlah" oninput="calculateTotal()">
                    </div>
                    <div>
                        <label class="block text-gray-700">Total Harga</label>
                        <input type="text" id="total_harga" name="total_harga" required class="border rounded px-2 py-1 w-full" placeholder="Total Harga" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700">Tanggal Penjualan</label>
                        <input type="date" name="tgl_keluar" required class="border rounded px-2 py-1 w-full">
                    </div>
                    <div>
                        <label class="block text-gray-700">Catatan Penjualan</label>
                        <input type="text" name="catatan" class="border rounded px-2 py-1 w-full" placeholder="Catatan">
                    </div>
                </div>
                <input type="hidden" id="price" value="{{ $product->price }}">
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-lg mt-4">Jual</button>
            </form>

            <!-- Script untuk Kalkulasi Harga -->
            <script>
                function calculateTotal() {
                    const quantity = document.getElementById('quantity').value;
                    const price = parseFloat(document.getElementById('price').value);
                    const totalHarga = quantity * price;
                    document.getElementById('total_harga').value = totalHarga.toLocaleString('id-ID') + ' IDR';
                }
            </script>
        </div>
    </div>
@endsection
