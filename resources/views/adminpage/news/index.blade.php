@extends('layouts.master-admin')
@section('judul', 'Berita')
@section('content')
    <div class="card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0">Tabel Berita</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Link</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                            <td>
                                @if ($item->link)
                                    <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ Storage::url($item->image) }}" alt="Gambar" width="60">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}"
                                    class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                </a>
                                <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Detail
                                                    Berita</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Judul:</strong> {{ $item->judul }}</p>
                                                <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
                                                <p>
                                                    <strong>Link:</strong>
                                                    @if ($item->link)
                                                        <a href="{{ $item->link }}"
                                                            target="_blank">{{ $item->link }}</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </p>
                                                <p>
                                                    <strong>Gambar:</strong><br>
                                                    @if ($item->image)
                                                        <img src="{{ Storage::url($item->image) }}" class="img-fluid"
                                                            alt="Gambar Berita" style="max-width:200px;">
                                                    @else
                                                        <span class="text-muted">Tidak ada gambar</span>
                                                    @endif
                                                </p>
                                                <p><strong>Dibuat:</strong> {{ $item->created_at->format('d-m-Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.news.edit', $item->id) }}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
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
