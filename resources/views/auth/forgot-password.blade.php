@extends('auth.master')
@section('left-content')
<div class="d-flex align-items-center flex-column h-100 justify-content-center">
    <img src="assets/images/auth/forgot-pass-img.png" alt="">
</div>
@endsection
@section('content')
<div>
    <h4 class="mb-12">Forgot Password</h4>
    <p class="mb-32 text-secondary-light text-lg">Enter the email address associated with your account and we will send you a link to reset your password.</p>
</div>
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="icon-field">
        <span class="icon top-50 translate-middle-y">
            <iconify-icon icon="mage:email"></iconify-icon>
        </span>
        <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Enter Email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
        {{ __('Send Password Reset Link') }}
    </button>
    <div class="text-center">
        <a href="{{ route('login.page') }}" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
    </div>

    <div class="mt-120 text-center text-sm">
        <p class="mb-0">Already have an account? <a href="{{ route('login.page') }}" class="text-primary-600 fw-semibold">Sign In</a></p>
    </div>
</form>
@endsection
