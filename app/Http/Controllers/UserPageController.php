<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\News;
use App\Models\Order;
use App\Models\Pelamar;
use App\Models\Portofolio;
use App\Models\Service;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
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
        $portofolios = Portofolio::latest()->get();

        // Ambil 4 news terakhir
        $news = News::latest()->take(4)->get();

        return view('userpage.index', compact('teams', 'lowongans', 'services', 'portofolios', 'news'));
    }
    public function about()
    {
        return view('userpage.tentang');
    }

    /**
     * Tampilkan halaman profil user.
     */
    public function adminprofile()
    {
        return view('adminpage.profile');
    }
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalTeams = Team::count();

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $ordersToday = Order::whereDate('created_at', $today)->count();
        $ordersYesterday = Order::whereDate('created_at', $yesterday)->count();

        // Hitung pertumbuhan (growth)
        $orderGrowth = $ordersYesterday > 0
            ? round((($ordersToday - $ordersYesterday) / $ordersYesterday) * 100)
            : ($ordersToday > 0 ? 100 : 0);

        return view('adminpage.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalTeams',
            'ordersToday',
            'orderGrowth'
        ));
    }
    public function profile()
    {

        return view('userpage.profiles.index');
    }
    public function profileLowongan()
    {
        $pelamarans = Pelamar::with('lowongan')
            ->where('user_id', Auth::id())
            ->get();

        return view('userpage.profiles.lowongan', compact('pelamarans'));
    }
    public function profileOrder()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('userpage.profiles.pesanan', compact('orders'));
    }
    public function profileTask()
    {
        // Ambil semua team yang dimiliki user login
        $teams = Team::where('user_id', Auth::id())->pluck('id');

        // Ambil semua task yang terkait dengan team user
        $tasks = Task::whereIn('team_id', $teams)->latest()->get();

        return view('userpage.profiles.task', compact('tasks'));
    }
    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
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
        $user = User::findOrFail(Auth::id());
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
        $user = User::find(Auth::id());
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Password berhasil diubah.');
        } else {
            return back()->withErrors(['user' => 'User not found.']);
        }
    }
    public function uploadTaskFile(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $team = Team::where('user_id', Auth::id())->first();

        if (!$team || $task->team_id != $team->id) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'file_task' => 'required|file|max:20048',
        ]);

        // Hapus file lama jika ada
        if ($task->file_task && Storage::disk('public')->exists($task->file_task)) {
            Storage::disk('public')->delete($task->file_task);
        }

        // Simpan file baru
        $task->file_task = $request->file('file_task')->store('tasks/file_task', 'public');
        $task->status = 'completed'; // opsional
        $task->save();

        return redirect()->back()->with('success', 'File task berhasil diupload.');
    }
}
