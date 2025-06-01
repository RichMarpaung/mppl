@extends('layouts.master-admin')

@section('judul', 'Daftar Team')

@section('content')
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Daftar Team</h5>
    </div>
    <div class="card-body">
        <!-- Tombol Buat Team -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createTeamModal">
            Buat Team
        </button>

        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Bergabung</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $index => $team)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                    <td>{{ $team->user->name }}</td>
                    <td>{{ $team->user->email }}</td>
                    <td>{{ $team->posisi }}</td>
                    <td>
                        @if($team->status === 'Tetap')
                            <span class="badge bg-success">Tetap</span>
                        @else
                            <span class="badge bg-warning">Freelance</span>
                        @endif
                    </td>
                    <td>{{ $team->created_at->format('d-m-Y') }}</td>
                    <td>
                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <!-- Eye Icon (Detail) -->
                            <a href="javascript:void(0)"
                               class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center btn-show-desc"
                               data-image="{{ $team->image ? asset('storage/' . $team->image) : '' }}"
                               data-ktp="{{ $team->ktp ? asset('storage/' . $team->ktp) : '' }}"
                               data-npwp="{{ $team->npwp ? asset('storage/' . $team->npwp) : '' }}"
                               data-ijazah="{{ $team->ijazah ? asset('storage/' . $team->ijazah) : '' }}"
                               data-cv="{{ $team->cv ? asset('storage/' . $team->cv) : '' }}"
                               data-bs-toggle="modal" data-bs-target="#viewDocumentsModal">
                                <iconify-icon icon="mdi:eye-outline" class="text-primary"></iconify-icon>
                            </a>

                            <!-- Edit Icon -->
                            <a href="{{ route('admin.teams.edit', $team->id) }}"
                               class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pilihan Buat Team -->
<div class="modal fade" id="createTeamModal" tabindex="-1" aria-labelledby="createTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTeamModalLabel">Pilih Opsi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anggota tim sudah terdaftar sebagai pengguna?</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('admin.teams.create', ['has_account' => 'yes']) }}" class="btn btn-primary">Sudah Terdaftar</a>
                <a href="{{ route('admin.teams.create', ['has_account' => 'no']) }}" class="btn btn-secondary">Belum Terdaftar</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Dokumen -->
<div class="modal fade" id="viewDocumentsModal" tabindex="-1" aria-labelledby="viewDocumentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDocumentsModalLabel">Dokumen Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Foto Anggota -->
                <div class="text-center mb-3">
                    <a id="teamImageLink" href="#" target="_blank">
                        <img id="teamImage" src="#" alt="Foto Anggota" class="img-thumbnail" style="width: 50%; height: auto; display: none;">
                    </a>
                </div>
                <!-- Dokumen -->
                <div class="row">
                    <div class="col-md-3 text-center">
                        <a id="ktpImageLink" href="#" target="_blank">
                            <img id="ktpImage" src="#" alt="KTP" class="img-thumbnail" style="width: 50%; height: auto; display: none;">
                        </a>
                        <p><strong>KTP</strong></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <a id="npwpImageLink" href="#" target="_blank">
                            <img id="npwpImage" src="#" alt="NPWP" class="img-thumbnail" style="width: 50%; height: auto; display: none;">
                        </a>
                        <p><strong>NPWP</strong></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <a id="ijazahImageLink" href="#" target="_blank">
                            <img id="ijazahImage" src="#" alt="Ijazah" class="img-thumbnail" style="width: 50%; height: auto; display: none;">
                        </a>
                        <p><strong>Ijazah</strong></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <a id="cvImageLink" href="#" target="_blank">
                            <img id="cvImage" src="#" alt="CV" class="img-thumbnail" style="width: 50%; height: auto; display: none;">
                        </a>
                        <p><strong>CV</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // Inisialisasi DataTables

        // Event untuk tombol lihat dokumen
        $('#viewDocumentsModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var image = button.data('image');
            var ktp = button.data('ktp');
            var npwp = button.data('npwp');
            var ijazah = button.data('ijazah');
            var cv = button.data('cv');

            // Set foto anggota
            if (image) {
                $('#teamImage').attr('src', image).show();
                $('#teamImageLink').attr('href', image).show();
            } else {
                $('#teamImage').hide();
                $('#teamImageLink').hide();
            }

            // Set gambar dokumen
            if (ktp) {
                $('#ktpImage').attr('src', ktp).show();
                $('#ktpImageLink').attr('href', ktp).show();
            } else {
                $('#ktpImage').hide();
                $('#ktpImageLink').hide();
            }

            if (npwp) {
                $('#npwpImage').attr('src', npwp).show();
                $('#npwpImageLink').attr('href', npwp).show();
            } else {
                $('#npwpImage').hide();
                $('#npwpImageLink').hide();
            }

            if (ijazah) {
                $('#ijazahImage').attr('src', ijazah).show();
                $('#ijazahImageLink').attr('href', ijazah).show();
            } else {
                $('#ijazahImage').hide();
                $('#ijazahImageLink').hide();
            }

            if (cv) {
                $('#cvImage').attr('src', cv).show();
                $('#cvImageLink').attr('href', cv).show();
            } else {
                $('#cvImage').hide();
                $('#cvImageLink').hide();
            }
        });
    });
</script>
@endpush
