<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($warga) ? 'Edit' : 'Tambah' }} Warga - Layanan Desa</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{ asset('assets/images/logo.svg')}}" alt="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.index') }}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a href="{{ route('warga.index') }}" class='sidebar-link'>
                                <i data-feather="users" width="20"></i>
                                <span>Data Warga</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('jenis-surat.index') }}" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i>
                                <span>Jenis Surat</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="main">
            <!-- Navbar -->
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-none d-md-block d-lg-inline-block">Hi, Admin Desa</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>{{ isset($warga) ? 'Edit' : 'Tambah' }} Data Warga</h3>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Data Warga</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($warga) ? route('warga.update', $warga['warga_id']) : route('warga.store') }}">
                                @csrf
                                @if(isset($warga))
                                    @method('POST')
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. KTP</label>
                                            <input type="text" class="form-control" name="no_ktp"
                                                value="{{ old('no_ktp', $warga['no_ktp'] ?? '') }}" required
                                                maxlength="16" placeholder="16 digit angka">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama"
                                                value="{{ old('nama', $warga['nama'] ?? '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" required>
                                                <option value="">Pilih</option>
                                                <option value="L" {{ (old('jenis_kelamin', $warga['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ (old('jenis_kelamin', $warga['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <input type="text" class="form-control" name="agama"
                                                value="{{ old('agama', $warga['agama'] ?? '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan"
                                                value="{{ old('pekerjaan', $warga['pekerjaan'] ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control" name="telp"
                                                value="{{ old('telp', $warga['telp'] ?? '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email', $warga['email'] ?? '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($warga) ? 'Update' : 'Simpan' }}
                                    </button>
                                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script>
        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
</html>
</body>
</html>
