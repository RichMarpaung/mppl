@extends('layouts.master-admin')
@section('judul', 'Lowongan Pekerjaan')
@section('content')
    <div class="card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0">Tabel Lowongan</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.lowongans.create') }}" class="btn btn-primary mb-3">Create New Lowongan</a>

            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>

                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Tanggal Tutup</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowongans as $lowongan)
                        <tr>
                            <td>{{ $lowongan->id }}</td>
                            <td>{{ $lowongan->nama }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($lowongan->tanggal_ditutup)->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                @if (strtolower($lowongan->status) == 'dibuka')
                                    <span
                                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">
                                        Dibuka
                                    </span>
                                @else
                                    <span
                                        class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">
                                        {{ ucfirst($lowongan->status) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $lowongan->id }}"
                                    class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                </a>
                                <div class="modal fade" id="modalDetail{{ $lowongan->id }}" tabindex="-1"
                                    aria-labelledby="modalDetailLabel{{ $lowongan->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDetailLabel{{ $lowongan->id }}">Detail Lowongan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama:</strong> {{ $lowongan->nama }}</p>
                                                <p><strong>Deskripsi:</strong> {{ $lowongan->deskripsi }}</p>
                                                <p><strong>Kualifikasi:</strong> {{ $lowongan->kualifikasi }}</p>
                                                <p><strong>Gaji:</strong> {{ $lowongan->gaji }}</p>
                                                <p><strong>Tanggal Ditutup:</strong>  {{ \Carbon\Carbon::parse($lowongan->tanggal_ditutup)->translatedFormat('d F Y') }}</p>
                                                <p><strong>Status:</strong> {{ ucfirst($lowongan->status) }}</p>

                                                @if ($lowongan->poster)
                                                    <p><strong>Poster:</strong></p>
                                                    <img src="{{ Storage::url($lowongan->poster) }}" class="img-fluid" alt="Poster">
                                                @else
                                                    <p>No Poster</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.lowongans.edit', $lowongan->id) }}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.lowongans.destroy', $lowongan->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"> <iconify-icon icon="mingcute:delete-2-line"></iconify-icon></button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>





@endsection

@section('scripts')
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
