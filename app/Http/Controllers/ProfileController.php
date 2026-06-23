<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Booking;
use App\Models\DetailBooking;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user
     */
    public function profile()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin-profile', compact('user'));
        }

        // Auto-update status Lunas menjadi Selesai jika waktu sudah berlalu
        Booking::updateStatusSelesai($user->id);

        // Hitung Total Jam Main (berdasarkan jumlah DetailBooking dari Booking yang Selesai)
        $totalJamMain = DetailBooking::whereHas('booking', function ($query) use ($user) {
            $query->where('id_user', $user->id)
                  ->whereIn('status_booking', ['Selesai']);
        })->count();

        // Hitung Booking Menunggu (berdasarkan status)
        $bookingMenunggu = Booking::where('id_user', $user->id)
                                  ->whereIn('status_booking', ['Menunggu Pembayaran', 'Menunggu Verifikasi'])
                                  ->count();

        return view('profile', compact('user', 'totalJamMain', 'bookingMenunggu'));
    }

    /**
     * Memproses perubahan data profil user
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Bersihkan format nomor HP (hilangkan strip) sebelum divalidasi
        if ($request->has('no_hp') && $request->no_hp) {
            $request->merge([
                'no_hp' => str_replace('-', '', $request->no_hp)
            ]);
        }

        // 1. Validasi Input
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'no_hp'  => ['nullable', 'string', 'max:13'],
            'email'  => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        // 2. Update Data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->no_hp = $validated['no_hp'];

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Memproses perubahan password user
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('profile')->with('success', 'Kata sandi berhasil diperbarui!');
    }

    /**
     * Memproses upload avatar secara AJAX
     */
    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'avatar' => ['required', 'image', 'max:4096'], // Validate image size
        ]);

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Simpan avatar baru
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();

            return response()->json([
                'success' => true,
                'avatar_url' => asset('storage/' . $avatarPath),
                'message' => 'Foto profil berhasil diperbarui!'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengunggah foto profil.'], 400);
    }
}