<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductJual; // Pastikan model ProductJual diimport

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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'stok' => 'required|integer',
        ]);

        // Membuat produk baru
        $product = new Product();
        $product->id_kategori = $request->id_kategori;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->warna = $request->warna;
        $product->ukuran = $request->ukuran;
        $product->stok = $request->stok;

        // Jika ada file foto yang di-upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
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
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Method untuk memperbarui produk di database
    public function update(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'id_kategori' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ukuran' => 'required|string|max:10',
            'warna' => 'required|string|max:20',
            'stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Update produk dengan data dari form
        $product->id_kategori = $request->id_kategori;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->ukuran = $request->ukuran;
        $product->warna = $request->warna;
        $product->stok = $request->stok;

        // Jika ada file foto yang di-upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Simpan perubahan ke database
        $product->save();

        
        // Redirect kembali ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Method untuk menampilkan form penjualan produk
    public function sell($id)
    {
        $product = Product::findOrFail($id);
        return view('products.jual', compact('product'));
    }

    // Method untuk menyimpan penjualan ke database
   // Method untuk menyimpan penjualan ke database
public function storeSale(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'jumlah' => 'required|integer|min:1',
        'tgl_keluar' => 'required|date',
        'warna' => 'required',
        'ukuran' => 'required',
        'catatan' => 'nullable|string',
    ]);

    // Temukan produk berdasarkan ID dari parameter $id
    $product = Product::findOrFail($id);

    // Periksa apakah stok mencukupi
    if ($request->jumlah > $product->stok) {
        return redirect()->back()->with('error', 'Stok tidak mencukupi.');
    }

    // Ambil harga satuan dari produk
    $harga_satuan = $product->price;
    $total_harga = $request->jumlah * $harga_satuan;

    // Simpan data ke tabel product_jual
    ProductJual::create([
        'product_id' => $product->id, // Menggunakan ID dari produk yang ditemukan
        'jumlah' => $request->jumlah,
        'tgl_keluar' => $request->tgl_keluar,
        'harga_satuan' => $harga_satuan, // Gunakan harga satuan dari produk
        'total_harga' => $total_harga, // Hitung total harga berdasarkan jumlah dan harga satuan
        'warna' => $request->warna,
        'ukuran' => $request->ukuran,
        'catatan' => $request->catatan, // Jika catatan ada, akan tersimpan
        'nama_brg' => $product->name, // Ambil nama barang dari produk
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Kurangi stok produk
    $product->stok -= $request->jumlah;
    $product->save(); // Simpan perubahan stok

    // Redirect kembali ke halaman produk dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Produk berhasil dijual!');
}
}
