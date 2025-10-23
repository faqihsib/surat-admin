@extends('layouts.admin.auth')

@section('content')
<form method="POST" action="{{ route('auth.login.post') }}">
    @csrf

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
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
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
                   placeholder="Masukkan password Anda" required>
        </div>
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">
            <i data-feather="log-in" width="16"></i>
            Login
        </button>
    </div>

    <div class="text-center">
        <p class="text-muted">Belum punya akun?
            <a href="{{ route('auth.register') }}" class="text-primary">Daftar di sini</a>
        </p>
    </div>
</form>
@endsection
