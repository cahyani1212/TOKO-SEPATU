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
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Method untuk menyimpan produk baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255', // Validasi untuk kategori
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'stok' => 'required|integer',
        ]);


        // Jika ada file foto yang di-upload
        $imageName = null;
        if ($request->file('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        Product::create([
            'nama_produk' => $request->name,
            'deskripsi' => $request->deskripsi,
            'price' => $request->harga,
            'warna' => $request->warna,
            'ukuran' => $request->ukuran,
            'stok' => $request->stok,
            'foto_produk' => $imageName, // Use foto_produk instead of image
            'id_kategori' => $request->id_kategori,
        ]);

        // Redirect kembali ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }

    // Mengupdate data produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'ukuran' => 'required',
            'warna' => 'required|string',
            'stok' => 'required|integer',
            'price' => 'required|integer',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Handle file upload
        if ($request->file('foto_produk')) {
            // Hapus file gambar lama jika ada
            if ($product->foto_produk) {
                unlink(public_path('images/' . $product->foto_produk));
            }

            // Simpan file gambar baru
            $imageName = time() . '.' . $request->foto_produk->extension();
            $request->foto_produk->move(public_path('images'), $imageName);
            $product->foto_produk = $imageName;
        }

        // Update data produk
        $product->nama_produk = $request->name;
        $product->deskripsi = $request->description;
        $product->ukuran = $request->ukuran;
        $product->warna = $request->warna;
        $product->stok = $request->stok;
        $product->price = $request->price;
        $product->id_kategori = $request->id_kategori;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
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
