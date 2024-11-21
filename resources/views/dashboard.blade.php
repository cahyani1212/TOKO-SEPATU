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
                <!-- Logo -->
                <img 
                    src="https://i.pinimg.com/736x/76/9e/ad/769eaded1b6f4ca3349e1733928da9b9.jpg" 
                    alt="Upik Cabon Logo" 
                    class="w-12 h-12 rounded-full mr-3 object-cover"
                />
                <span class="text-lg font-semibold text-gray-700">Upik Cabon Store</span>
            </div>
            <ul>
                <li class="mb-4">
                    <a class="flex items-center text-gray-700 hover:text-blue-500" href="#">
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
                        <i class="bi bi-people-fill mr-3"></i>
                        User
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
        <div class="w-4/5 p-5">
            <div class="bg-purple-500 text-white p-5 rounded-lg mb-5">
                <div class="flex items-center">
                    <i class="fas fa-user-circle text-2xl mr-3"></i>
                    <span>Selamat datang di website Upik Cabon Store</span>
                </div>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-5">Produk Terkini</h2>
                <div class="grid grid-cols-4 gap-5">
                    <div class="bg-white p-5 rounded-lg shadow">
                        <img alt="Colorful sneakers" class="w-full h-40 object-cover mb-3" height="150" src="https://storage.googleapis.com/a1aa/image/Cnendf8LtJi7TEY8MP8CuNzb2KlwqzObPZq101WpKx5dasoTA.jpg" width="150"/>
                        <p class="text-center">Colorful Sneakers</p>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow">
                        <img alt="White sneakers with gold logo" class="w-full h-40 object-cover mb-3" height="150" src="https://storage.googleapis.com/a1aa/image/qM1LJCMee2ohLUBFJgUOxKWxR0mKdcLfGNlE1ryHfE4AqxiOB.jpg" width="150"/>
                        <p class="text-center">White Sneakers</p>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow">
                        <img alt="Black and white sneakers" class="w-full h-40 object-cover mb-3" height="150" src="https://storage.googleapis.com/a1aa/image/Bwa0ymByeIUMTSH1A84vl9cO3a63ll8tdK8Bt9haOf3kasoTA.jpg" width="150"/>
                        <p class="text-center">Black Sneakers</p>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow">
                        <img alt="Pink sneakers" class="w-full h-40 object-cover mb-3" height="150" src="https://storage.googleapis.com/a1aa/image/H9kcl2op1IKsAt3ytU0zC86PKpeUIHXjsUUIfwVIG8te0YRnA.jpg" width="150"/>
                        <p class="text-center">Pink Sneakers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
