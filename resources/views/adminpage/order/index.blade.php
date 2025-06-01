@extends('layouts.master-admin')

@section('judul', 'Manage Orders')

@section('content')
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Order Table</h5>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Pengguna</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Layanan</th>
                    <th scope="col">Tanggal Pemesanan</th>
                    <th scope="col">SRS</th> <!-- Kolom SRS -->
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->user->phone ?? '-' }}</td>
                    <td>{{ $order->service->nama }}</td>
                    <td>{{ $order->tanggal_pemesanan }}</td>
                    <td>
                        @if($order->srs)
                            <a href="{{ asset('storage/' . $order->srs) }}" target="_blank" class="btn btn-sm btn-info">
                                Lihat SRS
                            </a>
                        @else
                            <span class="text-muted">Tidak Ada</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'selesai' ? 'success' : ($order->status == 'diproses' ? 'info' : 'secondary')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <!-- Tombol Ubah Status -->
                        <a href="javascript:void(0)"
                           class="w-32-px h-32-px bg-warning-light text-warning-600 rounded-circle d-inline-flex align-items-center justify-content-center btn-change-status"
                           data-id="{{ $order->id }}"
                           data-status="{{ $order->status }}">
                            <iconify-icon icon="mdi:swap-horizontal-bold"></iconify-icon>
                        </a>

                        <!-- Delete Form -->
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-delete">
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

<!-- Modal Ubah Status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Ubah Status Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="statusForm">
                @csrf
                @method('PUT') <!-- Gunakan PUT untuk pembaruan -->
                <input type="hidden" name="order_id" id="order_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Pilih Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="canceled">Dibatalkan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Tampilkan modal ubah status
        $('.btn-change-status').on('click', function() {
            var orderId = $(this).data('id');
            var currentStatus = $(this).data('status');

            // Isi data ke dalam modal
            $('#order_id').val(orderId);
            $('#status').val(currentStatus);

            // Atur action form ke route admin.orders.update
            $('#statusForm').attr('action', `{{ url('admin/orders') }}/${orderId}`);

            // Tampilkan modal
            $('#statusModal').modal('show');
        });

        // Konfirmasi sebelum delete
        $('.btn-delete').on('click', function(e) {
            e.preventDefault(); // Mencegah form submit langsung
            var form = $(this).closest('form'); // Ambil form terdekat
            if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
                form.submit(); // Submit form jika user mengonfirmasi
            }
        });
    });
</script>
@endpush
