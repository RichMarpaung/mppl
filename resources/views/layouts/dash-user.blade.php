<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <style>
        .sidebar-minimized .sidebar-text {
            display: none;
            /* Sembunyikan tulisan Tanniewa */
        }

        .sidebar-minimized .sidebar-logo img {
            width: 40px;
            /* Sesuaikan ukuran logo saat sidebar diminimalkan */
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo3.png') }}" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/file-upload.css') }}">
    <title>Tanniewa Putra - @yield('title')</title>
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navmenu ul li {
            opacity: 0;
            transform: translateY(-10px);
            animation: slideDown 1.5s forwards;
        }

        .navmenu ul li.show {
            opacity: 1;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <button type="button" class="sidebar-close-btn">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div>
            <a href="#" class="sidebar-logo">
                <img src="{{ asset('assets/images/logo3.png') }}" alt="site logo" class="light-logo">
                <img src="{{ asset('assets/images/logo3.png') }}" alt="site logo" class="dark-logo">
                <img src="{{ asset('assets/images/logo3.png') }}" alt="site logo" class="logo-icon">
                <h6 class="text-danger-main mb-0 sidebar-text">Tanniewa</h6>
            </a>
        </div>
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                <li>
                    <a href="/" class="active">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li class="sidebar-menu-group-title">Menu</li>
                <li>
                    <a href="#">
                        <iconify-icon icon="material-symbols:assignment-add-rounded" class="menu-icon"></iconify-icon>
                        <span>Lowongan</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <iconify-icon icon="material-symbols:shoppingmode" class="menu-icon"></iconify-icon>
                        <span>Layanan</span>
                    </a>
                </li>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </ul>
        </div>
    </aside>

    <main class="dashboard-main">
        <div class="navbar-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <button type="button" class="sidebar-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                            <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                        </button>
                        <button type="button" class="sidebar-mobile-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                        </button>

                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" data-theme-toggle
                            class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
                        <div class="dropdown">
                            {{-- <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
            <img src="assets/images/user.png" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
          </button> --}}
                            <button class="d-flex justify-content-center align-items-center rounded-circle"
                                type="button" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/images/avatardefault.webp') }}"
                                    alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
                            </button>
                            <div class="dropdown-menu to-top dropdown-menu-sm">
                                <div
                                    class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                    <div>
                                        <h6 class="text-lg text-primary-light fw-semibold mb-2">
                                            {{ Auth::user()->name }}</h6>
                                        <span
                                            class="text-secondary-light fw-medium text-sm">{{ Auth::user()->role->name }}</span>
                                    </div>
                                    <button type="button" class="hover-text-danger">
                                        <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                                    </button>
                                </div>
                                <ul class="to-top-list">
                                    <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                            href="{{ route('user.profile') }}">
                                            <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon>
                                            My Profile</a>
                                    </li>
                                    {{-- <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                            href="email.html">
                                            <iconify-icon icon="tabler:message-check"
                                                class="icon text-xl"></iconify-icon> Inbox</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                            href="company.html">
                                            <iconify-icon icon="icon-park-outline:setting-two"
                                                class="icon text-xl"></iconify-icon> Setting</a>
                                    </li> --}}
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3">
                                                <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon>
                                                Log Out</button>

                                        </form>


                                    </li>
                                </ul>
                            </div>
                        </div><!-- Profile dropdown end -->
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">@yield('judul')</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">@yield('judul')</li>
                </ul>
            </div>
            @yield('content')
        </div>


        <footer class="d-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© 2025 Tanniewa Putra. All Rights Reserved.</p>
                </div>
                <div class="col-auto">
                    <p class="mb-0">Made by <span class="text-primary-600">KELOMPOK 1</span></p>
                </div>
            </div>
        </footer>
    </main>

    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>


    <!-- Data Table js -->
    <script src="{{ asset('assets/js/lib/dataTables.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>

    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>

    <!-- file upload js -->
    <script src="{{ asset('assets/js/lib/file-upload.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        let table = new DataTable('#dataTable');
    </script>
    @stack('scripts')

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const toggleButton = document.querySelector('.sidebar-toggle');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-minimized');
        });
    });
</script>

</html>
