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
        return view('products.index', compact('products')); // Return view with products
    }

    // Method untuk menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product')); // Return view with product detail
    }

    // Method untuk menyimpan produk baru ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'stok' => 'required|integer',
            'id_kategori' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // Return back with validation errors
        }

        $imageName = null;
        if ($request->file('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $product = Product::create([
            'nama_produk' => $request->name,
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

    // Method untuk memperbarui produk berdasarkan ID
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'stok' => 'required|integer',
            'id_kategori' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // Return back with validation errors
        }

        $product = Product::findOrFail($id);

        $imageName = $product->foto_produk;
        if ($request->file('image')) {
            if ($product->foto_produk) {
                unlink(public_path('images/' . $product->foto_produk));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $product->update([
            'nama_produk' => $request->name,
            'deskripsi' => $request->deskripsi,
            'price' => $request->harga,
            'warna' => $request->warna,
            'ukuran' => $request->ukuran,
            'stok' => $request->stok,
            'foto_produk' => $imageName,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect()->route('products.index')->with('status', 'Produk berhasil diperbarui');
    }

    // Method untuk menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->foto_produk) {
            unlink(public_path('images/' . $product->foto_produk));
        }

        $product->delete();

        return redirect()->route('products.index')->with('status', 'Produk berhasil dihapus');
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
            return back()->withErrors($validator)->withInput(); // Return back with validation errors
        }

        $product = Product::findOrFail($id);

        if ($request->jumlah > $product->stok) {
            return back()->with('status', 'Stok tidak mencukupi'); // Return back with error message
        }

        $harga_satuan = $product->price;
        $total_harga = $request->jumlah * $harga_satuan;

        $sale = ProductJual::create([
            'product_id' => $product->id,
            'jumlah' => $request->jumlah,
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

