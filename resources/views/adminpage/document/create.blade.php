<!-- filepath: resources/views/adminpage/document/create.blade.php -->
@extends('layouts.master-admin')
@section('judul','Upload Dokumen')
@section('content')
<div class="card">

    <div class="card-body">

        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gy-3">
            <div class="col-12">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="file">File:</label>
                <input type="file" name="path" id="path" class="form-control @error('path') is-invalid @enderror" required>
                @error('path')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">

                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
        </form>

    </div>
</div>

@endsection
