<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    //
    public function lowongan()
    {
        $lowongans = Lowongan::where('status', 'dibuka')->get();
        return view('userpage.lowongan', compact('lowongans'));
    }

    /**
     * Tampilkan halaman profil user.
     */
    public function profile()
    {
        return view('userpage.profile');
    }
}
