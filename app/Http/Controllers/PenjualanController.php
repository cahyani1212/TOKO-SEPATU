<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\ProductJual;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $sales = ProductJual::latest()->paginate(10); // Ambil data penjualan terbaru dengan pagination
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('penjualan.create');
    }

    public function store(Request $request)
    {
        // Simpan data penjualan
    }

    public function show($id)
{
    $sale = ProductJual::findOrFail($id); // Ambil data penjualan berdasarkan ID
    return view('sales.show', compact('sale'));
}


    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}
