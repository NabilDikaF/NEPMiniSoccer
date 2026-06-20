<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class HargaController extends Controller
{
    /**
     * Menampilkan daftar blok waktu dan harga
     */
    public function index()
    {
        // Mengurutkan data berdasarkan jam mulai (Pagi ke Malam)
        $hargas = Harga::orderBy('jam_mulai', 'asc')->get();
        
        // Menampilkan ke halaman utama kelola harga
        return view('admin.harga.index', compact('hargas'));
    }

    /**
     * Menampilkan form untuk menambah harga baru
     */
    public function create()
    {
        return view('admin.harga.create');
    }

    /**
     * Menyimpan data harga baru ke database (Individual)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'blok_waktu'  => ['required', 'string', 'max:50'], 
            'harga'       => ['required', 'numeric', 'min:0'],
            'jam_mulai'   => ['required'], 
            'jam_selesai' => ['required', 'after:jam_mulai'], 
        ]);

        Harga::create($validated);

        return redirect()->route('harga.index')
                         ->with('success', 'Blok waktu dan harga berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk harga tertentu
     */
    public function edit($id_harga)
    {
        $harga = Harga::findOrFail($id_harga);
        return view('admin.harga.edit', compact('harga'));
    }

    /**
     * Memperbarui data satu slot harga di database (Individual)
     */
    public function update(Request $request, $id_harga)
    {
        $validated = $request->validate([
            'blok_waktu'  => ['required', 'string', 'max:50'],
            'harga'       => ['required', 'numeric', 'min:0'],
            'jam_mulai'   => ['required'],
            'jam_selesai' => ['required', 'after:jam_mulai'],
        ]);

        $harga = Harga::findOrFail($id_harga);
        $harga->update($validated);

        return redirect()->route('harga.index')
                         ->with('success', 'Data harga lapangan berhasil diperbarui.');
    }

    /**
     * Menghapus data harga dari database
     */
    public function destroy($id_harga)
    {
        try {
            $harga = Harga::findOrFail($id_harga);
            $harga->delete();

            return redirect()->route('harga.index')
                             ->with('success', 'Data harga berhasil dihapus.');
                             
        } catch (QueryException $e) {
            // Menangkap error jika data harga masih terikat dengan tabel jadwal (onDelete restrict)
            if ($e->getCode() == '23000') {
                return redirect()->route('harga.index')
                                 ->with('error', 'Gagal! Blok waktu ini tidak bisa dihapus karena sedang digunakan pada jadwal lapangan.');
            }
            
            return redirect()->route('harga.index')
                             ->with('error', 'Terjadi kesalahan pada database saat menghapus data.');
        }
    }

    /**
     * =========================================================================
     * FITUR BARU: MEMPROSES UPDATE MASAL (Sesuai Tampilan UI Dashboard Figma)
     * =========================================================================
     */
    public function updatePengaturanMassal(Request $request)
    {
        $request->validate([
            'harga_pagi'    => ['required', 'numeric', 'min:0'],
            'harga_siang'   => ['required', 'numeric', 'min:0'],
            'harga_sore'    => ['required', 'numeric', 'min:0'],
            'harga_malam'   => ['required', 'numeric', 'min:0'],
            'diskon_member' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'slot_aktif'    => ['nullable', 'array'], 
            'slot_aktif.*'  => ['exists:harga,id_harga']
        ]);

        DB::beginTransaction();

        try {
            // 1. Update nominal harga massal berdasarkan nama Blok Waktu
            Harga::where('blok_waktu', 'Pagi')->update(['harga' => $request->harga_pagi]);
            Harga::where('blok_waktu', 'Siang')->update(['harga' => $request->harga_siang]);
            Harga::where('blok_waktu', 'Sore')->update(['harga' => $request->harga_sore]);
            Harga::where('blok_waktu', 'Malam')->update(['harga' => $request->harga_malam]);

            // 2. SINKRONISASI SAKELAR (TOGGLE)
            // Matikan (False) semua status aktif terlebih dahulu
            Harga::query()->update(['is_active' => false]);

            // Nyalakan (True) hanya untuk id_harga yang centangnya dikirim dari form
            if ($request->has('slot_aktif')) {
                Harga::whereIn('id_harga', $request->slot_aktif)->update(['is_active' => true]);
            }

            // 3. Simpan Diskon Member (Opsional jika sudah ada tabel settings global)
            // Setting::updateOrCreate(['key' => 'diskon_member'], ['value' => $request->diskon_member]);

            DB::commit();
            return redirect()->back()->with('success', 'Pengaturan jadwal dan harga berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}