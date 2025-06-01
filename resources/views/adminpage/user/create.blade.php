@extends('layouts.master-admin')

@section('judul', 'Buat User Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Buat User Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="row gy-3">
                <!-- Input Nama -->
                <div class="col-12">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" required>
                </div>

                <!-- Input NIK -->
                <div class="col-12">
                    <label for="nik" class="form-label">NIK:</label>
                    <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" required>
                </div>

                <!-- Input Email -->
                <div class="col-12">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <!-- Input Password -->
                <div class="col-12">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <!-- Input Nomor HP -->
                <div class="col-12">
                    <label for="phone" class="form-label">Nomor HP:</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan nomor HP">
                </div>

                <!-- Input Alamat -->
                <div class="col-12">
                    <label for="address" class="form-label">Alamat:</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Masukkan alamat"></textarea>
                </div>

                <!-- Pilih Role -->
                <div class="col-12">
                    <label for="role_id" class="form-label">Role:</label>
                    <select name="role_id" id="role_id" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
