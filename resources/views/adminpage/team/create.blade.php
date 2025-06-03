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
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input Posisi -->
                    <div class="col-12">
                        <label for="posisi" class="form-label">Posisi:</label>
                        <input type="text" name="posisi" id="posisi" class="form-control"
                            placeholder="Masukkan posisi" required>
                    </div>
                    <!-- Pengalaman -->
                    <div class="col-12">
                        <label for="pengalaman" class="form-label">Pengalaman:</label>
                        <textarea name="pengalaman" id="pengalaman" class="form-control" rows="3"
                            placeholder="Deskripsi singkat pengalaman"></textarea>
                    </div>
                    <!-- Pilih Status -->
                    <div class="col-12">
                        <label for="status" class="form-label">Status:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Tetap">Tetap</option>
                            <option value="freelance">Freelance</option>
                        </select>
                    </div>

                    <!-- Upload KTP -->
                    <div class="col-12">
                        <label for="ktp" class="form-label">Upload KTP:</label>
                        <input type="file" name="ktp" id="ktp" class="form-control" accept="image/*">
                    </div>

                    <!-- Upload NPWP -->
                    <div class="col-12">
                        <label for="npwp" class="form-label">Upload NPWP:</label>
                        <input type="file" name="npwp" id="npwp" class="form-control" accept="image/*">
                    </div>

                    <!-- Upload Ijazah -->
                    <div class="col-12">
                        <label for="ijazah" class="form-label">Upload Ijazah:</label>
                        <input type="file" name="ijazah" id="ijazah" class="form-control" accept="image/*">
                    </div>

                    <!-- Upload CV -->
                    <div class="col-12">
                        <label for="cv" class="form-label">Upload CV:</label>
                        <input type="file" name="cv" id="cv" class="form-control" accept="image/*">
                    </div>

                    <!-- Upload Image -->

                    <div class="col-12">
                        <label for="image" class="form-label">Upload Image:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
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
