<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalBimwin; // <- Import Model kita
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal.
     */
    public function index()
    {
        $jadwals = JadwalBimwin::orderBy('tanggal_pelaksanaan', 'desc')->get();
        // Nanti kita akan buat view di: 'resources/views/admin/jadwal/index.blade.php'
        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Menampilkan form untuk membuat jadwal baru.
     */
    public function create()
    {
        // Nanti kita akan buat view di: 'resources/views/admin/jadwal/create.blade.php'
        return view('admin.jadwal.create');
    }

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_angkatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'waktu_pelaksanaan' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
        ]);

        // Buat jadwal baru menggunakan Model
        JadwalBimwin::create($request->all());

        return redirect()->route('jadwal.index')
                         ->with('success', 'Jadwal bimbingan berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit jadwal.
     */
    public function edit(JadwalBimwin $jadwal) // <- Ini menggunakan Route Model Binding
    {
        // Nanti kita akan buat view di: 'resources/views/admin/jadwal/edit.blade.php'
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    /**
     * Memperbarui jadwal di database.
     */
    public function update(Request $request, JadwalBimwin $jadwal)
    {
        // Validasi input
        $request->validate([
            'nama_angkatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'waktu_pelaksanaan' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'status' => 'required|in:dibuka,ditutup,penuh,selesai', // Validasi status
        ]);

        // Update jadwal
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')
                         ->with('success', 'Jadwal bimbingan berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal dari database.
     */
    public function destroy(JadwalBimwin $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')
                         ->with('success', 'Jadwal bimbingan berhasil dihapus.');
    }
}
