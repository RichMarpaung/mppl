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
            'cv' => 'required|file|mimes:pdf|max:2048', // Maksimal 2MB
        ]);

        $cvPath = $request->file('cv')->store('cv', 'public');

        Pelamar::create([
            'user_id' => Auth::id(),
            'lowongan_id' => $request->lowongan_id,
            'cv' => $cvPath,
            'status' => 'menunggu',
        ]);

        return redirect()->route('user.lowongans.index')->with('success', 'Lamaran berhasil dikirim.');
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
