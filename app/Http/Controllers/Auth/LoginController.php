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
            'email' => 'required|string', // Ubah validasi jika Anda mengizinkan login dengan username
            'password' => 'required',
        ]);

        // Data untuk login (bisa email atau username)
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            // Jika berhasil, redirect ke halaman yang diinginkan (intended) atau dashboard
            return redirect()->intended(route('dashboard'));
        }

        // Jika gagal, kembali ke form login dengan pesan error dan input sebelumnya
        return redirect()->back()
            ->withErrors(['email' => 'Email atau password tidak valid.'])
            ->withInput($request->only('email'));
    }


    // Menghandle logout
    public function logout()
    {
        // Proses logout
        Auth::logout();

        // Redirect ke halaman login setelah logout
        return redirect('/login');
    }
}
