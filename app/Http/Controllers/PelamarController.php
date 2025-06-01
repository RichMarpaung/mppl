<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    /**
     * Tampilkan form untuk melamar lowongan.
     */
    public function index()
    {
        $pelamars = Pelamar::with(['user', 'lowongan'])->get();
        return view('adminpage.pelamar.index', compact('pelamars'));
    }
    public function create(Lowongan $lowongan)
    {
        return view('userpage.pelamar.create', compact('lowongan'));
    }

    /**
     * Simpan data pelamar ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'lowongan_id' => 'required|exists:lowongans,id',
        'nama' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'phone' => 'required|string|max:15',
        'cv' => 'required|file|mimes:pdf|max:2048',
    ]);

    // Simpan file CV
    $cvPath = $request->file('cv')->store('cv', 'public');

    // Simpan data pelamar
    Pelamar::create([
        'user_id' => Auth::id(),
        'lowongan_id' => $request->lowongan_id,
        'nama' => $request->nama,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'alamat' => $request->alamat,
        'phone' => $request->phone,
        'cv' => $cvPath,
        'status' => 'menunggu',
    ]);

    // Tambahkan flash message
    return redirect()->route('dashboard.page')->with('success', 'Lamaran berhasil dikirim.');
    }
    public function update(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'status' => 'required|in:diterima,diproses,ditolak',
        ]);

        $pelamar->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pelamars.index')->with('success', 'Status pelamar berhasil diperbarui.');
    }
}
