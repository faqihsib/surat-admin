<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Desa</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('auth.index') }}">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <h1 class="my-4">Dashboard Admin Desa</h1>

        <div class="row">
            <!-- Card Total Warga -->
            <div class="col-md-3">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Warga</h5>
                        <p class="card-text display-6">{{ $total_warga }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Permohonan Hari Ini -->
            <div class="col-md-3">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Permohonan Hari Ini</h5>
                        <p class="card-text display-6">{{ $permohonan_hari_ini }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Sedang Diproses -->
            <div class="col-md-3">
                <div class="card text-bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Sedang Diproses</h5>
                        <p class="card-text display-6">{{ $permohonan_diproses }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Selesai -->
            <div class="col-md-3">
                <div class="card text-bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Selesai</h5>
                        <p class="card-text display-6">{{ $permohonan_selesai }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contoh Blade Directive -->
        <div class="mt-5">
            <h3>Daftar Status Permohonan</h3>
            @if($permohonan_hari_ini > 0)
                <ul class="list-group">
                    @for($i = 1; $i <= $permohonan_hari_ini; $i++)
                        <li class="list-group-item">Permohonan {{ $i }} - <span class="badge bg-warning">Pending</span></li>
                    @endfor
                </ul>
            @else
                <div class="alert alert-info">Tidak ada permohonan hari ini</div>
            @endif
        </div>
    </div>
</body>
</html>
