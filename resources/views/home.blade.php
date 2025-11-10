@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center">
    <h1>Selamat Datang {{ $name }}</h1>
    <p>Sistem Pemilihan Ketua Himpunan Mahasiswa Informatika</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
</div>
@endsection
