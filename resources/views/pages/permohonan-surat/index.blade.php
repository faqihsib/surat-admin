@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Permohonan Surat</h3>
                    <p class="text-subtitle text-muted">Kelola permohonan surat warga</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permohonan Surat</li>
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
                    <a href="{{ route('permohonan-surat.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i> Tambah Permohonan Surat
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('permohonan-surat.index') }}">
                                <div class="input-group">
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="">Status</option>
                                        <option value="Diajukan" {{ request('status') == 'Diajukan' ? 'selected' : '' }}>
                                            Diajukan</option>
                                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                                            Diproses</option>
                                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                    @if (request('status'))
                                        <a href="{{ route('permohonan-surat.index') }}"
                                            class="btn btn-outline-secondary">Reset</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Permohonan</th>
                                <th>Nama Pemohon</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPermohonan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nomor_permohonan }}</td>
                                    <td>{{ $item->pemohon ? $item->pemohon->nama : 'Warga Dihapus' }}</td>
                                    <td>{{ $item->jenisSurat ? $item->jenisSurat->nama_jenis : 'Jenis Surat Dihapus' }}
                                    </td>
                                    <td>{{ $item->tanggal_pengajuan }}</td>
                                    <td>
                                        @if ($item->status == 'Diajukan')
                                            <span class="badge bg-warning">Diajukan</span>
                                        @elseif($item->status == 'Diproses')
                                            <span class="badge bg-info">Diproses</span>
                                        @elseif($item->status == 'Selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('permohonan-surat.edit', $item->permohonan_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i data-feather="edit"></i> Edit
                                        </a>
                                        <form action="{{ route('permohonan-surat.destroy', $item->permohonan_id) }}"
                                            method="POST" class="d-inline">
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
                    <div class="mt-3">
                        {{ $dataPermohonan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>
        {{-- end main content --}}
    </div>
    {{-- end main content --}}
@endsection
