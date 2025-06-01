@extends('layouts.master-admin')

@section('judul', 'Edit Team')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Team</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gy-3">
                <!-- Pilih User -->
                <div class="col-12">
                    <label for="user_id" class="form-label">Pilih User:</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $team->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} - {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Posisi -->
                <div class="col-12">
                    <label for="posisi" class="form-label">Posisi:</label>
                    <input type="text" name="posisi" id="posisi" class="form-control" value="{{ $team->posisi }}" required>
                </div>

                <!-- Pilih Status -->
                <div class="col-12">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Tetap" {{ $team->status == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                        <option value="freelance" {{ $team->status == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                </div>

                <!-- Upload KTP -->
                <div class="col-12">
                    <label for="ktp" class="form-label">Upload KTP:</label>
                    @if($team->ktp)
                        <p>Dokumen saat ini: <a href="{{ asset('storage/' . $team->ktp) }}" target="_blank">Lihat KTP</a></p>
                    @endif
                    <input type="file" name="ktp" id="ktp" class="form-control" accept="image/*">
                </div>

                <!-- Upload NPWP -->
                <div class="col-12">
                    <label for="npwp" class="form-label">Upload NPWP:</label>
                    @if($team->npwp)
                        <p>Dokumen saat ini: <a href="{{ asset('storage/' . $team->npwp) }}" target="_blank">Lihat NPWP</a></p>
                    @endif
                    <input type="file" name="npwp" id="npwp" class="form-control" accept="image/*">
                </div>

                <!-- Upload Ijazah -->
                <div class="col-12">
                    <label for="ijazah" class="form-label">Upload Ijazah:</label>
                    @if($team->ijazah)
                        <p>Dokumen saat ini: <a href="{{ asset('storage/' . $team->ijazah) }}" target="_blank">Lihat Ijazah</a></p>
                    @endif
                    <input type="file" name="ijazah" id="ijazah" class="form-control" accept="image/*">
                </div>

                <!-- Upload CV -->
                <div class="col-12">
                    <label for="cv" class="form-label">Upload CV:</label>
                    @if($team->cv)
                        <p>Dokumen saat ini: <a href="{{ asset('storage/' . $team->cv) }}" target="_blank">Lihat CV</a></p>
                    @endif
                    <input type="file" name="cv" id="cv" class="form-control" accept="image/*">
                </div>

                <!-- Tombol Submit -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
