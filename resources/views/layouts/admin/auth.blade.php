<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Layanan Desa</title>

    {{-- start css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    {{-- end css --}}

    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('assets/images/auth.jpg');
        }

        .auth-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
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

        body {
            background-image: url('public/assets/images/background/auth.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            {{-- start header --}}
            <div class="auth-header">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="auth-logo">
                <h4>@yield('page-title', 'Login Administrasi Desa')</h4>
                <p class="text-muted">@yield('page-subtitle', 'Selamat datang di login Adminstrasi Surat')</p>
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
                        <ul class="mb-0">
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
