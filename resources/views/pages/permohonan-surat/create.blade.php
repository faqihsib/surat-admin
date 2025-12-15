@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Permohonan Surat</h3>
                    <p class="text-subtitle text-muted">Form tambah permohonan surat</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('permohonan-surat.index') }}">Permohonan Surat</a>
                            </li>
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
                    <h4 class="card-title">Form Tambah Permohonan Surat</h4>
                </div>
                <div class="card-body">
                    {{-- PENTING: enctype="multipart/form-data" WAJIB ADA untuk upload file --}}
                    <form method="POST" action="{{ route('permohonan-surat.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_permohonan">Nomor Permohonan</label>
                                    <input type="text" class="form-control" id="nomor_permohonan" name="nomor_permohonan"
                                        value="{{ old('nomor_permohonan') }}" required
                                        placeholder="Masukkan nomor permohonan">
                                    @error('nomor_permohonan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pemohon_warga_id">Pemohon (Warga)</label>
                                    <select class="form-control" id="pemohon_warga_id" name="pemohon_warga_id" required>
                                        <option value="">-- Pilih Pemohon --</option>
                                        @foreach ($dataWarga as $warga)
                                            <option value="{{ $warga->warga_id }}"
                                                {{ old('pemohon_warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                                {{ $warga->nama }} (KTP: {{ $warga->no_ktp }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pemohon_warga_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_id">Jenis Surat</label>
                                    <select class="form-control" id="jenis_id" name="jenis_id" required>
                                        <option value="">-- Pilih Jenis Surat --</option>
                                        @foreach ($dataJenisSurat as $jenis)
                                            <option value="{{ $jenis->jenis_id }}"
                                                {{ old('jenis_id') == $jenis->jenis_id ? 'selected' : '' }}>
                                                {{ $jenis->nama_jenis }} (Kode: {{ $jenis->kode }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                    <input type="date" class="form-control" id="tanggal_pengajuan"
                                        name="tanggal_pengajuan" value="{{ old('tanggal_pengajuan') }}" required>
                                    @error('tanggal_pengajuan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Diajukan" {{ old('status') == 'Diajukan' ? 'selected' : '' }}>
                                            Diajukan</option>
                                        <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>
                                            Diproses</option>
                                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="catatan">Catatan (Opsional)</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Masukkan catatan jika ada">{{ old('catatan') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- FITUR BARU: MULTIPLE UPLOAD FILES --}}
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="files"><strong>Upload Lampiran Pemohon</strong></label>
                                <div class="custom-file mt-2">
                                    {{-- name="files[]" dan attribute "multiple" wajib ada --}}
                                    <input type="file" class="form-control" name="files[]" id="files" multiple>
                                </div>
                                <small class="text-muted d-block mt-1">
                                    * Format yang diizinkan: JPG, JPEG, PNG, PDF, DOC, DOCX. Maks 2MB per file.
                                </small>

                                {{-- Error handling khusus untuk file --}}
                                @error('files')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                @error('files.*')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- AKHIR FITUR UPLOAD --}}

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i data-feather="save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('permohonan-surat.index') }}" class="btn btn-secondary">
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
