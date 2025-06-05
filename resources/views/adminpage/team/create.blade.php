@extends('layouts.master-admin')

@section('judul', 'Buat Team Baru')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Form Buat Team Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row gy-3">
                    <!-- Pilih User -->
                    <div class="col-12">
                        <label for="user_id" class="form-label">Pilih User:</label>
                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                            <option value="">-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Posisi -->
                    <div class="col-12">
                        <label for="posisi" class="form-label">Posisi:</label>
                        <input type="text" name="posisi" id="posisi" class="form-control @error('posisi') is-invalid @enderror"
                            placeholder="Masukkan posisi" required value="{{ old('posisi') }}">
                        @error('posisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Pengalaman -->
                    <div class="col-12">
                        <label for="pengalaman" class="form-label">Pengalaman:</label>
                        <textarea name="pengalaman" id="pengalaman" class="form-control @error('pengalaman') is-invalid @enderror" rows="3"
                            placeholder="Deskripsi singkat pengalaman">{{ old('pengalaman') }}</textarea>
                        @error('pengalaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Pilih Status -->
                    <div class="col-12">
                        <label for="status" class="form-label">Status:</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Tetap" {{ old('status') == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                            <option value="freelance" {{ old('status') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload KTP -->
                    <div class="col-12">
                        <label for="ktp" class="form-label">Upload KTP:</label>
                        <input type="file" name="ktp" id="ktp" class="form-control @error('ktp') is-invalid @enderror" accept="image/*">
                        @error('ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload NPWP -->
                    <div class="col-12">
                        <label for="npwp" class="form-label">Upload NPWP:</label>
                        <input type="file" name="npwp" id="npwp" class="form-control @error('npwp') is-invalid @enderror" accept="image/*">
                        @error('npwp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Ijazah -->
                    <div class="col-12">
                        <label for="ijazah" class="form-label">Upload Ijazah:</label>
                        <input type="file" name="ijazah" id="ijazah" class="form-control @error('ijazah') is-invalid @enderror" accept="image/*">
                        @error('ijazah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload CV -->
                    <div class="col-12">
                        <label for="cv" class="form-label">Upload CV:</label>
                        <input type="file" name="cv" id="cv" class="form-control @error('cv') is-invalid @enderror" accept="image/*">
                        @error('cv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Image -->
                    <div class="col-12">
                        <label for="image" class="form-label">Upload Image:</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Tombol Submit -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
