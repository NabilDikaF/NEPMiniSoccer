<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Harga;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar jadwal operasional
     */
    public function index(Request $request)
    {
        // Secara default tampilkan jadwal dari hari ini ke depan
        // Admin bisa melihat status: Tersedia, Terbooking, atau Maintenance
        $jadwals = Jadwal::with('harga')
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();

        // Mengambil daftar blok harga untuk ditampilkan per jam di view
        $hargas = Harga::orderBy('jam_mulai', 'asc')->get();

        return view('admin-jadwal', compact('jadwals', 'hargas'));
    }

    /**
     * Menampilkan form untuk men-generate jadwal massal secara manual
     */
    public function create()
    {
        return view('admin-jadwal.generate');
    }

    /**
     * Memproses pembuatan jadwal massal berdasarkan rentang tanggal
     */
    public function storeGenerate(Request $request)
    {
        $request->validate([
            'tanggal_mulai'   => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
        ]);

        $mulai = Carbon::parse($request->tanggal_mulai);
        $selesai = Carbon::parse($request->tanggal_selesai);
        $hargas = Harga::all();

        if ($hargas->isEmpty()) {
            return back()->with('error', 'Gagal generate! Data Harga/Blok Waktu belum diatur.');
        }

        $dataJadwal = [];

        // Looping dari tanggal mulai sampai tanggal selesai
        for ($date = $mulai; $date->lte($selesai); $date->addDay()) {
            foreach ($hargas as $harga) {
                $dataJadwal[] = [
                    'tanggal'       => $date->toDateString(),
                    'id_harga'      => $harga->id_harga,
                    'status_jadwal' => 'Tersedia',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }
        }

        // Gunakan insertOrIgnore agar jika tanggal tersebut sudah pernah di-generate sebelumnya,
        // sistem tidak akan error (menghindari Unique Constraint Violation)
        Jadwal::insertOrIgnore($dataJadwal);

        return redirect()->route('jadwal.index')
                         ->with('success', 'Jadwal lapangan berhasil di-generate!');
    }

    /**
     * Menampilkan form untuk mengubah status jadwal tertentu
     * (Misal: Admin ingin menutup lapangan pada jam tertentu karena perbaikan)
     */
    public function edit($id_jadwal)
    {
        $jadwal = Jadwal::with('harga')->findOrFail($id_jadwal);
        return view('admin-jadwal.edit', compact('jadwal'));
    }

    /**
     * Menyimpan perubahan status jadwal
     */
    public function update(Request $request, $id_jadwal)
    {
        $request->validate([
            'status_jadwal' => ['required', 'in:Tersedia,Pending,Terbooking,Maintenance,Tutup']
        ]);

        $jadwal = Jadwal::findOrFail($id_jadwal);
        $jadwal->update([
            'status_jadwal' => $request->status_jadwal
        ]);

        return redirect()->route('jadwal.index')
                         ->with('success', 'Status jadwal berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal tertentu (hanya bisa jika belum di-booking)
     */
    public function destroy($id_jadwal)
    {
        try {
            $jadwal = Jadwal::findOrFail($id_jadwal);
            
            if ($jadwal->status_jadwal === 'Terbooking') {
                return back()->with('error', 'Jadwal ini tidak bisa dihapus karena sudah dibooking pelanggan.');
            }

            $jadwal->delete();

            return redirect()->route('jadwal.index')
                             ->with('success', 'Jadwal berhasil dihapus.');

        } catch (QueryException $e) {
            return back()->with('error', 'Jadwal ini sedang terikat dengan data transaksi dan tidak dapat dihapus.');
        }
    }
}