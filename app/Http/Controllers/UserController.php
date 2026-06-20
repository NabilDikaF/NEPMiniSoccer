<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan
     */
    public function index()
    {
        // Ambil semua user yang role-nya 'pelanggan'
        $pelanggans = User::where('role', 'pelanggan')->orderBy('created_at', 'desc')->get();
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    /**
     * Menampilkan form edit data pelanggan spesifik
     */
    public function edit($id)
    {
        $pelanggan = User::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Menyimpan perubahan data pelanggan (Oleh Admin)
     */
    public function update(Request $request, $id)
    {
        $pelanggan = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($pelanggan->id)],
            'password' => ['nullable', 'string', 'min:8'], // Opsional bagi admin jika ingin mereset password user
        ]);

        $pelanggan->name = $validated['name'];
        $pelanggan->email = $validated['email'];
        $pelanggan->no_hp = $validated['no_hp'];

        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($validated['password']);
        }

        $pelanggan->save();

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Menghapus pelanggan
     */
    public function destroy($id)
    {
        try {
            $pelanggan = User::findOrFail($id);
            $pelanggan->delete();

            return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
        } catch (QueryException $e) {
            // Mencegah error jika pelanggan sudah pernah melakukan booking (terikat foreign key)
            return redirect()->route('admin.pelanggan.index')->with('error', 'Pelanggan tidak bisa dihapus karena memiliki riwayat transaksi.');
        }
    }
}