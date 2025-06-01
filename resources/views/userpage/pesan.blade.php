@extends('layouts.master-user')

@section('content')
    <!-- Kotak Merah --><style>
    #header {
        background-color: rgba(196, 32, 32, 0.9); /* Warna abu-abu terang */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan untuk efek */
        z-index: 999; /* Pastikan navbar berada di atas elemen lainnya */
    }
body {
        padding-top: 70px; /* Tambahkan jarak untuk menghindari navbar */
    }

</style>

        <div class="container mt-5">
        <h1 class="mb-4">Pesan Layanan</h1>
        <form action="{{ route('user.orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div class="form-group mb-3">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', auth()->user()->name ?? '') }}" readonly>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email ?? '') }}" readonly>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Pilih Layanan -->
            <div class="form-group mb-3">
                <label for="service_id">Pilih Layanan:</label>
                <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih layanan</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->nama }} - Rp {{ number_format($service->harga, 2, ',', '.') }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- SRS -->
            <div class="form-group mb-3">
                <label for="srs">Upload SRS (Opsional):</label>
                <input type="file" name="srs" id="srs" class="form-control @error('srs') is-invalid @enderror" accept=".pdf">
                @error('srs')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Status -->
            <input type="hidden" name="status" value="pending">

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
        </form>
    </div>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
@endif
    <!-- Modal Berhasil -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Pesanan Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Pesanan Anda telah berhasil dikirim. Kami akan segera memprosesnya. Terima kasih!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
