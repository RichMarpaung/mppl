@extends('layouts.dash-user')

@section('title', 'Profile')

@section('content')
    <div class="row gy-4">
        <div class="col-lg-4">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                <img src="{{ asset('assets/images/user-grid/user-grid-bg1.png') }}" alt=""
                    class="w-100 object-fit-cover">
                <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <!-- Foto Profil + Tombol Kamera -->
                            <div class="position-relative" style="width: 200px; height: 200px;">
                                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/images/avatardefault.webp') }}"
                                    alt="Foto Profil"
                                    class="border br-white border-width-2-px w-100 h-100 rounded-circle object-fit-cover">
                                <!-- Tombol edit di pojok kanan bawah -->
                                <div class="position-absolute" style="bottom: 0; right: 0;">
                                    <form action="{{ route('user.profile.updatePhoto') }}" method="POST"
                                        enctype="multipart/form-data" id="photoForm">
                                        @csrf
                                        @method('PUT')
                                        <input type="file" id="imageUpload" name="photo" accept=".png, .jpg, .jpeg"
                                            hidden onchange="document.getElementById('photoForm').submit();">
                                        <label for="imageUpload"
                                            class="d-flex align-items-center justify-content-center bg-dark text-white rounded-circle shadow"
                                            style="width: 40px; height: 40px; cursor: pointer;">
                                            <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-0 mt-16">{{ Auth::user()->name }}</h6>
                        <span class="text-secondary-light mb-16">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="mt-24">
                        <h6 class="text-xl mb-16">Personal Info</h6>
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Full Name</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->name }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Email</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->email }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Phone Number</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->phone ?? '-' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">NIK</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->nik ?? '-' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Address</span>
                                <span class="w-70 text-secondary-light fw-medium">:
                                    {{ Auth::user()->address ?? '-' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Role</span>
                                <span class="w-70 text-secondary-light fw-medium">:
                                    {{ Auth::user()->role->name ?? '-' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body p-24">
                    <h5 class="mb-3">Pesanan Diterima</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Layanan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->service->name ?? '-' }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada pesanan diterima.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <h5 class="mb-3">Lowongan yang Diikuti</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Status Lowongan</th>
                            <th>Status Pendaftaran</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelamarans as $pelamar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pelamar->lowongan->nama ?? '-' }}</td>
                                <td>{{ ucfirst($pelamar->lowongan->status ?? '-') }}</td>
                                <td>
                                    {{ ucfirst($pelamar->status ?? '-') }}
                                    {{-- contoh: status pelamaran: diterima, diproses, ditolak --}}
                                </td>
                                <td>
                                    {{ $pelamar->lowongan->deadline ? \Carbon\Carbon::parse($pelamar->lowongan->deadline)->format('d-m-Y') : '-' }}
                                </td>
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

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif
@endsection
