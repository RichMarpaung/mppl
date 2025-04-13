<!-- filepath: resources/views/userpage/profile.blade.php -->
@extends('layouts.master-user')

@section('content')
    <div class="container mt-5">
        <h1>Profil Saya</h1>
        <p>Nama: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        <p>Tanggal Bergabung: {{ Auth::user()->created_at->format('d M Y') }}</p>
    </div>
@endsection
