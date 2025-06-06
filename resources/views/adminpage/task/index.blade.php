{{-- filepath: c:\laragon\www\Mppl\resources\views\adminpage\task\index.blade.php --}}
@extends('layouts.master-admin')
@section('judul', 'Task')
@section('content')
    <div class="card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Task</h5>
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary float-end">Tambah Task</a>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal Selesai</th>
                        <th>Nama Team</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->nama }}</td>
                            <td>
                                {{ $task->tanggal_selesai ? \Carbon\Carbon::parse($task->tanggal_selesai)->format('d-m-Y H:i') : '-' }}
                            </td>
                            <td>{{ $task->team->user->name ?? '-' }}</td>
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
                                <!-- Button trigger modal detail -->
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#modalDetailTask{{ $task->id }}"
                                    class="btn btn-sm btn-info">
                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                </a>
                                <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                    class="btn btn-sm btn-success">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus task ini?')">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                            <td>
                                @if($task->status == 'completed')
                                    <form action="{{ route('admin.tasks.approve', $task->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-primary" title="Setujui Task">
                                            <iconify-icon icon="mdi:check-bold"></iconify-icon> Accpect
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalRevisiTask{{ $task->id }}">
                                        <iconify-icon icon="mdi:close-thick"></iconify-icon> Tolak
                                    </button>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="modalDetailTask{{ $task->id }}" tabindex="-1"
                            aria-labelledby="modalDetailTaskLabel{{ $task->id }}" aria-hidden="true">
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
                                        <p><strong>Team:</strong> {{ $task->team->user->name ?? '-' }}</p>
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
                        <!-- End Modal Detail -->

                        <!-- Modal Revisi -->
                        <div class="modal fade" id="modalRevisiTask{{ $task->id }}" tabindex="-1"
                            aria-labelledby="modalRevisiTaskLabel{{ $task->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.tasks.revisi', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title" id="modalRevisiTaskLabel{{ $task->id }}">Tolak & Revisi Task</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="catatan{{ $task->id }}" class="form-label">Catatan Revisi</label>
                                                <textarea name="catatan" id="catatan{{ $task->id }}" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <p class="mb-0 ">Catatan ini akan dikirim ke team sebagai alasan revisi.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning">Kirim Revisi</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Revisi -->
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada task.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
