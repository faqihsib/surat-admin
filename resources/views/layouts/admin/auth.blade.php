<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Layanan Desa</title>

    {{-- start css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logoBaru.png') }}" type="image/x-icon">
    {{-- end css --}}

    <style>
        /* Reset margin body agar tidak ada scrollbar tidak perlu */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden; /* Mencegah scrollbar ganda */
        }

        .auth-container {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

            /* SETTING BACKGROUND YANG BENAR */
            /* Menggunakan asset() agar path gambar akurat */
            background-image: url("{{ asset('assets/images/auth.jpg') }}");

            /* Agar gambar memenuhi layar tanpa terpotong aneh */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95); /* Sedikit transparan agar estetik */
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: 20px; /* Jarak aman di layar HP */
        }

        .auth-header {
            text-align: center;
            padding: 2rem 1rem 1rem;
        }

        .auth-logo {
            width: 80px;
            margin-bottom: 1rem;
        }

        .auth-body {
            padding: 1rem 2rem 2rem;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            {{-- start header --}}
            <div class="auth-header">
                <img src="{{ asset('assets/images/logoBaru.png') }}" alt="Logo" class="auth-logo">
                <h4>@yield('page-title', 'Login Administrasi Desa')</h4>
                <p class="text-muted">@yield('page-subtitle', 'Selamat datang di login Administrasi Surat')</p>
            </div>

            <div class="auth-body">
                {{-- start alert Messages --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- start main content --}}
                @yield('content')
                {{-- end main content --}}
            </div>
        </div>
    </div>

    {{-- start js --}}
    @include('layouts.admin.js')
    {{-- end js --}}

    <script>
        feather.replace();
        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>

    @yield('scripts')
</body>

</html>
