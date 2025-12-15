@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Riwayat Status</h3>
                    <p class="text-subtitle text-muted">Form tambah riwayat perubahan status permohonan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('riwayat.index') }}">Riwayat Status</a></li>
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
                    <h4 class="card-title">Form Tambah Riwayat Status</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('riwayat.store') }}">
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
                                    <label for="status">Status Baru</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Diajukan" {{ old('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                        <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="petugas_warga_id">Petugas Penanggung Jawab</label>
                                    <select class="form-control" id="petugas_warga_id" name="petugas_warga_id" required>
                                        <option value="">Pilih Petugas</option>
                                        @foreach ($warga as $w)
                                            <option value="{{ $w->warga_id }}" {{ old('petugas_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} ({{ $w->nik ?? 'NIK tidak tersedia' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Pilih warga yang bertugas menangani permohonan</small>
                                    @error('petugas_warga_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan / Catatan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                                        placeholder="Contoh: Menunggu verifikasi dokumen, Data sudah lengkap, dll">{{ old('keterangan') }}</textarea>
                                    <small class="text-muted">Opsional, beri catatan jika diperlukan</small>
                                    @error('keterangan')
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
                                        <li>Riwayat status akan tercatat secara permanen dalam sistem</li>
                                        <li>Pastikan memilih status yang sesuai dengan kondisi terkini</li>
                                        <li>Petugas yang dipilih harus sesuai dengan penanggung jawab</li>
                                        <li>Status "Selesai" dan "Ditolak" adalah status akhir permohonan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i data-feather="save"></i> Simpan
                            </button>
                            <a href="{{ route('riwayat.index') }}" class="btn btn-secondary">
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
