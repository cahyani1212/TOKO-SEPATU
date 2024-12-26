<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
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
                        <i class="fas fa-home mr-3"></i> Home
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="{{ route('products.index') }}">
                        <i class="fas fa-box mr-3"></i> Products
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="#">
                        <i class="fas fa-file-alt mr-3"></i> Report
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="#">
                        <i class="bi bi-key-fill mr-3"></i> User
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-pink-500" href="#">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content: Edit Form -->
        <div class="w-4/5 p-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6">Edit Produk</h2>

                <!-- Tampilkan pesan sukses jika ada -->
                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tampilkan pesan error jika ada -->
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Nama Produk</label>
                            <input type="text" name="name" value="{{ old('name', $product->nama_produk) }}"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Kategori</label>
                            <select name="id_kategori"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('id_kategori', $product->id_kategori) == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Deskripsi</label>
                            <textarea name="description"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">{{ old('description', $product->deskripsi) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700">Ukuran</label>
                            <input type="text" name="ukuran" value="{{ old('ukuran', $product->ukuran) }}"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Warna</label>
                            <input type="text" name="warna" value="{{ old('warna', $product->warna) }}"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $product->stok) }}"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Harga</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-gray-700">Foto Produk</label>
                            <input type="file" name="foto_produk"
                                class="w-full p-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                            @if ($product->foto_produk)
                                <img src="{{ asset('images/' . $product->foto_produk) }}" alt="{{ $product->name }}"
                                    class="mt-2 rounded-md" style="max-width: 100px;">
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>