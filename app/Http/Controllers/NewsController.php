<?php


namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function userIndex()
{
    $news = News::latest()->get();
    return view('userpage.news', compact('news'));
}
    public function index()
    {
        $news = News::latest()->get();
        return view('adminpage.news.index', compact('news'));
    }

    public function create()
    {
        return view('adminpage.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('news', 'public') : null;

        News::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'link' => $validated['link'] ?? null,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(News $news)
    {
        return view('adminpage.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('adminpage.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $news->image = $request->file('image')->store('news', 'public');
        }

        $news->judul = $validated['judul'];
        $news->deskripsi = $validated['deskripsi'];
        $news->link = $validated['link'] ?? null;
        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
