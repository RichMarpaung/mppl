<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tanniewa Putra - @yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/LogoTanniewa.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/vendor/css/main.css') }}" rel="stylesheet">
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

        .bg-primarys {
            background-color: #b60d22,
        }
    </style>
</head>

<body class="index-page">

    <header id="header"
        class="header d-flex align-items-center fixed-top {{ request()->is('news') ? 'header-news-active' : '' }}">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="/" class="logo d-flex align-items-center me-auto logo-tanniewa">
                <img src="{{ asset('assets/img/LogoTanniewa.png') }}" alt="logo-tanniewa">
                <h1 class="sitename">Tanniewa Putra</h1>
            </a>

            <nav id="navmenu"
                class="navmenu {{ request()->is('news') || request()->is('pelamar/create/*') ? 'nav-section-active' : '' }}">
                <ul>
                    <li><a href="{{ route('dashboard.page') }}#hero" class="active">Beranda</a></li>
                    <li class="dropdown"><a href="#"><span>Tentang Kami</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('about.page') }}#about">Tentang Kami</a></li>
                            <li><a href="{{ route('dashboard.page') }}#sejarah">Sejarah</a></li>
                            <li><a href="{{ route('dashboard.page') }}#visi">Visi Misi</a></li>
                            <li><a href="{{ route('dashboard.page') }}#team">Tim</a></li>
                        </ul>
                    </li>
                    {{-- <li><a href="/#portfolio">Portfolio</a></li> --}}
                    <li><a href="{{ route('dashboard.page') }}#portofolio">Portofolio</a></li>
                    <li><a href="{{ route('dashboard.page') }}#lowongan">Karir</a></li>
                    <li><a href="{{ route('dashboard.page') }}#layanan">Layanan</a></li>
                    <li><a href="{{ route('news.user.index') }}"
                            class="{{ request()->is('news') ? 'active' : '' }}">Berita</a></li>

                    {{-- <li class="dropdown"><a href="#"><span>Lainnya</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li><a href="#contact">Contact</a></li> --}}
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted"
                @if (auth()->check()) href="/profile"
   @else
       style="display:none" @endif>
                Profile
            </a>
        </div>
    </header>


    @yield('content')


    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Tanniewa Putra</strong> <span>All Rights
                Reserved</span></p>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">KELOMPOK 1</a>
        </div>
    </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/vendor/js/main.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuItems = document.querySelectorAll('.navmenu ul li');

            menuItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('show'); // Tambahkan kelas show untuk memulai animasi
                }, index * 300); // Delay 300ms untuk setiap item
            });
        });
    </script>



</body>

</html>
