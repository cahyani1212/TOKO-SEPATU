<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Method untuk menampilkan daftar produk
    public function index()
{
    $products = Product::all(); // Mengambil semua produk
    return view('products.index', compact('products')); // Mengirimkan data produk ke view
}

    // Method untuk menampilkan form membuat produk baru
    public function create()
    {
        return view('products.create');
    }

    // Method untuk menyimpan produk baru ke database
    public function store(Request $request)
    {
      // Validasi input
$request->validate([
    'name' => 'required|string|max:255', // Validasi nama sebagai string dengan batasan 255 karakter
    'description' => 'nullable|string', // Deskripsi opsional dan validasi sebagai string
    'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Validasi harga sebagai angka desimal dengan maksimal dua digit setelah titik
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar opsional dengan tipe file tertentu
    'warna' => 'required|string|max:225',
    'ukuran' => 'required|string|max:225',
    'stok' => 'required|string|max:225',
]);


        // Membuat produk baru
        $product = new Product();
        $product->id = $request->id;
        $product->id_kategori = $request->id_kategori;
        $product->name = $request->nama_produk;
        $product->description = $request->deskripsi;
        $product->price = $request->harga;
        $product->image = $request->image;
        $product->warna = $request->warna;
        $product->stok = $request->stok;
        $product->ukuran = $request->ukuran;

        // Jika ada file foto yang di-upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->foto_produk->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Simpan produk ke database
        $product->save();

        // Redirect kembali ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Method untuk menampilkan form edit produk
    public function edit($id)
    {
        // Mengambil produk berdasarkan ID
        $product = Product::find($id);

        // Jika produk tidak ditemukan, kembalikan error 404
        if (!$product) {
            return abort(404, 'Produk tidak ditemukan.');
        }

        // Mengirimkan data produk ke view 'edit'
        return view('products.edit', compact('product'));
    }

    // Method untuk memperbarui produk di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kategori_id' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ukuran' => 'required|string|max:10',
            'warna' => 'required|string|max:20',
            'stok' => 'required|integer',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari produk berdasarkan ID
        $product = Product::find($id);

        // Jika produk tidak ditemukan
        if (!$product) {
            return abort(404, 'Produk tidak ditemukan.');
        }

        // Update produk dengan data dari form
        $product->kategori_id = $request->kategori_id;
        $product->nama_produk = $request->nama_produk;
        $product->deskripsi = $request->deskripsi;
        $product->ukuran = $request->ukuran;
        $product->warna = $request->warna;
        $product->stok = $request->stok;

        // Jika ada file foto yang di-upload
        if ($request->hasFile('foto_produk')) {
            $imageName = time() . '.' . $request->foto_produk->extension();
            $request->foto_produk->move(public_path('images'), $imageName);
            $product->foto_produk = $imageName;
        }

        // Simpan perubahan ke database
        $product->save();

        // Redirect kembali ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    // function jual
    public function sell($id)
    {
        $product = Product::findOrFail($id); // Mengambil produk berdasarkan ID
        return view('jual', compact('product')); // Mengirim data produk ke view 'jual'
    }

    // Tambahkan metode untuk menyimpan penjualan
    public function storeSale(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Simpan data ke tabel product_jual
        \DB::table('product_jual')->insert([
            'product_id' => $request->product_id,
            'jumlah' => $request->jumlah,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil dijual!');
    }
}

