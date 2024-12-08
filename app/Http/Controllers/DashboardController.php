<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $kategori = Category::count();
        if (auth()->check()) {
            return view('dashboard',compact('kategori'));
        } else {
            return redirect()->route('login');
        }
    }
}