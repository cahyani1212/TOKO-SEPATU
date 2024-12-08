<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-start mt-8">
        <!-- Profile Picture Section -->
        <div class="w-1/3 bg-white p-4 shadow-md rounded-md">
            <h3 class="text-lg font-semibold mb-4">Foto Profil</h3>
            <div class="border-2 border-red-500 p-2 mb-4">
                <img src="https://storage.googleapis.com/a1aa/image/oj7h6iz6HX5OHRJQRSmvoTXfMiARr6Te6ljCpkb6p7F7yE3TA.jpg" alt="Profile Picture" class="w-full">
            </div>
            <input type="file" class="mb-2">
            <span>photo.jpg</span>
        </div>
        <!-- Account Information Section -->
        <div class="w-2/3 bg-white p-8 shadow-md rounded-md ml-8">
            <h3 class="text-lg font-semibold mb-4">Informasi Akun</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700">Username</label>
                    <input type="text" class="w-full p-2 border rounded" value="{{ $user->email }}" disabled>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nama *</label>
                    <input type="text" name="name" class="w-full p-2 border rounded" value="{{ $user->name }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email *</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" value="{{ $user->email }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Role *</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded" value="{{ $user->role }}">
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
    <!-- Notification -->
    @if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded shadow-md">
        {{ session('success') }}
    </div>
    @endif
</body>
</html>