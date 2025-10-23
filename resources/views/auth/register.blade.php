@extends('layouts.admin.auth')

@section('title', 'Register - Layanan Desa')
@section('page-title', 'Daftar Akun Baru')
@section('page-subtitle', 'Buat akun untuk mengakses sistem')

@section('content')
<form method="POST" action="{{ route('auth.register.post') }}">
    @csrf

    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i data-feather="user"></i>
                </span>
            </div>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name') }}"
                   placeholder="Masukkan nama lengkap" required>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i data-feather="mail"></i>
                </span>
            </div>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email') }}"
                   placeholder="Masukkan email Anda" required>
        </div>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i data-feather="lock"></i>
                </span>
            </div>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Masukkan password" required>
        </div>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i data-feather="lock"></i>
                </span>
            </div>
            <input type="password" class="form-control" id="password_confirmation"
                   name="password_confirmation"
                   placeholder="Ulangi password" required>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">
            <i data-feather="user-plus" width="16"></i>
            Daftar
        </button>
    </div>

    <div class="text-center">
        <p class="text-muted">Sudah punya akun?
            <a href="{{ route('auth.index') }}" class="text-primary">Login di sini</a>
        </p>
    </div>
</form>
@endsection
