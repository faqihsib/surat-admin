@extends('layouts.admin.app')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail User</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            {{-- Tampilkan Alert Sukses jika ada --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                {{-- KOLOM KIRI: FOTO PROFIL --}}
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title mb-4">Foto Profil</h5>

                            <div class="avatar-preview mb-3">
                                @if ($user->foto_profil)
                                    {{-- Jika ada foto, tampilkan --}}
                                    <img src="{{ asset('uploads/profile/' . $user->foto_profil) }}" alt="Foto Profil"
                                        class="img-fluid rounded-circle img-thumbnail"
                                        style="width: 200px; height: 200px; object-fit: cover;">
                                @else
                                    {{-- Jika tidak ada, tampilkan placeholder --}}
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=200"
                                        alt="Avatar" class="img-fluid rounded-circle img-thumbnail">
                                @endif
                            </div>

                            {{-- TOMBOL HAPUS FOTO --}}
                            {{-- Hanya muncul jika user punya foto profil --}}
                            @if ($user->foto_profil)
                                <form action="{{ route('users.delete_foto', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mt-2"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil ini?')">
                                        <i data-feather="trash-2"></i> Hapus Foto
                                    </button>
                                </form>
                            @else
                                <p class="text-muted small">User ini menggunakan avatar default.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: DETAIL INFORMASI --}}
                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Biodata</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Nama Lengkap</th>
                                    <td>: {{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role / Jabatan</th>
                                    <td>:
                                        @if ($user->role == 'superadmin')
                                            <span class="badge bg-primary">Super Admin</span>
                                        @elseif($user->role == 'staff')
                                            <span class="badge bg-success">Staff</span>
                                        @else
                                            <span class="badge bg-secondary">Guest</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bergabung Sejak</th>
                                    <td>: {{ $user->created_at->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Update</th>
                                    <td>: {{ $user->updated_at->diffForHumans() }}</td>
                                </tr>
                            </table>

                            <hr>

                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">
                                    <i data-feather="arrow-left"></i> Kembali
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                    <i data-feather="edit"></i> Edit Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
