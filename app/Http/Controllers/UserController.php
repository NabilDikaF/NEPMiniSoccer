<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = User::where('role', 'pelanggan')
            ->withCount('bookings')
            ->with(['bookings' => fn($q) => $q->latest()]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $pelanggans = $query->latest()->paginate(10)->withQueryString();

        return view('admin-dataPelanggan', compact('pelanggans'));
    }

    /**
     * Menampilkan detail pelanggan beserta riwayat bookingnya.
     */
    public function detail($id)
    {
        $user = User::findOrFail($id);

        $bookings = $user->bookings()
                         ->with(['detailBookings.jadwal.harga'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(5);

        return view('admin-pelanggan-detail', compact('user', 'bookings'));
    }

    /**
     * Memperbarui data pelanggan (oleh Admin).
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Bersihkan format nomor HP (hilangkan strip) sebelum divalidasi
        if ($request->has('no_hp') && $request->no_hp) {
            $request->merge(['no_hp' => str_replace('-', '', $request->no_hp)]);
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'no_hp'    => ['nullable', 'string', 'max:13'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data pelanggan berhasil diperbarui!');
    }
}