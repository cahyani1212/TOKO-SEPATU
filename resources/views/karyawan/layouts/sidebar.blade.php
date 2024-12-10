<div class="w-64 bg-white h-screen p-5 shadow-lg fixed">
    <!-- Header Sidebar -->
    <div class="flex items-center mb-8">
        <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white text-xl">
            <i class="fas fa-user"></i>
        </div>
        <span class="ml-4 text-xl font-bold text-gray-800">Upik Cabon Store</span>
    </div>

    <!-- Menu -->
    <ul class="space-y-4">
        <li>
            <a class="flex items-center text-gray-700 hover:text-blue-500 transition-colors" href="#">
                <i class="fas fa-home text-lg mr-4"></i>
                <span class="text-sm font-medium">Home</span>
            </a>
        </li>
        <li>
            <a class="flex items-center text-gray-700 hover:text-pink-500 transition-colors" href="{{ route('products.index') }}">
                <i class="fas fa-box text-lg mr-4"></i>
                <span class="text-sm font-medium">Products</span>
            </a>
        </li>
        <li>
            <a class="flex items-center text-gray-700 hover:text-pink-500 transition-colors" href="{{ route('kategori.index') }}">
                <i class="fas fa-tags text-lg mr-4"></i>
                <span class="text-sm font-medium">Kategori</span>
            </a>
        </li>
        <li>
            <a class="flex items-center text-gray-700 hover:text-pink-500 transition-colors" href="#">
                <i class="fas fa-file-alt text-lg mr-4"></i>
                <span class="text-sm font-medium">Report</span>
            </a>
        </li>
        <li>
            <a class="flex items-center text-gray-700 hover:text-pink-500 transition-colors" href="#">
                <i class="fas fa-user-cog text-lg mr-4"></i>
                <span class="text-sm font-medium">User</span>
            </a>
        </li>
        <li>
            <a class="flex items-center text-gray-700 hover:text-red-500 transition-colors" href="#">
                <i class="fas fa-sign-out-alt text-lg mr-4"></i>
                <span class="text-sm font-medium">Logout</span>
            </a>
        </li>
    </ul>
</div>
