<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-red-700 h-screen p-5 text-white shadow-2xl">
            <div class="flex items-center mb-10">
                <!-- Logo -->
                <img 
                    src="https://i.pinimg.com/736x/76/9e/ad/769eaded1b6f4ca3349e1733928da9b9.jpg" 
                    alt="Upik Cabon Logo" 
                    class="w-12 h-12 rounded-full mr-3 object-cover border-2 border-red-300"
                />
                <span class="text-lg font-bold">Upik Cabon Store</span>
            </div>
            <ul>
                <li class="mb-4">
                    <a class="flex items-center text-white hover:text-red-300 transition-all duration-200" href="#">
                        <i class="fas fa-home mr-3"></i>
                        Home
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-white hover:text-red-300 transition-all duration-200" href="{{ route('products.index') }}">
                        <i class="fas fa-box mr-3"></i>
                        Products
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-white hover:text-red-300 transition-all duration-200" href="#">
                        <i class="fas fa-file-alt mr-3"></i>
                        Report
                    </a>
                </li>
                <li class="mb-4">
                    <a class="flex items-center text-white hover:text-red-300 transition-all duration-200" href="#">
                        <i class="bi bi-people-fill mr-3"></i>
                        User
                    </a>
                </li>
                <li class="mb-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-white hover:text-red-300 transition-all duration-200">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-4/5 p-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-700 to-gray-900 text-white p-6 rounded-lg mb-8 shadow-xl">
                <h1 class="text-3xl font-extrabold text-center">Selamat Datang di Upik Cabon Store</h1>
                <p class="text-center text-gray-300 mt-2">Pantau stok barang dengan mudah dan cepat!</p>
            </div>

            <!-- Dashboard Section -->
            <div>
                <h2 class="text-2xl font-semibold mb-5 text-gray-700">Dashboard Overview</h2>
                <div class="grid grid-cols-3 gap-6">
                    <!-- Card 1: Barang Tersedia -->
                    <a href="#" class="relative bg-blue-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-blue-600 group">
        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300" 
             style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
        </div>
        <i class="fas fa-box-open text-4xl mb-3"></i>
        <h2 class="text-2xl font-bold">10</h2>
        <p class="text-sm">Barang Tersedia</p>
    </a>
                    <!-- Card 2: Barang Habis -->
                    <a href="#" class="relative bg-green-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-green-600 group">
        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300" 
             style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
        </div>
        <i class="fas fa-boxes text-4xl mb-3"></i>
        <h2 class="text-2xl font-bold">8</h2>
        <p class="text-sm">Barang Habis</p>
    </a>
                    <!-- Card 3: Kategori -->
                    <a href="#" class="relative bg-red-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-red-600 group">
        <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300" 
             style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
        </div>
        <i class="fas fa-tags text-4xl mb-3"></i>
        <h2 class="text-2xl font-bold">4</h2>
        <p class="text-sm">Kategori</p>
    </a>
                    <!-- Card 4: User -->
<a href="#" class="relative bg-yellow-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-yellow-600 group">
    <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300" 
         style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
    </div>
    <i class="fas fa-users text-4xl mb-3"></i>
    <h2 class="text-2xl font-bold">35</h2>
    <p class="text-sm">User</p>
</a>

<!-- Card 5: Barang Masuk -->
<a href="#" class="relative bg-indigo-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-indigo-600 group">
    <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
         style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
    </div>
    <i class="fas fa-arrow-down text-4xl mb-3"></i>
    <h2 class="text-2xl font-bold">30</h2>
    <p class="text-sm">Barang Masuk</p>
</a>

<!-- Card 6: Barang Keluar -->
<a href="#" class="relative bg-orange-100 rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-orange-600 group">
    <div class="absolute inset-0 -z-10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"
         style="background: linear-gradient(45deg, red, black); filter: blur(10px);">
    </div>
    <i class="fas fa-arrow-up text-4xl mb-3"></i>
    <h2 class="text-2xl font-bold">500</h2>
    <p class="text-sm">Barang Keluar</p>
</a>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
