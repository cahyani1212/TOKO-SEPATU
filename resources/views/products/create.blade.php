<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
        <div class="w-4/5 p-10">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
                <h2 class="text-2xl font-bold mb-6">Tambah Produk</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="id-produk" class="block text-gray-700">Id produk</label>
                        <input type="text" id="id-produk" name="id" class="w-full p-2 border border-gray-300 rounded mt-1" value="50" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="id-kategori" class="block text-gray-700">Id kategori</label>
                        <input type="text" id="id-kategori" name="id" class="w-full p-2 border border-gray-300 rounded mt-1" value="50" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="nama-produk" class="block text-gray-700">Nama produk</label>
                        <input type="text" id="nama-produk" name="name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi-produk" class="block text-gray-700">Deskripsi produk</label>
                        <input type="text" id="deskripsi-produk" name="description" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="ukuran" class="block text-gray-700">Ukuran</label>
                        <input type="number" id="ukuran" name="price" class="w-full p-2 border border-pink-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="warna" class="block text-gray-700">Warna</label>
                        <input type="text" id="warna" name="price" class="w-full p-2 border border-pink-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="block text-gray-700">stok</label>
                        <input type="number" id="stok" name="price" class="w-full p-2 border border-pink-500 rounded mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="foto-produk" class="block text-gray-700">Foto produk</label>
                        <div class="flex items-center">
                            <input type="file" id="foto-produk" name="image" class="w-full p-2 border border-gray-300 rounded mt-1">
                            <span class="ml-2 text-gray-500">Tidak ada file yang dipilih</span>
                    </div>
                    </div>
                    </div>
                    <button type="submit" class="w-full bg-purple-700 text-white p-2 rounded mt-4">TAMBAH PRODUK</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>