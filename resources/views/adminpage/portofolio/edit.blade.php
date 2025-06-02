{{-- filepath: c:\laragon\www\Mppl\resources\views\adminpage\portofolio\edit.blade.php --}}
@extends('layouts.master-admin')
@section('judul','Edit Portofolio')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.portofolios.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gy-3">
                <div class="col-12">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $portofolio->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="mitra">Mitra:</label>
                    <input type="text" name="mitra" id="mitra" class="form-control @error('mitra') is-invalid @enderror" value="{{ old('mitra', $portofolio->mitra) }}" required>
                    @error('mitra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="lokasi">Lokasi:</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $portofolio->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="waktu">Waktu:</label>
                    <input type="date" name="waktu" id="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu', $portofolio->waktu ) }}" required>
                    @error('waktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="image_mitra">Gambar Mitra:</label>
                    <input type="file" name="image_mitra" id="image_mitra" class="form-control @error('image_mitra') is-invalid @enderror">
                    @error('image_mitra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($portofolio->image_mitra)
                        <small>Gambar saat ini: <a href="{{ Storage::url($portofolio->image_mitra) }}" target="_blank">{{ basename($portofolio->image_mitra) }}</a></small>
                    @endif
                </div>
                <div class="col-12">
                    <label for="image">Gambar Portofolio:</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($portofolio->image)
                        <small>Gambar saat ini: <a href="{{ Storage::url($portofolio->image) }}" target="_blank">{{ basename($portofolio->image) }}</a></small>
                    @endif
                </div>
                <div class="col-12">
                    <label for="detail">Detail:</label>
                    <textarea name="detail" id="detail" class="form-control @error('detail') is-invalid @enderror" required>{{ old('detail', $portofolio->detail) }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
    <label for="link">Link:</label>
    <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
           value="{{ old('link', $portofolio->link) }}" placeholder="https://contoh.com">
    @error('link')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.portofolios.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
