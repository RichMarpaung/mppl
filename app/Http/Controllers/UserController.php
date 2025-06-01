<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('adminpage.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
    return view('adminpage.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'nik' => 'required|string|max:16|unique:users,nik',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'phone' => 'nullable|string|max:15|unique:users,phone',
        'address' => 'nullable|string|max:255',
        'role_id' => 'required|exists:roles,id',
    ]);

    // Simpan user baru
    User::create([
        'name' => $validated['name'],
        'nik' => $validated['nik'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']), // Enkripsi password
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'role_id' => $validated['role_id'],
    ]);

    // Redirect ke halaman daftar user dengan pesan sukses
    return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('adminpage.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'nik' => 'required|string|max:16|unique:users,nik,' . $id,
        'phone' => 'nullable|string|max:15|unique:users,phone,' . $id,
        'address' => 'nullable|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8', // Password opsional
        'role_id' => 'required|exists:roles,id',
    ]);

    // Ambil data user berdasarkan ID
    $user = User::findOrFail($id);

    // Perbarui data user
    $user->name = $validated['name'];
    $user->nik = $validated['nik'];
    $user->phone = $validated['phone'];
    $user->address = $validated['address'];
    $user->email = $validated['email'];
    $user->role_id = $validated['role_id'];

    // Perbarui password jika diisi
    if (!empty($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }

    $user->save();

    // Redirect ke halaman daftar user dengan pesan sukses
    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Ambil data user berdasarkan ID
    $user = User::findOrFail($id);

    // Hapus data user dari database
    $user->delete();

    // Redirect ke halaman daftar user dengan pesan sukses
    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
}
}
