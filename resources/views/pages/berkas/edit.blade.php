@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Berkas Persyaratan</h3>
                    <p class="text-subtitle text-muted">Form edit berkas persyaratan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('berkas.index') }}">Berkas Persyaratan</a></li>
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
                    <h4 class="card-title">Form Edit Berkas Persyaratan</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('berkas.update', $berkas->berkas_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_berkas">Nama Berkas</label>
                                    <input type="text" class="form-control" id="nama_berkas" name="nama_berkas"
                                        value="{{ old('nama_berkas', $berkas->nama_berkas) }}" required
                                        placeholder="Contoh: KTP, KK, Surat Pengantar">
                                    @error('nama_berkas')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valid">Status Validasi</label>
                                    <select class="form-control" id="valid" name="valid" required>
                                        <option value="0" {{ old('valid', $berkas->valid) == 0 ? 'selected' : '' }}>
                                            Tidak Valid
                                        </option>
                                        <option value="1" {{ old('valid', $berkas->valid) == 1 ? 'selected' : '' }}>
                                            Valid
                                        </option>
                                    </select>
                                    @error('valid')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Tambahan (Read-only) --}}
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Permohonan</label>
                                    <input type="text" class="form-control" value="{{ $berkas->permohonan->nomor_permohonan ?? '-' }}" readonly>
                                    <small class="text-muted">Nomor permohonan terkait</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File Saat Ini</label>
                                    @if($berkas->media)
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $berkas->media->file_url }}" readonly>
                                            <a href="{{ asset('uploads/' . $berkas->media->file_url) }}" target="_blank" class="btn btn-outline-info">
                                                <i data-feather="eye"></i> Lihat
                                            </a>
                                        </div>
                                        <small class="text-muted">File tidak dapat diubah melalui form ini</small>
                                    @else
                                        <input type="text" class="form-control" value="Tidak ada file" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i data-feather="check"></i> Update
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
