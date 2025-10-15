<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($jenis_surat) ? 'Edit' : 'Tambah' }} Jenis Surat - Layanan Desa</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg')}}" type="image/x-icon">
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
                        <li class="sidebar-item">
                            <a href="{{ route('warga.index') }}" class='sidebar-link'>
                                <i data-feather="users" width="20"></i>
                                <span>Data Warga</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
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
                    <h3>{{ isset($jenis_surat) ? 'Edit' : 'Tambah' }} Jenis Surat</h3>
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
                            <h4 class="card-title">Form Jenis Surat</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($jenis_surat) ? route('jenis-surat.update', $jenis_surat['jenis_id']) : route('jenis-surat.store') }}">
                                @csrf
                                @if(isset($jenis_surat))
                                    @method('POST')
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Surat</label>
                                            <input type="text" class="form-control" name="kode"
                                                value="{{ old('kode', $jenis_surat['kode'] ?? '') }}" required
                                                placeholder="Contoh: SKM, SKD, SKB">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Jenis Surat</label>
                                            <input type="text" class="form-control" name="nama_jenis"
                                                value="{{ old('nama_jenis', $jenis_surat['nama_jenis'] ?? '') }}" required
                                                placeholder="Contoh: Surat Keterangan Miskin">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Syarat (pisahkan dengan koma)</label>
                                            <textarea class="form-control" name="syarat_json"
                                                placeholder="Contoh: KTP, KK, Surat Pengantar RT">{{ old('syarat_json', $jenis_surat['syarat_json'] ?? '') }}</textarea>
                                            <small class="text-muted">Pisahkan setiap syarat dengan koma</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($jenis_surat) ? 'Update' : 'Simpan' }}
                                    </button>
                                    <a href="{{ route('jenis-surat.index') }}" class="btn btn-secondary">Batal</a>
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
