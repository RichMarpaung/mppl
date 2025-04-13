<!-- filepath: resources/views/adminpage/services/create.blade.php -->
@extends('layouts.master-admin')
@section('judul', 'Buat Service')
@section('content')

    <div class="card">

        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="row gy-3">
                    <div class="col-12">
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="harga">Harga:</label>
                        <input type="number" name="harga" id="harga" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
            </form>
        </div>
    </div>


@endsection
