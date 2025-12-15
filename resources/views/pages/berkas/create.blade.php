@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Berkas Persyaratan</h3>
                    <p class="text-subtitle text-muted">Form upload berkas persyaratan baru</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('berkas.index') }}">Berkas Persyaratan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                    <h4 class="card-title">Form Upload Berkas Baru</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('berkas.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permohonan_id">Nomor Permohonan</label>
                                    <select class="form-control" id="permohonan_id" name="permohonan_id" required>
                                        <option value="">Pilih Permohonan</option>
                                        @foreach ($permohonan as $p)
                                            <option value="{{ $p->permohonan_id }}" {{ old('permohonan_id') == $p->permohonan_id ? 'selected' : '' }}>
                                                {{ $p->nomor_permohonan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('permohonan_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_berkas">Nama Berkas</label>
                                    <input type="text" class="form-control" id="nama_berkas" name="nama_berkas"
                                        value="{{ old('nama_berkas') }}" required
                                        placeholder="Contoh: KTP, KK, Surat Pengantar">
                                    @error('nama_berkas')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">File Berkas</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                    <small class="text-muted">Format yang diterima: PDF, JPG, PNG, DOCX (Maks. 2MB)</small>
                                    @error('file')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valid">Status Validasi Awal</label>
                                    <select class="form-control" id="valid" name="valid" required>
                                        <option value="0" {{ old('invalid') == 'invalid' ? 'selected' : '' }}>Tidak Valid</option>
                                        <option value="1" {{ old('valid') == 'valid' ? 'selected' : '' }}>Valid</option>
                                    </select>
                                    <small class="text-muted">Status dapat diubah nanti melalui edit</small>
                                    @error('valid')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Tambahan --}}
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <div class="alert-heading h6">
                                        <i data-feather="info"></i> Informasi Penting
                                    </div>
                                    <ul class="mb-0">
                                        <li>Pastikan file yang diupload jelas dan terbaca</li>
                                        <li>File maksimal 2 MB per berkas</li>
                                        <li>Pastikan berkas sesuai dengan nama yang diisi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i data-feather="save"></i> Simpan
                            </button>
                            <a href="{{ route('berkas.index') }}" class="btn btn-secondary">
                                <i data-feather="arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    {{-- end main content --}}
@endsection
