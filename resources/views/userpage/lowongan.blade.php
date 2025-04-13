<!-- filepath: resources/views/userpage/lowongan.blade.php -->
@extends('layouts.master-user')

@section('content')
    <div class="container mt-5">
        <h1>Daftar Lowongan Kerja</h1>
        @foreach($lowongans as $lowongan)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $lowongan->nama }}</h5>
                    <p class="card-text"><strong>Deskripsi:</strong> {{ Str::limit($lowongan->deskripsi, 100) }}</p>
                    <p class="card-text"><strong>Kualifikasi:</strong> {{ Str::limit($lowongan->kualifikasi, 100) }}</p>
                    <p class="card-text"><strong>Gaji:</strong> Rp {{ number_format($lowongan->gaji, 2, ',', '.') }}</p>
                    <p class="card-text"><strong>Tanggal Ditutup:</strong> {{ $lowongan->tanggal_ditutup }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ ucfirst($lowongan->status) }}</p>
                    @if($lowongan->poster)
                        <img src="{{ Storage::url($lowongan->poster) }}" class="img-fluid mb-3" alt="Poster">
                    @endif
                    <a href="{{ route('user.pelamars.create', $lowongan->id) }}" class="btn btn-primary">Lamar</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
