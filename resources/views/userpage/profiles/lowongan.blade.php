@extends('layouts.profile-user')
@section('title', 'Lowongan')
@section('profile-content')

            <div class="card basic-data-table">
                <div class="card-body">
                    <h5 class="mb-3">Lowongan yang Diikuti</h5>
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTableLowongan" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Status Lowongan</th>
                                    <th scope="col">Status Pendaftaran</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelamarans as $pelamar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pelamar->lowongan->nama ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ ($pelamar->lowongan->status ?? '') === 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($pelamar->lowongan->status ?? '-') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge
                                                @if(($pelamar->status ?? '') === 'diterima') bg-success
                                                @elseif(($pelamar->status ?? '') === 'diproses') bg-warning
                                                @elseif(($pelamar->status ?? '') === 'ditolak') bg-danger
                                                @else bg-secondary
                                                @endif">
                                                {{ ucfirst($pelamar->status ?? '-') }}
                                            </span>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada lowongan yang didaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection
