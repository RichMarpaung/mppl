@extends('layouts.master-admin')
@section('judul', 'Edit Service')
@section('content')
    <div class="card">

        <div class="card-body">
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row gy-3">
                    <div class="col-12">
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" value="{{ $service->nama }}" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ $service->deskripsi }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="harga">Harga:</label>
                        <input type="number" name="harga" id="harga" value="{{ $service->harga }}" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
