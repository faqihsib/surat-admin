<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Layanan Desa</title>
    @include('layouts.admin.css')

</head>

<body>
    <div id="app">
        @include('layouts.admin.sidebar')

        <div id="main">
            @include('layouts.admin.header')

            @yield('content')

            {{-- end main content --}}

            @include('layouts.admin.footer')
        </div>
    </div>

    @include('layouts.admin.js')

    <script>
        // Inisialisasi DataTable hanya jika tabel ada
        let table1 = document.querySelector('#table1');
        if (table1) {
            let dataTable = new simpleDatatables.DataTable(table1);
        }

        // Pastikan feather icons selalu di-load
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>

    <!-- add your custom CSS -->
    <style>
        body {
            font-family: sans-serif;
        }

        /* Add WA floating button CSS */
        .floating {
            position: fixed;
            width: 80px;
            height: 60px;
            bottom: 50px;
            right: 40px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .fab-icon {
            margin-top: 16px;
        }
    </style>
    <a href="https://wa.me/6285271275763?text=Hi%20Faqih" class="floating" target="_blank">
        <i class="fab fa-whatsapp fab-icon"></i>
    </a>
</body>

</html>
