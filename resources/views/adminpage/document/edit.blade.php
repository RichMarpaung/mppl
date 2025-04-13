<!-- filepath: resources/views/adminpage/document/edit.blade.php -->
@extends('layouts.master-admin')
@section('judul','Edit Dokumen')
@section('content')
    <div class="card">

        <div class="card-body">
            <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')<div class="row gy-3">
                    <div class="col-12">
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror" value="{{ $document->nama }}" required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="file">File:</label>
                        <input type="file" name="path" id="path"
                            class="form-control @error('path') is-invalid @enderror">
                        @error('path')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small>Current file: <a href="{{ Storage::url($document->path) }}"
                                target="_blank">{{ basename($document->nama) }}</a></small>
                    </div>
                    <div class="col-12">

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
