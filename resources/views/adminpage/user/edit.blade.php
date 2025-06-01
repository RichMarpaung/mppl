@extends('layouts.master-admin')

@section('judul', 'Edit User')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit User</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gy-3">
                <!-- Input Nama -->
                <div class="col-12">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <!-- Input NIK -->
                <div class="col-12">
                    <label for="nik" class="form-label">NIK:</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="{{ $user->nik }}" maxlength="16" required>
                </div>

                <!-- Input Phone -->
                <div class="col-12">
                    <label for="phone" class="form-label">Nomor Telepon:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" maxlength="15">
                </div>

                <!-- Input Address -->
                <div class="col-12">
                    <label for="address" class="form-label">Alamat:</label>
                    <textarea name="address" id="address" class="form-control" rows="3">{{ $user->address }}</textarea>
                </div>

                <!-- Input Email -->
                <div class="col-12">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <!-- Input Password -->
                <div class="col-12">
                    <label for="password" class="form-label">Password (Opsional):</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <!-- Pilih Role -->
                <div class="col-12">
                    <label for="role_id" class="form-label">Role:</label>
                    <select name="role_id" id="role_id" class="form-control" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
