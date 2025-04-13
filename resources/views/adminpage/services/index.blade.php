@extends('layouts.master-admin')

@section('judul', 'Manage Services')

@section('content')
<div class="card basic-data-table">
    <div class="card-header">
      <h5 class="card-title mb-0">Service Tabel</h5>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Buat Service</a>
      <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Harga</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->nama }}</td>
                <td>{{ $service->harga }}</td>
                <td>
                  <!-- Eye Icon (Deskripsi) -->
                  <a href="javascript:void(0)"
                     class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center btn-show-desc"
                     data-deskripsi="{{ $service->deskripsi }}">
                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                  </a>

                  <!-- Edit Icon -->
                  <a href="{{ route('admin.services.edit', $service->id) }}"
                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                   <iconify-icon icon="lucide:edit"></iconify-icon>
                 </a>

                  <!-- Delete Form -->
                  <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline-block;">
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

<!-- Modal Deskripsi -->
<div class="modal fade" id="descModal" tabindex="-1" aria-labelledby="descModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="descModalLabel">Deskripsi Layanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="modalDeskripsi">
        <!-- Deskripsi akan muncul di sini -->
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
    $('.btn-show-desc').on('click', function() {
      var deskripsi = $(this).data('deskripsi');
      $('#modalDeskripsi').text(deskripsi);
      $('#descModal').modal('show');
    });
  });
</script>
@endpush
