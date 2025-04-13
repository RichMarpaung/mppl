<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tanneiwa-Login</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon2.png') }}" sizes="16x16">
  <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
  <body>

<section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        @yield('left-content')
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            @yield('content')

        </div>
    </div>
</section>

 <!-- jQuery library js -->
 <script src="{{asset('assets/js/lib/jquery-3.7.1.min.js')}}"></script>
 <!-- Bootstrap js -->
 <script src="{{asset('assets/js/lib/bootstrap.bundle.min.js')}}"></script>


 <!-- Iconify Font js -->
 <script src="{{asset('assets/js/lib/iconify-icon.min.js')}}"></script>



 <!-- main js -->
 <script src="{{asset('assets/js/app.js')}}"></script>
<script>
      function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    initializePasswordToggle('.toggle-password');
</script>

</body>

</html>
