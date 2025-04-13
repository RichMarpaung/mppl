<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<!-- Mirrored from wowdash.wowtheme7.com/demo/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Mar 2025 05:45:29 GMT -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tanneiwa -  Forgot Password</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon2.png') }}" sizes="16x16">
  <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <body>

<section class="auth forgot-password-page bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="assets/images/auth/forgot-pass-img.png" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <h4 class="mb-12">Forgot Password</h4>
                <p class="mb-32 text-secondary-light text-lg">Enter the email address associated with your account and we will send you a link to reset your password.</p>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                <div class="icon-field">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Enter Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32" data-bs-toggle="modal" data-bs-target="#exampleModal">Continue</button>

                <div class="text-center">
                    <a href="sign-in.html" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
                </div>

                <div class="mt-120 text-center text-sm">
                    <p class="mb-0">Already have an account? <a href="sign-in.html" class="text-primary-600 fw-semibold">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
        <div class="modal-body p-40 text-center">
            <div class="mb-32">
                <img src="assets/images/auth/envelop-icon.png" alt="">
            </div>
            <h6 class="mb-12">Verify your Email</h6>
            <p class="text-secondary-light text-sm mb-0">Thank you, check your email for instructions to reset your password</p>
            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Skip</button>
            <div class="mt-32 text-sm">
                <p class="mb-0">Don’t receive an email? <a href="resend.html" class="text-primary-600 fw-semibold">Resend</a></p>
            </div>
        </div>
        </div>
    </div>
</div>

  <!-- jQuery library js -->
  <script src="assets/js/lib/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap js -->
  <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
  <!-- Apex Chart js -->
  <script src="assets/js/lib/apexcharts.min.js"></script>
  <!-- Data Table js -->
  <script src="assets/js/lib/dataTables.min.js"></script>
  <!-- Iconify Font js -->
  <script src="assets/js/lib/iconify-icon.min.js"></script>
  <!-- jQuery UI js -->
  <script src="assets/js/lib/jquery-ui.min.js"></script>
  <!-- Vector Map js -->
  <script src="assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
  <script src="assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
  <!-- Popup js -->
  <script src="assets/js/lib/magnifc-popup.min.js"></script>
  <!-- Slick Slider js -->
  <script src="assets/js/lib/slick.min.js"></script>
  <!-- prism js -->
  <script src="assets/js/lib/prism.js"></script>
  <!-- file upload js -->
  <script src="assets/js/lib/file-upload.js"></script>
  <!-- audioplayer -->
  <script src="assets/js/lib/audioplayer.js"></script>

  <!-- main js -->
  <script src="assets/js/app.js"></script>

</body>

<!-- Mirrored from wowdash.wowtheme7.com/demo/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Mar 2025 05:45:30 GMT -->
</html>
