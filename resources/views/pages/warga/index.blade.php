@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Warga</h3>
                    <p class="text-subtitle text-muted">Kelola data warga desa</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Warga</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Pesan Sukses/Error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
                    <a href="{{ route('warga.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i> Tambah Warga
                    </a>
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No. KTP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>Pekerjaan</th>
                                <th>Agama</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataWarga as $item)
                                <tr>
                                    <td>{{ $item->no_ktp }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->pekerjaan }}</td>
                                    <td>{{ $item->agama }}</td>
                                    <td>{{ $item->telp }}</td>
                                    <td>
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                            class="btn btn-sm btn-warning me-1">
                                            <i data-feather="edit"></i> Edit
                                        </a>
                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                <i data-feather="trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    {{-- end main content --}}
@endsection
