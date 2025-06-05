@extends('layouts.master-user')
@section('title', 'Berita')
@section('content')
    <!-- Kotak merah di atas container -->
    <div class="w-100" style="background:#c5172c;height:100px;display:flex;align-items:center;justify-content:center;">
    </div>
    <div class="container py-5 mt-5">
        <h2 class="mt-4 text-center fw-bold">Berita Terbaru</h2>
        <div class="row gy-4">
            @forelse($news as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm">
                        @if ($item->image)
                            <img src="{{ Storage::url($item->image) }}" class="card-img-top" alt="Gambar Berita"
                                style="height:200px;object-fit:cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text">{{ Str::limit($item->deskripsi, 120) }}</p>
                            @if ($item->link)
                                <a href="{{ $item->link }}" class="btn btn-primary mt-auto" target="_blank">Baca
                                    Selengkapnya</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada berita yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
