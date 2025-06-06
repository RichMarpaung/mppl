{{-- filepath: c:\laragon\www\Mppl\resources\views\userpage\profiles\task.blade.php --}}
@extends('layouts.profile-user')
@section('title', 'Task Saya')
@section('profile-content')
<div class="card basic-data-table">
    <div class="card-body">
        <h5 class="mb-3">Daftar Task Berdasarkan Team Anda</h5>
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="dataTableTask" data-page-length='10'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Upload</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $task->nama }}</td>
                            <td>{{ $task->tanggal_selesai ? \Carbon\Carbon::parse($task->tanggal_selesai)->format('d-m-Y H:i') : '-' }}</td>
                            <td>
                                <span class="badge
                                    @if($task->status == 'completed') bg-success
                                    @elseif($task->status == 'in-progres') bg-warning
                                    @elseif($task->status == 'revisi') bg-danger
                                    @elseif($task->status == 'accepted') bg-primary
                                    @elseif($task->status == 'late') bg-secondary
                                    @else bg-light
                                    @endif">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>
                                <!-- Tombol Detail (Modal) -->
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalDetailTask{{ $task->id }}">
                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                </button>
                            </td>
                            <td>
                                @if(in_array($task->status, ['in-progres', 'revisi']))
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalUploadTask{{ $task->id }}">
                                        Upload
                                    </button>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Detail Task -->
                        <div class="modal fade" id="modalDetailTask{{ $task->id }}" tabindex="-1" aria-labelledby="modalDetailTaskLabel{{ $task->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="modalDetailTaskLabel{{ $task->id }}">Detail Task</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <p><strong>Judul:</strong> {{ $task->nama }}</p>
                                        <p><strong>Deskripsi:</strong> {{ $task->deskripsi }}</p>
                                        <p>
                                            <strong>Tanggal Mulai:</strong>
                                            {{ $task->created_at ? \Carbon\Carbon::parse($task->created_at)->format('d-m-Y H:i') : '-' }}
                                        </p>
                                        <p>
                                            <strong>Tanggal Selesai:</strong>
                                            {{ $task->tanggal_selesai ? \Carbon\Carbon::parse($task->tanggal_selesai)->format('d-m-Y H:i') : '-' }}
                                        </p>
                                        <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                                        <p><strong>Catatan:</strong> {{ $task->catatan ?? '-' }}</p>
                                        <p>
                                            <strong>File Penjelasan Tugas:</strong>
                                            @if($task->file_ask)
                                                <a href="{{ asset('storage/'.$task->file_ask) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">Lihat File</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </p>
                                        <p>
                                            <strong>File Task (dari team):</strong>
                                            @if($task->file_task)
                                                <a href="{{ asset('storage/'.$task->file_task) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">Lihat File</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Detail Task -->

                        <!-- Modal Upload File Task -->
                        <div class="modal fade" id="modalUploadTask{{ $task->id }}" tabindex="-1" aria-labelledby="modalUploadTaskLabel{{ $task->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('user.tasks.upload', $task->id) }}" method="POST" enctype="multipart/form-data" id="formUploadTask{{ $task->id }}">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalUploadTaskLabel{{ $task->id }}">Upload File Task</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="file_task{{ $task->id }}" class="form-label">File Task</label>
                                                <input type="file" name="file_task" id="file_task{{ $task->id }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary btn-confirm-upload" data-taskid="{{ $task->id }}">Upload</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Upload File Task -->
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada task untuk team Anda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-confirm-upload').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            var taskId = this.getAttribute('data-taskid');
            var form = document.getElementById('formUploadTask' + taskId);
            Swal.fire({
                title: 'Yakin upload file task?',
                text: "Pastikan file sudah benar sebelum upload.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Upload!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
