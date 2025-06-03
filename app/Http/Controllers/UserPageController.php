<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserPageController extends Controller
{
    //

    public function lowongan()
    {
        $lowongans = Lowongan::where('status', 'dibuka')->get();
        return view('userpage.lowongan', compact('lowongans'));
    }
    public function dashboard()
    {
        $services = Service::all();
        $teams = Team::all();
        $lowongans = Lowongan::where('status', 'dibuka')->get();
<<<<<<< HEAD
        return view('userpage.index', compact('teams', 'lowongans', 'services'));
=======
        $portofolios = \App\Models\Portofolio::latest()->get();
return view('userpage.index', compact('teams', 'lowongans', 'services', 'portofolios'));
>>>>>>> 2030b8ef96b932b5d2522a6ab437a81880df1567
    }

    /**
     * Tampilkan halaman profil user.
     */
    public function adminprofile()
    {
        return view('adminpage.profile');
    }
    public function profile()
    {
        $orders = \App\Models\Order::where('user_id', Auth::id())->get();
<<<<<<< HEAD
        $lowongans = \App\Models\Lowongan::all();
        return view('userpage.profile', compact('orders', 'lowongans'));
=======
$pelamarans = \App\Models\Pelamar::with('lowongan')
    ->where('user_id', Auth::id())
    ->get();

return view('userpage.profile', compact('orders', 'pelamarans'));
>>>>>>> 2030b8ef96b932b5d2522a6ab437a81880df1567
    }
    public function updateProfile(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15|unique:users,phone,' . $user->id,
            'nik' => 'nullable|string|max:16|unique:users,nik,' . $user->id,
            'address' => 'nullable|string|max:255',
        ]);
        $user->update($validated);
        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePhoto(Request $request)
    {
        $user = \App\Models\User::findOrFail(Auth::id());
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:20048',
        ]);
        // Hapus foto lama jika ada dan file-nya ada di storage
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }
        $path = $request->file('photo')->store('photos', 'public');
        $user->photo = $path;
        $user->save();
        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = \App\Models\User::find(Auth::id());
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Password berhasil diubah.');
        } else {
            return back()->withErrors(['user' => 'User not found.']);
        }
    }
}
