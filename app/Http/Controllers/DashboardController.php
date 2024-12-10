<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $kategori = Category::count();
        $product = Product::count();
        if (auth()->check()) {
            return view('dashboard',compact('kategori','product'));
        } else {
            return redirect()->route('login');
        }
    }
}