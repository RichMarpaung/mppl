<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortofolioRequest;
use App\Http\Requests\UpdatePortofolioRequest;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = Portofolio::latest()->get();
        return view('adminpage.portofolio.index', compact('portofolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpage.portofolio.create');
    }


    public function show(Portofolio $portofolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portofolio $portofolio)
    {
        return view('adminpage.portofolio.edit', compact('portofolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:50',
            'mitra'       => 'required|string|max:100',
            'lokasi'      => 'required|string|max:100',
            'waktu'       => 'required|date',
            'image_mitra' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail'      => 'required|string',
            'link'        => 'nullable|url|max:255',
        ]);

        $imageMitraPath = $request->file('image_mitra') ? $request->file('image_mitra')->store('portofolio/mitra', 'public') : null;
        $imagePath      = $request->file('image') ? $request->file('image')->store('portofolio/image', 'public') : null;

        Portofolio::create([
            'nama'        => $validated['nama'],
            'mitra'       => $validated['mitra'],
            'lokasi'      => $validated['lokasi'],
            'waktu'       => $validated['waktu'],
            'image_mitra' => $imageMitraPath,
            'image'       => $imagePath,
            'detail'      => $validated['detail'],
            'link'        => $validated['link'] ?? null,
        ]);

        return redirect()->route('admin.portofolios.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:50',
            'mitra'       => 'required|string|max:100',
            'lokasi'      => 'required|string|max:100',
            'waktu'       => 'required|date',
            'image_mitra' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail'      => 'required|string',
            'link'        => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image_mitra')) {
            if ($portofolio->image_mitra) {
                Storage::disk('public')->delete($portofolio->image_mitra);
            }
            $portofolio->image_mitra = $request->file('image_mitra')->store('portofolio/mitra', 'public');
        }

        if ($request->hasFile('image')) {
            if ($portofolio->image) {
                Storage::disk('public')->delete($portofolio->image);
            }
            $portofolio->image = $request->file('image')->store('portofolio/image', 'public');
        }

        $portofolio->nama = $validated['nama'];
        $portofolio->mitra = $validated['mitra'];
        $portofolio->lokasi = $validated['lokasi'];
        $portofolio->waktu = $validated['waktu'];
        $portofolio->detail = $validated['detail'];
        $portofolio->link = $validated['link'] ?? null;
        $portofolio->save();

        return redirect()->route('admin.portofolios.index')->with('success', 'Portofolio berhasil diupdate.');
    }
    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Portofolio $portofolio)
{
    // Hapus file gambar jika ada
    if ($portofolio->image_mitra) {
        Storage::disk('public')->delete($portofolio->image_mitra);
    }
    if ($portofolio->image) {
        Storage::disk('public')->delete($portofolio->image);
    }

    $portofolio->delete();

    return redirect()->route('admin.portofolios.index')->with('success', 'Portofolio berhasil dihapus.');
}
}
