@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Jenis Surat</h3>
                    <p class="text-subtitle text-muted">Form tambah jenis surat</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('jenis-surat.index') }}">Jenis Surat</a></li>
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
                    <h4 class="card-title">Form Tambah Jenis Surat</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('jenis-surat.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode">Kode Surat</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        value="{{ old('kode') }}" required placeholder="Contoh: SKM, SKD, SKB">
                                    @error('kode')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_jenis">Nama Jenis Surat</label>
                                    <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                                        value="{{ old('nama_jenis') }}" required
                                        placeholder="Contoh: Surat Keterangan Miskin">
                                    @error('nama_jenis')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="syarat_json">Syarat (pisahkan dengan koma)</label>
                                    <textarea class="form-control" id="syarat_json" name="syarat_json" rows="3"
                                        placeholder="Contoh: KTP, KK, Surat Pengantar RT">{{ old('syarat_json') }}</textarea>
                                    <small class="text-muted">Pisahkan setiap syarat dengan koma</small>
                                    @error('syarat_json')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="diajukan"
                                            {{ old('status') == 'diajukan' ? 'selected' : '' }}>Sedang Diajukan
                                        </option>
                                        <option value="diproess"
                                            {{ old('status') == 'diproess' ? 'selected' : '' }}>Sedang Diproses
                                        </option>
                                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>
                                            Diterima</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i data-feather="save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('jenis-surat.index') }}" class="btn btn-secondary">
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
