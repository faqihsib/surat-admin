@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Riwayat Status</h3>
                    <p class="text-subtitle text-muted">Form edit riwayat perubahan status</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('riwayat.index') }}">Riwayat Status</a></li>
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
                    <h4 class="card-title">Form Edit Riwayat Status</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('riwayat.update', $riwayat->riwayat_id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Informasi Read-Only --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Permohonan</label>
                                    <input type="text" class="form-control" value="{{ $riwayat->permohonan->nomor_permohonan ?? '-' }}" readonly>
                                    <small class="text-muted">Permohonan tidak dapat diubah</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Petugas Penanggung Jawab</label>
                                    <input type="text" class="form-control" value="{{ $riwayat->petugas->nama ?? 'System' }}" readonly>
                                    <small class="text-muted">Petugas tidak dapat diubah</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status Baru</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Diajukan" {{ old('status', $riwayat->status) == 'Diajukan' ? 'selected' : '' }}>
                                            Diajukan
                                        </option>
                                        <option value="Diproses" {{ old('status', $riwayat->status) == 'Diproses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>
                                        <option value="Selesai" {{ old('status', $riwayat->status) == 'Selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                        <option value="Ditolak" {{ old('status', $riwayat->status) == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="waktu">Waktu Perubahan</label>
                                    <input type="datetime-local" class="form-control" id="waktu" name="waktu"
                                        value="{{ old('waktu', \Carbon\Carbon::parse($riwayat->waktu)->format('Y-m-d\TH:i')) }}" required>
                                    @error('waktu')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan / Catatan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4"
                                        placeholder="Contoh: Menunggu verifikasi dokumen, Data sudah lengkap, Permohonan ditolak karena alasan tertentu">{{ old('keterangan', $riwayat->keterangan) }}</textarea>
                                    <small class="text-muted">Berikan keterangan detail tentang perubahan status ini</small>
                                    @error('keterangan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Riwayat --}}
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <div class="alert-heading h6">
                                        <i data-feather="clock"></i> Informasi Riwayat
                                    </div>
                                    <ul class="mb-0">
                                        <li>Riwayat dibuat pada: {{ \Carbon\Carbon::parse($riwayat->created_at)->format('d F Y H:i:s') }}</li>
                                        @if($riwayat->updated_at != $riwayat->created_at)
                                            <li>Terakhir diperbarui: {{ \Carbon\Carbon::parse($riwayat->updated_at)->format('d F Y H:i:s') }}</li>
                                        @endif
                                        <li>Status saat ini:
                                            @if ($riwayat->status == 'Diajukan')
                                                <span class="badge bg-warning">Diajukan</span>
                                            @elseif($riwayat->status == 'Diproses')
                                                <span class="badge bg-info">Diproses</span>
                                            @elseif($riwayat->status == 'Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i data-feather="check"></i> Update Riwayat
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
