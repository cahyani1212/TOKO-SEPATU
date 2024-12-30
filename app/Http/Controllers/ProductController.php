<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductJual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

class ProductController extends Controller
{
    // Method untuk mendapatkan daftar produk
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products')); // Mengembalikan view dengan produk
    }
    public function sell($id)
    {
        $product = Product::findOrFail($id);
        return view('products.jual', compact('product')); // Mengembalikan view dengan produk
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

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Ambil data produk berdasarkan ID
        $categories = Category::all(); // Ambil semua kategori
        return view('products.edit', compact('product', 'categories')); // Kirim ke view
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'warna' => 'required|string|max:50',
            'ukuran' => 'required|string|max:50',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $data = $request->all();

        // Jika ada foto baru diupload
        if ($request->hasFile('foto_produk')) {
            $path = $request->file('foto_produk')->store('produk', 'public');
            $data['foto_produk'] = $path;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Produk berhasil diperbarui!');
    }
    public function destroy($id)
{
    // Cari produk berdasarkan ID
    $product = Product::findOrFail($id);

    // Jika produk memiliki gambar, hapus gambar dari storage
    if ($product->foto_produk && \Storage::exists($product->foto_produk)) {
        \Storage::delete($product->foto_produk);
    }

    // Hapus produk
    $product->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('products.index')->with('status', 'Produk berhasil dihapus!');
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

        $sale = ProductJual::create([
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

        // Kirim pesan ke Telegram
        $message = "📦 **Produk Terjual** 📦\n"
            . "🆔 ID Produk: {$sale->product_id}\n"
            . "📋 Nama Barang: {$sale->nama_brg}\n"
            . "🎨 Warna: {$sale->warna}\n"
            . "📐 Ukuran: {$sale->ukuran}\n"
            . "💵 Harga Satuan: " . number_format($sale->harga_satuan, 0, ',', '.') . " IDR\n"
            . "📦 Jumlah: {$sale->jumlah}\n"
            . "💰 Total Harga: " . number_format($sale->total_harga, 0, ',', '.') . " IDR\n"
            . "📅 Tanggal Keluar: {$sale->tgl_keluar}\n"
            . (!empty($sale->catatan) ? "📝 Catatan: {$sale->catatan}" : '');


        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID', ''),
            'text' => $message,
            'parse_mode' => 'Markdown', // Untuk format teks
        ]);

        return redirect()->route('products.index')->with('status', 'Produk berhasil dijual');
    }
}
