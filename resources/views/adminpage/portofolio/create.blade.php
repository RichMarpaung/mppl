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
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" required value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mitra" class="form-label">Mitra</label>
                    <input type="text" name="mitra" id="mitra" class="form-control @error('mitra') is-invalid @enderror" required value="{{ old('mitra') }}">
                    @error('mitra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" required value="{{ old('lokasi') }}">
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="date" name="waktu" id="waktu" class="form-control @error('waktu') is-invalid @enderror" required value="{{ old('waktu') }}">
                    @error('waktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image_mitra" class="form-label">Gambar Mitra</label>
                    <input type="file" name="image_mitra" id="image_mitra" class="form-control @error('image_mitra') is-invalid @enderror" accept="image/*">
                    @error('image_mitra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Portofolio</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="detail" class="form-label">Detail</label>
                    <textarea name="detail" id="detail" class="form-control @error('detail') is-invalid @enderror" rows="4" required>{{ old('detail') }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
                        placeholder="https://contoh.com" value="{{ old('link') }}">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.portofolios.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
