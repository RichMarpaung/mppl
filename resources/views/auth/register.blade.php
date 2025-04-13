@extends('auth.master')
@section('left-content')
<div class="d-flex align-items-center flex-column h-100 justify-content-center">
    <img src="assets/images/auth/auth-img.png" alt="">
</div>
@endsection
@section('content')
<div>
    <a href="index.html" class="mb-40 d-flex align-items-center ">
        <img src="assets/images/logo3.png" alt="">
        <h5>TANNEIWA PUTRA</h5>
    </a>
    <h4 class="mb-12">Sign Up to your Account</h4>
    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
</div>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="icon-field mb-16">
        <span class="icon top-50 translate-middle-y">
            <iconify-icon icon="f7:person"></iconify-icon>
        </span>
        <input type="text" name="name" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Nama">
    </div>
    <div class="icon-field mb-16">
        <span class="icon top-50 translate-middle-y">
            <iconify-icon icon="solar:document-text-outline"></iconify-icon>
        </span>
        <input type="text" name="nik" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Nomor Induk Kependudukan (NIK)">
    </div>
    <div class="icon-field mb-16">
        <span class="icon top-50 translate-middle-y">
            <iconify-icon icon="mage:email"></iconify-icon>
        </span>
        <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email">
    </div>

    <div class="mb-20">
        <div class="position-relative ">
            <div class="icon-field">
                <span class="icon top-50 translate-middle-y">
                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                </span>
                <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Password">
            </div>
            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
        </div>
    </div>

    <div class="mb-20">
        <div class="position-relative ">
            <div class="icon-field">
                <span class="icon top-50 translate-middle-y">
                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                </span>
                <input type="password" name="password_confirmation" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Confirm Password">
            </div>
            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
        </div>
        <span class="mt-12 text-sm text-secondary-light">Your password must have at least 8 characters</span>
    </div>



    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign Up</button>


    <div class="mt-32 text-center text-sm">
        <p class="mb-0">Already have an account? <a href="{{ route('login.page') }}" class="text-primary-600 fw-semibold">Sign In</a></p>
    </div>

</form>
@endsection
