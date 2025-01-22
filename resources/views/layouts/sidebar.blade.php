<!-- Sidebar with Animation -->
<div class="bg-gradient-to-b from-gray-900 to-red-700 h-screen p-4 text-white shadow-2xl">
    <div class="flex items-center mb-10 animate-fade-in-down">
        <!-- Logo -->
        <img src="https://i.pinimg.com/736x/76/9e/ad/769eaded1b6f4ca3349e1733928da9b9.jpg" alt="Upik Cabon Logo"
            class="w-12 h-12 rounded-full mr-3 object-cover border-2 border-red-300 transform hover:scale-110 transition-transform duration-300" />
        <span class="text-lg font-bold">Upik Cabon Store</span>
    </div>
    <ul>
        <li class="mb-4">
            <a class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2" href="{{ route('dashboard') }}">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
        </li>
        <li class="mb-4">
            <a class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2" href="{{ route('products.index') }}">
                <i class="fas fa-box mr-3"></i>
                Barang
            </a>
        </li>
        <li class="mb-4">
            <a class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2" href="{{ route('kategori.index') }}">
                <i class="fas fa-tags mr-3"></i>
                Kategori
            </a>
        </li>
        <li class="mb-4">
            <a class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2" href="{{route('sales.index')}}">
                <i class="fas fa-file-alt mr-3"></i>
                Report
            </a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="mb-4">
            <a class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2" href="{{ route('user.index') }}">
                <i class="bi bi-people-fill mr-3"></i>
                User
            </a>
        </li>
        @endif
        <li class="mb-4">
            <a class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2" href="https://t.me/UPIKCABONSTORE_bot">
                <i class="bi bi-telegram mr-3"></i>
                TelegramBot
            </a>
        </li>
        <!-- Menu TPK -->
        <li class="mb-4">
            <a class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2" href="{{ route('tpk.index') }}">
                <i class="fas fa-cogs mr-3"></i>
                TPK
            </a>
        </li>
        <li class="mb-4">
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
                @csrf
                <button type="submit" class="flex items-center text-white hover:text-red-300 transition-colors duration-200 transform hover:translate-x-2">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>

<!-- Tailwind CSS Animation Classes -->
<style>
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.5s ease-out;
}
</style>
