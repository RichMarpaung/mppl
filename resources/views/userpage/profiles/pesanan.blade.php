{{-- filepath: c:\laragon\www\Mppl\resources\views\userpage\profiles\pesanan.blade.php --}}
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
                        <th scope="col">Nama Service</th>
                        <th scope="col">Status Order</th>
                        <th scope="col">Tanggal Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->service->nama ?? '-' }}</td>
                            <td>
                                @php
                                    $status = strtolower($order->status);
                                @endphp
                                <span class="badge
                                    @if($status == 'pending') bg-warning
                                    @elseif($status == 'diproses') bg-primary
                                    @elseif($status == 'selesai') bg-success
                                    @elseif($status == 'canceled') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
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
@endsection
