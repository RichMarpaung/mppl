@extends('layouts.profile-user')

@section('title', 'Lowongan yang Diikuti')

@section('profile-content')

<div class="card basic-data-table">
    <div class="card-body">
        <h5 class="mb-3">Lowongan yang Diikuti</h5>

        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="dataTableLowongan" data-page-length='10'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lowongan</th>
                        <th>Status Lamaran</th>
                        <th>Jadwal Tahap Aktif</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelamarans as $pelamar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Nama Lowongan --}}
                            <td>
                                {{ $pelamar->lowongan->nama ?? 'Lowongan telah dihapus' }}
                            </td>

                            {{-- Status Lowongan --}}


                            {{-- Status Lamaran --}}
                            <td>
                                <span class="badge
                                    @switch($pelamar->status)
                                        @case('diterima') bg-success @break
                                        @case('diproses') bg-warning @break
                                        @case('ditolak') bg-danger @break
                                        @case('menunggu') bg-secondary @break
                                        @default bg-light text-dark
                                    @endswitch
                                ">
                                    {{ ucfirst($pelamar->status) }}
                                </span>
                            </td>

                            {{-- Tahap Aktif & Jadwal --}}
                            <td>
                                @if($pelamar->tahapAktif)
                                    <div>
                                        <strong>{{ ucfirst(str_replace('_', ' ', $pelamar->tahapAktif->tahap)) }}</strong><br>
                                        <small>
                                            {{ \Carbon\Carbon::parse($pelamar->tahapAktif->dijadwalkan_pada)->translatedFormat('l, d F Y') }}
                                        </small>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- Keterangan jika ditolak --}}
                            <td>
                                @if($pelamar->status === 'ditolak')
                                    <span class="text-danger small">
                                        {{ $pelamar->keterangan_penolakan ?? 'Lamaran Anda ditolak.' }}
                                    </span>
                                @elseif($pelamar->status === 'diterima')
                                    <span class="text-success small">
                                        Selamat! Anda telah diterima.
                                    </span>
                                @elseif($pelamar->status === 'diproses')
                                    <span class="text-muted small">
                                        Sedang diproses - mohon tunggu jadwal berikutnya.
                                    </span>
                                @elseif($pelamar->status === 'menunggu')
                                    <span class="text    small">
                                        Menunggu verifikasi berkas dari admin.
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada lowongan yang didaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#dataTableLowongan').DataTable();
    });
</script>
@endpush
