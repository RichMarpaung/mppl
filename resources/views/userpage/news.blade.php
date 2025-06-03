@extends('layouts.master-user')
@section('judul', 'Berita')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Berita Terbaru</h2>
    <div class="row gy-4">
        @forelse($news as $item)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    @if($item->image)
                        <img src="{{ Storage::url($item->image) }}" class="card-img-top" alt="Gambar Berita" style="height:200px;object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text">{{ Str::limit($item->deskripsi, 120) }}</p>
                        @if($item->link)
                            <a href="{{ $item->link }}" class="btn btn-primary mt-auto" target="_blank">Baca Selengkapnya</a>
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
