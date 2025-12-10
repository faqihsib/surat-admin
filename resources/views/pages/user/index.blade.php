@extends('layouts.admin.app')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data User</h3>
                    <p class="text-subtitle text-muted">Kelola data user sistem</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i> Tambah User
                    </a>
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th> {{-- KOLOM BARU --}}
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUser as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{-- LOGIKA TAMPILKAN FOTO --}}
                                        @if ($item->foto_profil)
                                            <img src="{{ asset('uploads/profile/' . $item->foto_profil) }}" alt="Foto"
                                                class="rounded-circle" width="50" height="50"
                                                style="object-fit: cover;">
                                        @else
                                            {{-- Placeholder jika tidak ada foto --}}
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&background=random"
                                                alt="Avatar" class="rounded-circle" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if ($item->role == 'superadmin')
                                            <span class="badge bg-primary">Super Admin</span>
                                        @elseif($item->role == 'staff')
                                            <span class="badge bg-success">Staff</span>
                                        @else
                                            <span class="badge bg-secondary">Guest</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            {{-- TOMBOL LIHAT DETAIL --}}
                                            <a href="{{ route('users.show', $item->id) }}"
                                                class="btn btn-info btn-sm me-2 text-white">
                                                <i data-feather="eye"></i> Detail
                                            </a>

                                            <a href="{{ route('users.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm me-2">
                                                <i data-feather="edit"></i> Edit
                                            </a>

                                            <form action="{{ route('users.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus user ini?')">
                                                    <i data-feather="trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
