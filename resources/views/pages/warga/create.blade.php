@extends('layouts.admin.app')

@section('content')
            {{-- start main content --}}
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Tambah Data Warga</h3>
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
                            <h4 class="card-title">Form Tambah Data Warga</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('warga.store') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. KTP</label>
                                            <input type="text" class="form-control" name="no_ktp"
                                                value="{{ old('no_ktp') }}" required
                                                maxlength="16" placeholder="16 digit angka">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama"
                                                value="{{ old('nama') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" required>
                                                <option value="">Pilih</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <input type="text" class="form-control" name="agama"
                                                value="{{ old('agama') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan"
                                                value="{{ old('pekerjaan') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control" name="telp"
                                                value="{{ old('telp') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            {{-- end main content --}}
@endsection
