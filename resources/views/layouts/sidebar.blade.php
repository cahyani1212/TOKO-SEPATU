<div class="w-1/5 bg-white h-screen p-3 shadow-lg">
    <div class="flex items-center mb-10">
        <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white">
            <i class="fas fa-user"></i>
        </div>
        <span class="ml-3 text-lg font-semibold">Upik Cabon Store</span>
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
            <a class="flex items-center text-gray-700 hover:text-pink-500" href="{{ route('kategori.index') }}">
                <i class="fas fa-box mr-3"></i>
                Kategori
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