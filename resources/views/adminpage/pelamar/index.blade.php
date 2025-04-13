<!-- filepath: resources/views/adminpage/pelamar/index.blade.php -->
@extends('layouts.master-admin')

@section('content')
    <div class="container mt-5">
        <h1>Daftar Pelamar</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Email</th>
                    <th>Lowongan</th>
                    <th>CV</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelamars as $pelamar)
                    <tr>
                        <td>{{ $pelamar->user->name }}</td>
                        <td>{{ $pelamar->user->nik }}</td>
                        <td>{{ $pelamar->user->email }}</td>
                        <td>{{ $pelamar->lowongan->nama }}</td>
                        <td>
                            <!-- Tombol untuk membuka popup -->
                            <a href="#" data-toggle="modal" data-target="#cvModal{{ $pelamar->id }}" class="btn btn-info">Lihat CV</a>

                            <!-- Modal untuk menampilkan CV -->
                            <div class="modal fade" id="cvModal{{ $pelamar->id }}" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel{{ $pelamar->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cvModalLabel{{ $pelamar->id }}">CV Pelamar: {{ $pelamar->user->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ Storage::url($pelamar->cv) }}" frameborder="0" style="width: 100%; height: 500px;"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ ucfirst($pelamar->status) }}</td>
                        <td>
                            <!-- Tombol Aksi -->
                            <form action="{{ route('admin.pelamars.update', $pelamar->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="diterima">
                                <button type="submit" class="btn btn-success">Terima</button>
                            </form>
                            <form action="{{ route('admin.pelamars.update', $pelamar->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="diproses">
                                <button type="submit" class="btn btn-warning">Diproses</button>
                            </form>
                            <form action="{{ route('admin.pelamars.update', $pelamar->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
