<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white h-screen p-5 shadow-lg">
            <div class="flex items-center mb-10">
                <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-user"></i>
                </div>
                <span class="ml-3 text-lg font-semibold">Dashboard</span>
            </div>
            <ul>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="#">
                        <i class="fas fa-home mr-3"></i>
                        Home
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="{{ route('products.index') }}">
                        <i class="fas fa-box mr-3"></i>
                        Products
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="#">
                        <i class="fas fa-file-alt mr-3"></i>
                        Report
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="#">
                        <i class="bi bi-key-fill mr-3"></i>
                        Change password
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="#">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-4/5 p-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Produk</h2>
                    <a href="{{ route('products.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded-lg">Tambah Produk</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600">No</th>
                                <th class="px-4 py-2 text-left text-gray-600">Id Produk</th>
                                <th class="px-4 py-2 text-left text-gray-600">Id Kategori</th>
                                <th class="px-4 py-2 text-left text-gray-600">Nama Produk</th>
                                <th class="px-4 py-2 text-left text-gray-600">Deskripsi</th>
                                <th class="px-4 py-2 text-left text-gray-600">Ukuran</th>
                                <th class="px-4 py-2 text-left text-gray-600">Warna</th>
                                <th class="px-4 py-2 text-left text-gray-600">Stok</th>
                                <th class="px-4 py-2 text-left text-gray-600">Foto Produk</th>
                                <th class="px-4 py-2 text-left text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $product->id }}</td>
                                    <td class="px-4 py-2">{{ $product->kategori_id }}</td>
                                    <td class="px-4 py-2">{{ $product->nama_produk }}</td>
                                    <td class="px-4 py-2">{{ $product->deskripsi }}</td>
                                    <td class="px-4 py-2">{{ $product->ukuran }}</td>
                                    <td class="px-4 py-2">{{ $product->warna }}</td>
                                    <td class="px-4 py-2">{{ $product->stok }}</td>
                                    <td class="px-4 py-2">
                                        @if ($product->foto_produk)
                                            <img src="{{ asset('images/' . $product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="rounded" style="max-width: 100px;">
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
</body>
</html>
