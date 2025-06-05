<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $teams = Team::all();
        return view('adminpage.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $hasAccount = $request->query('has_account', 'yes'); // Default ke 'yes'

        if ($hasAccount === 'yes') {
            // Jika sudah memiliki akun, kirim data user ke view
            $users = User::all();
            return view('adminpage.team.create', compact('users', 'hasAccount'));
        } else {
            $roles = Role::all();
            // Jika belum memiliki akun, tampilkan form untuk membuat akun baru
            return view('adminpage.user.create', compact('roles', 'hasAccount'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'posisi' => 'required|string|max:50',
            'status' => 'required|in:Tetap,freelance',
            'pengalaman' => 'nullable|string|max:255',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'npwp' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'ijazah' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'cv' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        // Proses upload file
        $ktpPath = $request->file('ktp') ? $request->file('ktp')->store('uploads/ktp', 'public') : null;
        $npwpPath = $request->file('npwp') ? $request->file('npwp')->store('uploads/npwp', 'public') : null;
        $ijazahPath = $request->file('ijazah') ? $request->file('ijazah')->store('uploads/ijazah', 'public') : null;
        $cvPath = $request->file('cv') ? $request->file('cv')->store('uploads/cv', 'public') : null;
        $imagePath = $request->file('image') ? $request->file('image')->store('uploads/image', 'public') : null;

        // Ubah role user menjadi 3
        $user = User::findOrFail($validated['user_id']);
        if ($user->role_id != 1) {
            $user->role_id = 3;
            $user->save();
        }

        // Simpan data tim baru
        Team::create([
            'user_id' => $validated['user_id'],
            'posisi' => $validated['posisi'],
            'status' => $validated['status'],
            'pengalaman' => $validated['pengalaman'] ?? null,
            'ktp' => $ktpPath,
            'npwp' => $npwpPath,
            'ijazah' => $ijazahPath,
            'cv' => $cvPath,
            'image' => $imagePath,
        ]);

        // Redirect ke halaman daftar tim dengan pesan sukses
        return redirect()->route('admin.teams.index')->with('success', 'Team berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
        $users = User::all();
        return view('adminpage.team.edit', compact('team', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'posisi' => 'required|string|max:50',
            'status' => 'required|in:Tetap,freelance',
            'pengalaman' => 'nullable|string|max:255',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'npwp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ijazah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses upload file baru jika ada
        if ($request->hasFile('ktp')) {
            $ktpPath = $request->file('ktp')->store('uploads/ktp', 'public');
            if ($team->ktp) {
                Storage::disk('public')->delete($team->ktp); // Hapus file lama
            }
            $team->ktp = $ktpPath;
        }

        if ($request->hasFile('npwp')) {
            $npwpPath = $request->file('npwp')->store('uploads/npwp', 'public');
            if ($team->npwp) {
                Storage::disk('public')->delete($team->npwp); // Hapus file lama
            }
            $team->npwp = $npwpPath;
        }

        if ($request->hasFile('ijazah')) {
            $ijazahPath = $request->file('ijazah')->store('uploads/ijazah', 'public');
            if ($team->ijazah) {
                Storage::disk('public')->delete($team->ijazah); // Hapus file lama
            }
            $team->ijazah = $ijazahPath;
        }

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('uploads/cv', 'public');
            if ($team->cv) {
                Storage::disk('public')->delete($team->cv); // Hapus file lama
            }
            $team->cv = $cvPath;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/image', 'public');
            if ($team->image) {
                Storage::disk('public')->delete($team->image); // Hapus file lama
            }
            $team->image = $imagePath;
        }

        // Perbarui data tim
        $team->user_id = $validated['user_id'];
        $team->posisi = $validated['posisi'];
        $team->status = $validated['status'];
        $team->save();

        // Redirect ke halaman daftar tim dengan pesan sukses
        return redirect()->route('admin.teams.index')->with('success', 'Team berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        // Hapus file dokumen jika ada
        if ($team->ktp) {
            Storage::disk('public')->delete($team->ktp);
        }

        if ($team->npwp) {
            Storage::disk('public')->delete($team->npwp);
        }

        if ($team->ijazah) {
            Storage::disk('public')->delete($team->ijazah);
        }

        if ($team->cv) {
            Storage::disk('public')->delete($team->cv);
        }

        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }

        // Hapus data tim dari database
        $team->delete();

        // Redirect ke halaman daftar tim dengan pesan sukses
        return redirect()->route('admin.teams.index')->with('success', 'Team berhasil dihapus.');
    }
}
