<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function login(): View
    {
        return view('login');
    }

    /**
     * Menampilkan halaman register.
     */
    public function register(): View
    {
        return view('register');
    }

    /**
     * Menampilkan halaman lupa password.
     */
    public function forgetpw(): View
    {
        return view('forgetpw');
    }

    /**
     * Memproses data form login.
     */
    public function login_post(Request $request): RedirectResponse
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'identifier' => ['required', 'string'],
            'password'   => ['required', 'string'],
        ]);

        // 2. Petakan identifier dari form menjadi 'email' untuk database
        $attemptData = [
            'email'    => $credentials['identifier'],
            'password' => $credentials['password'],
        ];

        // 3. Proses Autentikasi
        if (Auth::attempt($attemptData)) {
            $request->session()->regenerate();

            // Cek role user untuk pengalihan halaman yang sesuai
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        // 4. Jika login gagal, cari tahu penyebab spesifiknya
        $userExists = \App\Models\User::where('email', $attemptData['email'])->exists();

        if (!$userExists) {
            return back()->withErrors([
                'identifier' => 'Email tidak terdaftar. Silakan periksa kembali email Anda.',
            ])->onlyInput('identifier');
        }

        // Jika email terdaftar tapi gagal, berarti password salah
        return back()->withErrors([
            'password' => 'Kata sandi yang Anda masukkan salah.',
        ])->onlyInput('identifier');
    }

    public function register_post(Request $request): RedirectResponse
    {
        // Bersihkan format nomor HP (hilangkan strip) sebelum divalidasi
        if ($request->has('no_hp') && $request->no_hp) {
            $request->merge([
                'no_hp' => str_replace('-', '', $request->no_hp)
            ]);
        }

        // 1. Validasi input form
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'no_hp'    => ['nullable', 'string', 'max:13'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' akan otomatis mengecek input 'password_confirmation'
        ], [
            // Kustomisasi pesan error agar bahasanya lebih ramah
            'email.unique'       => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal harus 8 karakter.'
        ]);

        // Cek apakah OTP sudah terverifikasi
        if (!Session::get('register_otp_verified_' . $request->email)) {
            return back()->withErrors(['email' => 'Anda harus memverifikasi email Anda dengan kode OTP terlebih dahulu.'])->withInput();
        }

        // Hapus session verifikasi agar tidak bisa dipakai ulang
        Session::forget('register_otp_verified_' . $request->email);

        // 2. Simpan user ke database
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
            'role'     => 'pelanggan', // Default role untuk yang mendaftar via web
        ]);

        // 3. Otomatis login-kan user setelah berhasil daftar
        Auth::login($user);

        // 4. Arahkan ke halaman utama/home
        return redirect()->route('home');
    }

    // Memproses logout user.
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman utama
        return redirect('/');
    }
}