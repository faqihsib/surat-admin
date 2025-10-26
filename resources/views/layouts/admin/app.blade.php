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
</body>
</html>
