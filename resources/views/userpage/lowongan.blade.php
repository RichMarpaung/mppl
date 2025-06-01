@extends('layouts.master-user')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">

    <div class="container mt-5">
        <h1 class="mb-4">Daftar Lowongan Kerja</h1>
        <div class="row">
            @foreach($lowongans as $lowongan)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($lowongan->poster)
                            <img src="{{ Storage::url($lowongan->poster) }}" class="card-img-top" alt="Poster" style="max-width: 300px; max-height: 300px; object-fit: cover; margin: auto;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $lowongan->nama }}</h5>
                            <p class="card-text"><strong>Deskripsi:</strong> {{ Str::limit($lowongan->deskripsi, 100) }}</p>
                            <p class="card-text"><strong>Kualifikasi:</strong> {{ Str::limit($lowongan->kualifikasi, 100) }}</p>
                            <p class="card-text"><strong>Gaji:</strong> Rp {{ number_format($lowongan->gaji, 2, ',', '.') }}</p>
                            <p class="card-text"><strong>Tanggal Ditutup:</strong> {{ $lowongan->tanggal_ditutup }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ ucfirst($lowongan->status) }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('user.pelamars.create', $lowongan->id) }}" class="btn btn-primary">Lamar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </section>
</main>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
@endsection
