@extends('layouts.master-admin')

@section('judul', 'Daftar User')

@section('content')
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Daftar User</h5>
    </div>
    <div class="card-body">
        <!-- Tombol Buat User -->
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
            Buat User Baru
        </a>

        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '-' }}</td>
                    <td>
                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <!-- Eye Icon (Detail) -->
                            <a href="javascript:void(0)"
                               class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center btn-show-desc"
                               data-name="{{ $user->name }}"
                               data-email="{{ $user->email }}"
                               data-phone="{{ $user->phone ?? '-' }}"
                               data-address="{{ $user->address ?? '-' }}"
                               data-role="{{ $user->role->name }}">
                                <iconify-icon icon="mdi:eye-outline" class="text-primary"></iconify-icon>
                            </a>

                            <!-- Edit Icon -->
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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

<!-- Modal Detail User -->
<div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailModalLabel">Detail User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="modalUserName"></span></p>
                <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>
                <p><strong>Nomor HP:</strong> <span id="modalUserPhone"></span></p>
                <p><strong>Alamat:</strong> <span id="modalUserAddress"></span></p>
                <p><strong>Role:</strong> <span id="modalUserRole"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    $('#dataTable').DataTable(); // Inisialisasi DataTables

    // Event delegation untuk tombol detail (Eye Icon)
    $(document).on('click', '.btn-show-desc', function() {
        const name = $(this).data('name');
        const email = $(this).data('email');
        const phone = $(this).data('phone');
        const address = $(this).data('address');
        const role = $(this).data('role');

        // Isi data ke modal
        $('#modalUserName').text(name);
        $('#modalUserEmail').text(email);
        $('#modalUserPhone').text(phone);
        $('#modalUserAddress').text(address);
        $('#modalUserRole').text(role);

        // Tampilkan modal
        $('#userDetailModal').modal('show');
    });
});
</script>
@endpush
