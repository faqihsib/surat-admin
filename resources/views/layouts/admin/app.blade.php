<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Layanan Desa</title>

    @include('layouts.admin.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

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


    <style>
        body {
            font-family: sans-serif;
        }

        /* 1. Aturan untuk Link (Pembungkus) */
        .wa-floating-button {
            position: fixed;
            width: 60px;  /* Ukuran lingkaran */
            height: 60px; /* Ukuran lingkaran */
            bottom: 50px;
            right: 40px;

            /* Bulat sempurna */
            border-radius: 50%;

            box-shadow: 2px 2px 5px #999;
            z-index: 100;
            transition: transform 0.2s ease-in-out;
        }

        /* Efek hover */
        .wa-floating-button:hover {
            transform: scale(1.1);
        }

        /* 2. Aturan untuk Gambar di dalamnya */
        .wa-floating-button img {
            width: 100%;
            height: 100%;
            /* Pastikan gambar juga ikut bulat */
            border-radius: 50%;
        }
    </style>
    <a href="https://wa.me/6285271275763?text=Hi%20Faqih" class="wa-floating-button" target="_blank">
        <img src="{{ asset('assets/images/waa.png') }}" alt="WhatsApp">
    </a>
    </body>

</html>
