<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Anda bisa mengambil data produk dari database di sini
        return view('products.index');
    }
    public function create()
{
    return view('products.create');
}
}
