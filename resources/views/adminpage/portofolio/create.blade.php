@extends('layouts.master-admin')
@section('judul', 'Tambah Portofolio')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Portofolio</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.portofolios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Portofolio</label>
                    <input type="text" name="nama" id="nama" class="form-control" required maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="mitra" class="form-label">Mitra</label>
                    <input type="text" name="mitra" id="mitra" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="date" name="waktu" id="waktu" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="image_mitra" class="form-label">Gambar Mitra</label>
                    <input type="file" name="image_mitra" id="image_mitra" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Portofolio</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="detail" class="form-label">Detail</label>
                    <textarea name="detail" id="detail" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" name="link" id="link" class="form-control"
                        placeholder="https://contoh.com" value="{{ old('link') }}">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.portofolios.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
