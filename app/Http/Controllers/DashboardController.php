<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $user = User::count();
        $kategori = Category::count();
        $product = Product::count();
        if (auth()->check()) {
            return view('dashboard',compact('kategori','product','user'));
        } else {
            return redirect()->route('login');
        }
    }
}