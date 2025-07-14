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
                    <th>Nomor</th>
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
                @foreach($pelamars as $index => $pelamar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pelamar->user->name }}</td>
                    <td>{{ $pelamar->user->nik }}</td>
                    <td>{{ $pelamar->user->email }}</td>
                    <td>{{ $pelamar->lowongan->nama }}</td>
                    <td>
                        @if($pelamar->cv)
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#cvModal{{ $pelamar->id }}">
                                Lihat CV
                            </button>
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
                        <span class="badge bg-{{
                            $pelamar->status === 'diterima' ? 'success' :
                            ($pelamar->status === 'ditolak' ? 'danger' : 'warning')
                        }}">
                            {{ ucfirst($pelamar->status) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $flow = [
                                'screening_berkas' => 'psikotes',
                                'psikotes' => 'wawancara_hr',
                                'wawancara_hr' => 'offering',
                                'offering' => 'DITERIMA',
                            ];
                            $tahapSekarang = $pelamar->status;
                            $tahapSelanjutnya = $flow[$tahapSekarang] ?? null;
                            $isTahapAkhir = $tahapSelanjutnya === 'DITERIMA';
                            $tahapLamaran = $pelamar->tahapLamarans()->where('tahap', $tahapSekarang)->latest()->first();
                        @endphp

                        @if($pelamar->status === 'menunggu')
                            {{-- ACC Berkas --}}
                            <form action="{{ route('admin.pelamar.approve-berkas', $pelamar->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">ACC Berkas</button>
                            </form>

                            {{-- Tolak Berkas --}}
                            <form action="{{ route('admin.pelamar.tahap.gagal', [$pelamar->id, 'berkas']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Tolak Berkas</button>
                            </form>

                        @elseif($pelamar->status !== 'diterima' && $pelamar->status !== 'ditolak' && $tahapLamaran)
                            {{-- Lulus / Terima --}}
                            <form action="{{ route('admin.pelamar.tahap.lulus', [$pelamar->id, $tahapLamaran->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    {{ $isTahapAkhir ? 'Terima' : 'Lulus' }}
                                </button>
                            </form>

                            {{-- Tolak --}}
                            <form action="{{ route('admin.pelamar.tahap.gagal', [$pelamar->id, $tahapLamaran->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                            </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
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
        $('#dataTable').DataTable();
    });
</script>
@endpush
