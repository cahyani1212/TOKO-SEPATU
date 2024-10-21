<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white h-screen p-5">
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
                    <button class="bg-pink-500 text-white px-4 py-2 rounded-lg">TAMBAH PRODUK</button>
                </div>
                <table class="table table-striped table-hover w-full text-left">
                    <thead>
                        <tr class="text-gray-500">
                            <th>No</th>
                            <th>Id produk</th>
                            <th>Id kategori</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Ukuran</th>
                            <th>Warna</th>
                            <th>Stok</th>
                            <th>Foto Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>001</td>
                            <td>01</td>
                            <td>Sepatu Sneakers</td>
                            <td>Deskripsi Sepatu Sneakers</td>
                            <td>42</td>
                            <td>Hitam</td>
                            <td>50</td>
                            <td>
                                <img src="https://via.placeholder.com/50" alt="Sepatu Sneakers" class="rounded">
                            </td>
                            <td>
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2">UBAH</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg">HAPUS</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>002</td>
                            <td>02</td>
                            <td>Sepatu Olahraga</td>
                            <td>Deskripsi Sepatu Olahraga</td>
                            <td>41</td>
                            <td>Biru</td>
                            <td>30</td>
                            <td>
                                <img src="https://via.placeholder.com/50" alt="Sepatu Olahraga" class="rounded">
                            </td>
                            <td>
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2">UBAH</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg">HAPUS</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>003</td>
                            <td>03</td>
                            <td>Sepatu Formal</td>
                            <td>Deskripsi Sepatu Formal</td>
                            <td>43</td>
                            <td>Coklat</td>
                            <td>20</td>
                            <td>
                                <img src="https://via.placeholder.com/50" alt="Sepatu Formal" class="rounded">
                            </td>
                            <td>
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2">UBAH</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg">HAPUS</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>