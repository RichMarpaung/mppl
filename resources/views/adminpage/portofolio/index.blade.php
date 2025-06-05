{{-- filepath: c:\laragon\www\Mppl\resources\views\adminpage\portofolio\index.blade.php --}}
@extends('layouts.master-admin')
@section('judul', 'Portofolio')
@section('content')
    <div class="card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0">Tabel Portofolio</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.portofolios.create') }}" class="btn btn-primary mb-3">Tambah Portofolio</a>
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nama Mitra</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($portofolios as $portofolio)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $portofolio->nama }}</td>
                            <td>{{ $portofolio->mitra }}</td>
                            <td>
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $portofolio->id }}"
                                    class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                </a>
                                <div class="modal fade" id="modalDetail{{ $portofolio->id }}" tabindex="-1"
                                    aria-labelledby="modalDetailLabel{{ $portofolio->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDetailLabel{{ $portofolio->id }}">Detail Portofolio</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama:</strong> {{ $portofolio->nama }}</p>
                                                <p><strong>Detail:</strong> {{ $portofolio->detail }}</p>
                                                <p><strong>Nama Mitra:</strong> {{ $portofolio->mitra }}</p>
                                                <p><strong>Lokasi:</strong> {{ $portofolio->lokasi }}</p>
                                                <p><strong>Tanggal:</strong> {{ $portofolio->waktu }}</p>
                                                <p>
                                                    <strong>Link:</strong>
                                                    @if ($portofolio->link)
                                                        <a href="{{ $portofolio->link }}" target="_blank">{{ $portofolio->link }}</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </p>
                                                <div class="mb-2">
                                                    <strong>Gambar Mitra:</strong><br>
                                                    @if ($portofolio->image_mitra)
                                                        <img src="{{ Storage::url($portofolio->image_mitra) }}" class="img-fluid mb-2" alt="Gambar Mitra" style="max-width:200px;">
                                                    @else
                                                        <span class="text-muted">Tidak ada gambar mitra</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <strong>Gambar Portofolio:</strong><br>
                                                    @if ($portofolio->image)
                                                        <img src="{{ Storage::url($portofolio->image) }}" class="img-fluid" alt="Gambar Portofolio" style="max-width:200px;">
                                                    @else
                                                        <span class="text-muted">Tidak ada gambar portofolio</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.portofolios.edit', $portofolio->id) }}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.portofolios.destroy', $portofolio->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
