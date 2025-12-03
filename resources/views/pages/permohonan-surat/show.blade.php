@extends('layouts.admin.app')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Permohonan Surat</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('permohonan-surat.index') }}">Permohonan Surat</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Informasi Permohonan</h4>
                    <a href="{{ route('permohonan-surat.index') }}" class="btn btn-secondary btn-sm">
                        <i data-feather="arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    {{-- Tampilkan Pesan Sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Informasi Utama --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 35%;">Nomor Surat</th>
                                    <td>: {{ $permohonan->nomor_permohonan }}</td>
                                </tr>
                                <tr>
                                    <th>Pemohon</th>
                                    <td>: {{ $permohonan->pemohon->nama ?? '-' }} <br>
                                        <small class="text-muted ml-3">(KTP: {{ $permohonan->pemohon->no_ktp ?? '-' }})</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jenis Surat</th>
                                    <td>: {{ $permohonan->jenisSurat->nama_jenis ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 35%;">Tanggal Pengajuan</th>
                                    <td>: {{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:
                                        @if ($permohonan->status == 'Diajukan')
                                            <span class="badge bg-warning">Diajukan</span>
                                        @elseif($permohonan->status == 'Diproses')
                                            <span class="badge bg-info">Diproses</span>
                                        @elseif($permohonan->status == 'Selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>: {{ $permohonan->catatan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    {{-- Daftar File Upload --}}
                    <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                        <h5 class="m-0"><i data-feather="folder"></i> Berkas Persyaratan ({{ $files->count() }})</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 5%" class="text-center">#</th>
                                    <th>Nama File</th>
                                    <th style="width: 20%">Tanggal Upload</th>
                                    <th style="width: 20%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($files as $file)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            {{-- Menampilkan nama file --}}
                                            <span class="d-inline-block text-truncate" style="max-width: 300px;">
                                                {{ $file->filename }}
                                            </span>
                                        </td>
                                        <td>{{ $file->created_at->format('d M Y, H:i') }}</td>
                                        <td class="text-center">
                                            {{-- Tombol Lihat/Download --}}
                                            <a href="{{ asset('uploads/permohonan/' . $file->filename) }}" target="_blank" class="btn btn-sm btn-primary me-1" title="Lihat File">
                                                <i data-feather="eye"></i>
                                            </a>

                                            {{-- Tombol Hapus File --}}
                                            <form action="{{ route('uploads.delete', $file->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus File">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <em>Belum ada berkas yang diunggah untuk permohonan ini.</em>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Form Upload Cepat (Susulan) --}}
                    {{-- <div class="mt-4 p-4 bg-light rounded border"> --}}
                        <h6 class="mb-3"><i data-feather="upload-cloud"></i> Upload Berkas Tambahan</h6>
                        <form action="{{ route('permohonan-surat.update', $permohonan->permohonan_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Hidden fields untuk data wajib controller agar tidak error validasi --}}
                            <input type="hidden" name="nomor_permohonan" value="{{ $permohonan->nomor_permohonan }}">
                            <input type="hidden" name="pemohon_warga_id" value="{{ $permohonan->pemohon_warga_id }}">
                            <input type="hidden" name="jenis_id" value="{{ $permohonan->jenis_id }}">
                            <input type="hidden" name="tanggal_pengajuan" value="{{ $permohonan->tanggal_pengajuan }}">
                            <input type="hidden" name="status" value="{{ $permohonan->status }}">

                            <div class="input-group">
                                <input type="file" class="form-control" name="files[]" multiple required>
                                <button class="btn btn-success" type="submit">
                                    <i data-feather="upload"></i> Upload Sekarang
                                </button>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                Format: JPG, PNG, PDF, DOCX. Maksimal 2MB.
                            </small>
                        </form>
                    {{-- </div> --}}

                </div>
            </div>
        </section>
    </div>
@endsection
