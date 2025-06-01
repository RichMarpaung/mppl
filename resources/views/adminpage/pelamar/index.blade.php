@extends('layouts.master-admin')

@section('judul', 'Daftar Pelamar')

@section('content')
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Daftar Pelamar</h5>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">Nomor</th> <!-- Kolom Nomor -->
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Email</th>
                    <th scope="col">Lowongan</th>
                    <th scope="col">CV</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelamars as $index => $pelamar) <!-- Tambahkan $index untuk nomor -->
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                    <td>{{ $pelamar->user->name }}</td>
                    <td>{{ $pelamar->user->nik }}</td>
                    <td>{{ $pelamar->user->email }}</td>
                    <td>{{ $pelamar->lowongan->nama }}</td>
                    <td>
                        @if($pelamar->cv)
                            <!-- Tombol Lihat CV -->
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#cvModal{{ $pelamar->id }}">
                                Lihat CV
                            </button>

                            <!-- Modal untuk menampilkan CV -->
                            <div class="modal fade" id="cvModal{{ $pelamar->id }}" tabindex="-1" aria-labelledby="cvModalLabel{{ $pelamar->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cvModalLabel{{ $pelamar->id }}">CV Pelamar: {{ $pelamar->user->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ Storage::url($pelamar->cv) }}" frameborder="0" style="width: 100%; height: 500px;"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">Tidak Ada</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $pelamar->status == 'diterima' ? 'success' : ($pelamar->status == 'diproses' ? 'warning' : 'danger') }}">
                            {{ ucfirst($pelamar->status) }}
                        </span>
                    </td>
                    <td>
                        <!-- Tombol Aksi -->
                        <form action="{{ route('admin.pelamars.update', $pelamar->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="diterima">
                            <button type="submit" class="btn btn-sm btn-success">Terima</button>
                        </form>
                        <form action="{{ route('admin.pelamars.update', $pelamar->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="diproses">
                            <button type="submit" class="btn btn-sm btn-warning">Diproses</button>
                        </form>
                        <form action="{{ route('admin.pelamars.update', $pelamar->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="ditolak">
                            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // Inisialisasi DataTables
    });
</script>
@endpush
