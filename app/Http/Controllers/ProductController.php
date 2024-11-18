<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
            'id_kategori' => 'required|integer', // Validasi untuk kategori
            'description' => 'nullable|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'stok' => 'required|integer',
        ]);

        // Membuat produk baru
        $product = new Product();
        $product->id_kategori = $request->id_kategori; // Menggunakan id_kategori
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

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Mengedit data produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_kategori' => 'required|integer', // Validasi untuk kategori
            'description' => 'nullable|string',
            'ukuran' => 'nullable|string',
            'warna' => 'nullable|string',
            'stok' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Konsistensi nama
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->id_kategori = $request->id_kategori; // Konsistensi nama
        $product->description = $request->description;
        $product->ukuran = $request->ukuran;
        $product->warna = $request->warna;
        $product->stok = $request->stok;
        $product->price = $request->price;

        // Menangani upload foto jika ada
        if ($request->hasFile('image')) { // Konsistensi nama
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName; // Konsistensi nama
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }
    
    // Method untuk menampilkan form penjualan produk
    public function sell($id)
    {
        $product = Product::findOrFail($id);
        return view('products.jual', compact('product'));
    }

    // Method untuk menyimpan penjualan ke database
    public function storeSale(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'tgl_keluar' => 'required|date',
            'warna' => 'required|string',
            'ukuran' => 'required|string',
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

    // Method untuk menghapus produk dari database
    public function destroy($id)
    {
        // Cari barang berdasarkan id
        $product = Product::findOrFail($id);

        // Hapus barang dari database
        $product->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus.');
    }
}
