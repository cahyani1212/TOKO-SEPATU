<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-1/5 bg-white h-screen p-5 shadow-lg">
            <div class="flex items-center mb-10">
                <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-user"></i>
                </div>
                <span class="ml-3 text-lg font-semibold">Dashboard</span>
            </div>
            <nav>
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
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="w-4/5 p-10">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
                <h2 class="text-2xl font-bold mb-6">Tambah Produk</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-black-700">Nama produk</label>
                        <input type="text" id="name" name="name" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="kategori" class="block text-black-700">Kategori</label>
                        <select id="kategori" name="id_kategori" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-black-700">Deskripsi Produk</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="ukuran" class="block text-black-700">Ukuran</label>
                        <input type="number" id="ukuran" name="ukuran" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="warna" class="block text-black-700">Warna</label>
                        <input type="text" id="warna" name="warna" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="block text-black-700">Stok</label>
                        <input type="number" id="stok" name="stok" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="harga" class="block text-black-700">Harga</label>
                        <input type="number" id="harga" name="harga" class="w-full p-2 border border-blue-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-black-700">Foto produk</label>
                        <div class="flex items-center">
                            <input type="file" id="image" name="image" class="w-full p-2 border border-blue-500 rounded mt-1">
                            <span class="ml-2 text-black-500"></span>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="w-1/2 bg-blue-700 text-white p-2 rounded mt-4">TAMBAH PRODUK</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>