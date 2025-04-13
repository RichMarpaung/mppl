@extends('layouts.master-admin')
@section('judul','Manage Documents')
@section('content')
<div class="card basic-data-table">
    <div class="card-header">
      <h5 class="card-title mb-0">Default Datatables</h5>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.documents.create') }}" class="btn btn-primary mb-3">Create New Document</a>

      <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
        <thead>
          <tr>

            <th scope="col">ID</th>
            <th scope="col">Upload Oleh:</th>
            <th scope="col">File</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)


          <tr>

            <td>{{ $document->id }}</td>
                    <td>{{ $document->user->name }}</td>
                    <td><a href="{{ Storage::url($document->path) }}" target="_blank">{{ basename($document->nama) }}</a></td>


            <td>
              <a href="{{ Storage::url($document->path) }}" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
              </a>
              <a href="{{ route('admin.documents.edit', $document->id) }}"  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                <iconify-icon icon="lucide:edit"></iconify-icon>
              </a>
              <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"><iconify-icon icon="mingcute:delete-2-line"></iconify-icon></button>
            </form>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
