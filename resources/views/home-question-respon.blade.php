<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-4 text-center">
                        <div class="alert alert-success mb-4">
                            <h4 class="alert-heading">Login Berhasil!</h4>
                            <p class="mb-0">Selamat datang di sistem Layanan Desa</p>
                        </div>

                        <div class="mb-3 text-start">
                            <strong>Username:</strong> {{ $username }}
                        </div>

                        <div class="mb-4 text-start">
                            <strong>Password:</strong> {{ $password }}
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.index') }}" class="btn btn-primary btn-lg">
                                Masuk ke Dashboard Admin
                            </a>
                            <a href="{{ route('auth.index') }}" class="btn btn-outline-secondary">
                                Kembali ke Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

