<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menghandle login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil, redirect ke dashboard
            return redirect()->route('dashboard');
        }

        // Jika gagal, kembali ke form login dengan pesan error
        return redirect()->back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->withInput();
    }

    // Menghandle logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}