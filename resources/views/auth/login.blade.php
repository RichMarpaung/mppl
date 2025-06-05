@extends('auth.master')
@section('left-content')
<div class="d-flex align-items-center flex-column h-100 justify-content-center">
    <img src="assets/images/auth/auth-img.png" alt="">
</div>
@endsection
@section('content')
<div>
    <a href="/" class="mb-40 d-flex align-items-center  ">
        <img src="assets/images/logo3.png" alt="">
        <h5>TANNEIWA PUTRA</h5>
    </a>
    <h4 class="mb-12">Sign In to your Account</h4>
    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="icon-field mb-16">
        <span class="icon top-50 translate-middle-y">
            <iconify-icon icon="mage:email"></iconify-icon>
        </span>
        <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" value="{{ old('email') }}" name="email" placeholder="Email">
    </div>
    <div class="position-relative mb-20">
        <div class="icon-field">
            <span class="icon top-50 translate-middle-y">
                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
            </span>
            <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Password">
        </div>
        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
    </div>
    <div class="">
        <div class="d-flex justify-content-between gap-2">

            <a href="{{ route('password.request') }}" class="text-primary-600 fw-medium">Forgot Password?</a>
        </div>
    </div>

    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button>

    <div class="mt-32 text-center text-sm">
        <p class="mb-0">Don’t have an account? <a href="{{ route('register.page') }}" class="text-primary-600 fw-semibold">Sign Up</a></p>
    </div>

</form>
@endsection
