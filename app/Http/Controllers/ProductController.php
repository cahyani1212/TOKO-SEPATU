<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductJual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Method untuk mendapatkan daftar produk
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products')); // Mengembalikan view dengan produk
    }

    // Method untuk menampilkan form pembuatan produk
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('products.create', compact('categories')); // Tampilkan form pembuatan produk
    }

    // Method untuk menyimpan produk baru ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Product::create([
            'nama_produk' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'price' => $request->harga,
            'warna' => $request->warna,
            'ukuran' => $request->ukuran,
            'stok' => $request->stok,
            'foto_produk' => $imageName,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect()->route('products.index')->with('status', 'Produk berhasil ditambahkan');
    }

    // Method untuk menampilkan form penjualan produk
    public function showSaleForm($id)
    {
        $product = Product::findOrFail($id); // Cari produk berdasarkan ID
        return view('products.jual', compact('product')); // Tampilkan view jual dengan data produk
    }

    // Method untuk menyimpan data penjualan produk
    public function storeSale(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:1',
            'tgl_keluar' => 'required|date',
            'warna' => 'required|string',
            'ukuran' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($id);

        if ($request->jumlah > $product->stok) {
            return back()->with('status', 'Stok tidak mencukupi');
        }

        $harga_satuan = $product->price;
        $total_harga = $request->jumlah * $harga_satuan;

        ProductJual::create([
            'product_id' => $product->id,
            'jumlah' => $request->jumlah,
            'nama_brg' => $product->nama_produk,
            'tgl_keluar' => $request->tgl_keluar,
            'harga_satuan' => $harga_satuan,
            'total_harga' => $total_harga,
            'warna' => $request->warna,
            'ukuran' => $request->ukuran,
            'catatan' => $request->catatan,
        ]);

        $product->stok -= $request->jumlah;
        $product->save();

        return redirect()->route('products.index')->with('status', 'Produk berhasil dijual');
    }
}
