<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($dataJenisSurat) ? 'Edit' : 'Tambah' }} Jenis Surat - Layanan Desa</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="">
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
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>{{ isset($dataJenisSurat) ? 'Edit' : 'Tambah' }} Jenis Surat</h3>
                            <p class="text-subtitle text-muted">Form {{ isset($dataJenisSurat) ? 'edit' : 'tambah' }} jenis surat</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('jenis-surat.index') }}">Jenis Surat</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ isset($dataJenisSurat) ? 'Edit' : 'Tambah' }}</li>
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
                            <h4 class="card-title">Form Jenis Surat</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($dataJenisSurat) ? route('jenis-surat.update', $dataJenisSurat->jenis_id) : route('jenis-surat.store') }}">
                                @csrf
                                @if (isset($dataJenisSurat))
                                    @method('POST')
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode">Kode Surat</label>
                                            <input type="text" class="form-control" id="kode" name="kode"
                                                value="{{ old('kode', $dataJenisSurat->kode ?? '') }}" required
                                                placeholder="Contoh: SKM, SKD, SKB">
                                            @error('kode')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_jenis">Nama Jenis Surat</label>
                                            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                                                value="{{ old('nama_jenis', $dataJenisSurat->nama_jenis ?? '') }}"
                                                required placeholder="Contoh: Surat Keterangan Miskin">
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
                                                placeholder="Contoh: KTP, KK, Surat Pengantar RT">{{ old('syarat_json', $dataJenisSurat->syarat_json ?? '') }}</textarea>
                                            <small class="text-muted">Pisahkan setiap syarat dengan koma</small>
                                            @error('syarat_json')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i data-feather="{{ isset($dataJenisSurat) ? 'check' : 'save' }}"></i>
                                        {{ isset($dataJenisSurat) ? 'Update' : 'Simpan' }}
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
        </div>
    </div>

    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        // Initialize Feather Icons
        feather.replace();
    </script>
</body>

</html>
