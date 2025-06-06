{{-- filepath: c:\laragon\www\Mppl\resources\views\adminpage\task\create.blade.php --}}
@extends('layouts.master-admin')
@section('judul', 'Tambah Task')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Task</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Judul Task</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" required value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}">
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file_ask" class="form-label">File Penjelasan Tugas (file_ask)</label>
                    <input type="file" name="file_ask" id="file_ask" class="form-control @error('file_ask') is-invalid @enderror">
                    @error('file_ask')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="team_id" class="form-label">Team</label>
                    <select name="team_id" id="team_id" class="form-control @error('team_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Team --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                {{ $team->user->name ?? '-' }} - {{ $team->posisi ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('team_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="in-progres" {{ old('status') == 'in-progres' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="revisi" {{ old('status') == 'revisi' ? 'selected' : '' }}>Revisi</option>
                        <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="late" {{ old('status') == 'late' ? 'selected' : '' }}>Late</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan (jika revisi)</label>
                    <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="2">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
