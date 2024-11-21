<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widWth=device-width, initial-scale=1.0">
    <title>Toko Online | Shop</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #004d40;
    padding: 15px;
    color: white;
}

header .logo {
    font-size: 24px;
    font-weight: bold;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
}

nav ul li a {
    color: white;
    text-decoration: none;
}

nav ul li a.active {
    text-decoration: underline;
}

.user-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-actions .login {
    color: white;
    text-decoration: none;
}

.user-actions .notification {
    background-color: red;
    color: white;
    padding: 5px;
    border-radius: 50%;
}

main {
    display: flex;
    padding: 20px;
}

.sidebar {
    width: 250px;
    background-color: white;
    padding: 20px;
    margin-right: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Tambahkan shadow agar lebih menarik */
}

.sidebar h3 {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #004d40; /* Warna untuk konsistensi */
}

.category {
    margin-bottom: 15px;
}

.category label {
    display: block;
    margin-bottom: 10px;
    font-size: 14px;
    cursor: pointer;
    padding: 5px 0; /* Tambahkan padding agar lebih lega */
}

.subcategory {
    margin-left: 15px; /* Subkategori lebih masuk ke dalam */
    margin-top: 5px;
}

.subcategory label {
    display: block;
    margin-bottom: 8px; /* Jarak antar subkategori */
    font-size: 13px;
    color: #555; /* Warna teks lebih soft */
}

input[type="checkbox"] {
    margin-right: 10px; /* Jarak antara checkbox dan label */
}

/* Efek hover pada kategori */
.category label:hover {
    color: #003d33;
}


.sidebar h3 {
    margin-bottom: 15px;
}

.sidebar .category {
    margin-bottom: 15px;
}

.subcategory {
    margin-left: 15px;
    margin-top: 10px;
}

.product-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.product-card {
    background-color: white;
    padding: 15px;
    border-radius: 5px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.product-card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.product-card h4 {
    margin-bottom: 5px;
}

.product-card p {
    margin-bottom: 10px;
}

.product-card button {
    background-color: #004d40;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
}

.product-card button:hover {
    background-color: #003d33;
}

    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header / Navigation -->
    <header>
        <div class="logo">Toko Upik-Cabon</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#" class="active">Shop</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
        <div class="user-actions">
            <a href="#" class="login">Login | Register</a>
            <span class="notification">1</span>
            <a href="#" class="cart">🛒</a>
        </div>
    </header>

    <!-- Main Content -->
    <main>
    <div class="sidebar">
    <h3>Kategori</h3>
    <div class="category">
        <label><input type="checkbox" checked> Pria</label>
        <div class="subcategory">
            <label><input type="checkbox" checked> Sepatu </label>
            <label><input type="checkbox" checked> Sepatu lari</label>
            <label><input type="checkbox" checked> Sepatu bola</label>
        </div>
        <label><input type="checkbox"> Wanita</label>
        <label><input type="checkbox"> Anak-anak</label>
    </div>
</div>


        <div class="product-list">
            <div class="product-card">
                <img src="https://th.bing.com/th/id/OIP.Q2_R_dwM0Bv4wiwibFQ_jQHaHa?w=192&h=192&c=7&r=0&o=5&dpr=1.5&pid=1.7" alt="hoodie">
                <h4>sepatu</h4>
                <p>⭐ 5+</p>
                <p>IDR 20,000</p>
                <button>🛒 Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="https://th.bing.com/th/id/OIP.Q2_R_dwM0Bv4wiwibFQ_jQHaHa?w=192&h=192&c=7&r=0&o=5&dpr=1.5&pid=1.7" alt="beabs">
                <h4>sepatu</h4>
                <p>⭐ 5+</p>
                <p>IDR 3,000</p>
                <button>🛒 Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="https://th.bing.com/th/id/OIP.Q2_R_dwM0Bv4wiwibFQ_jQHaHa?w=192&h=192&c=7&r=0&o=5&dpr=1.5&pid=1.7" alt="gtgtgt">
                <h4>sepatu</h4>
                <p>⭐ 5+</p>
                <p>IDR 6,000</p>
                <button>🛒 Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="https://th.bing.com/th/id/OIP.Q2_R_dwM0Bv4wiwibFQ_jQHaHa?w=192&h=192&c=7&r=0&o=5&dpr=1.5&pid=1.7" alt="renoooooooo">
                <h4>sepatu</h4>
                <p>⭐ 5+</p>
                <p>IDR 20,000</p>
                <button>🛒 Add to Cart</button>
            </div>
        </div>
    </main>
</body>
</html>
