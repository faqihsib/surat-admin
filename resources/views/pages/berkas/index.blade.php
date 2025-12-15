@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Berkas Persyaratan</h3>
                    <p class="text-subtitle text-muted">Kelola berkas persyaratan permohonan surat</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berkas Persyaratan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- end header --}}

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- start main content --}}
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('berkas.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i> Tambah Berkas
                    </a>
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Permohonan</th>
                                <th>Nama Berkas</th>
                                <th>File</th>
                                <th>Status Validasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->permohonan->nomor_permohonan ?? '-' }}</td>
                                    <td>{{ $item->nama_berkas }}</td>
                                    <td>
                                        @if ($item->media)
                                            <a href="{{ asset('uploads/' . $item->media->file_url) }}" target="_blank"
                                                class="badge bg-info">
                                                <i data-feather="eye"></i> Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->valid)
                                            <span class="badge bg-success">
                                                <i data-feather="check-circle"></i> Valid
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i data-feather="x-circle"></i> Invalid
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex" style="gap: 8px;">
                                            <a href="{{ route('berkas.edit', $item->berkas_id) }}"
                                                class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 32px; padding: 0;">
                                                <i data-feather="edit" style="width: 16px; height: 16px;"></i>
                                                <span class="ms-1" style="font-size: 12px;">Edit</span>
                                            </a>
                                            <form action="{{ route('berkas.destroy', $item->berkas_id) }}" method="POST"
                                                class="d-inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 32px; padding: 0;"
                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i data-feather="trash" style="width: 16px; height: 16px;"></i>
                                                    <span class="ms-1" style="font-size: 12px;">Hapus</span>
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
        {{-- end main content --}}
    </div>
    {{-- end main content --}}
@endsection
