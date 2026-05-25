<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function forgetpw()
    {
        return view('forgetpw');
    }

    public function login_post(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // 2. Petakan identifier dari form menjadi 'email' untuk database
        $credentials = [
            'email' => $request->identifier,
            'password' => $request->password,
        ];

        // 3. Proses Autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek jika user adalah admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika bukan admin
            return redirect()->route('home');
        }

        // 4. Jika login gagal
        return back()->withErrors([
            'identifier' => 'Email atau sandi tidak sesuai.',
        ])->onlyInput('identifier');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman utama (home) atau halaman login setelah berhasil logout
        return redirect('/');
    }
}
