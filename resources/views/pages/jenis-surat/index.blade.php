@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Jenis Surat</h3>
                    <p class="text-subtitle text-muted">Kelola jenis surat yang tersedia</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Jenis Surat</li>
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
                    <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i> Tambah Jenis Surat
                    </a>
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Jenis Surat</th>
                                <th>Syarat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataJenisSurat as $item)
                                <tr>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama_jenis }}</td>
                                    <td>{{ $item->syarat_json }}</td>
                                    <td>
                                        @if ($item->status == 'diajukan')
                                            <span class="badge bg-warning">Sedang Diajukan</span>
                                        @elseif($item->status == 'diproess')
                                            <span class="badge bg-info">Sedang Diproses</span>
                                        @else
                                            <span class="badge bg-success">Diterima</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('jenis-surat.edit', $item->jenis_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i data-feather="edit"></i> Edit
                                        </a>
                                        <form action="{{ route('jenis-surat.destroy', $item->jenis_id) }}" method="POST"
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
        {{-- end main content --}}
    </div>
    {{-- end main content --}}
@endsection
