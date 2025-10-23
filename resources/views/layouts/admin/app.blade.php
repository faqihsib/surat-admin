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
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
        feather.replace();
    </script>
</body>
</html>
