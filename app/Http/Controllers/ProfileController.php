<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
        
        // Tampilkan halaman profil
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|max:15',
        ]);

        // Update data pengguna
        $user = Auth::user();
        $user->update($request->only('name', 'email', 'role',));

        // Redirect kembali dengan pesan sukses
        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
