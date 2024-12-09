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
        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditemukan',
            'data' => $products
        ], 200);
    }

    // Method untuk menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditemukan',
            'data' => $product
        ], 200);
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
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
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

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ], 201);
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
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
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

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ], 200);
    }

    // Method untuk menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->foto_produk) {
            unlink(public_path('images/' . $product->foto_produk));
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus'
        ], 204);
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
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::findOrFail($id);

        if ($request->jumlah > $product->stok) {
            return response()->json([
                'status' => false,
                'message' => 'Stok tidak mencukupi'
            ], 400);
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

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dijual',
            'data' => $sale
        ], 201);
    }
}
