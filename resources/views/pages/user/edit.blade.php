@extends('layouts.admin.app')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit User</h3>
                    <p class="text-subtitle text-muted">Form edit user</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit User</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $dataUser->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $dataUser->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $dataUser->email) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Kosongkan jika tidak ingin mengubah">
                                    <small class="text-muted">Kosongkan password jika tidak ingin mengubah</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Kosongkan jika tidak ingin mengubah">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role (Hak Akses)</label>
                                    <select class="form-control @error('role') is-invalid @enderror" id="role"
                                        name="role" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="superadmin" {{ old('role', $dataUser->role) == 'superadmin' ? 'selected' : '' }}>
                                            Super Admin</option>
                                        <option value="staff" {{ old('role', $dataUser->role) == 'staff' ? 'selected' : '' }}>
                                            Staff</option>
                                        <option value="guest" {{ old('role', $dataUser->role) == 'guest' ? 'selected' : '' }}>
                                            Guest</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
