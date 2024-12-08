<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menghandle proses login.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email', // Pastikan email valid
            'password' => 'required|string|min:6', // Tambahkan validasi panjang password
        ]);

        // Data untuk login
        $credentials = $request->only('email', 'password');

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            // Redirect ke halaman yang diinginkan atau dashboard
            return redirect()->intended(route('dashboard'));
        }

        // Jika gagal, kembali ke form login dengan pesan error
        return back()
            ->withErrors([
                'email' => 'Email atau password tidak valid.',
            ])
            ->withInput($request->only('email'));
    }

    /**
     * Menghandle proses logout.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Invalidate sesi
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();
        // Redirect ke halaman login setelah logout
        return redirect('/login');
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menghandle proses registrasi.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('dashboard');
}

}
