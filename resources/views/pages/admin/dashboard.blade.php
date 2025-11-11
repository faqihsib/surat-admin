@extends('layouts.admin.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Dashboard Admin Desa</h3>
        <p class="text-subtitle text-muted">Halo! Selamat datang admin!!</p>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>TOTAL WARGA</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $total_warga }}</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas1" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>PERMOHONAN HARI INI</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $permohonan_hari_ini }}</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas2" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>SEDANG DIPROSES</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $permohonan_diproses }}</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas3" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>SELESAI</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $permohonan_selesai }}</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas4" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>Statistik Permohonan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="pl-3">
                                    <h1 class='mt-5'>{{ $total_warga }}</h1>
                                    <p class='text-xs'><span class="text-green"><i
                                                data-feather="bar-chart" width="15"></i> +19%</span>
                                        than last month</p>
                                    <div class="legends">
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-info mr-2'></div><span
                                                class='text-xs'>Last Month</span>
                                        </div>
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-blue mr-2'></div><span
                                                class='text-xs'>Current Month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-12">
                                <canvas id="bar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Permohonan Terbaru</h4>
                        <div class="d-flex ">
                            <i data-feather="download"></i>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>No. Permohonan</th>
                                        <th>Nama Pemohon</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($permohonan_hari_ini > 0)
                                        @for ($i = 1; $i <= min(5, $permohonan_hari_ini); $i++)
                                            <tr>
                                                <td>PMH-{{ date('Ymd') }}{{ $i }}</td>
                                                <td>Warga {{ $i }}</td>
                                                <td>Surat Keterangan {{ $i }}</td>
                                                <td>{{ date('d/m/Y') }}</td>
                                                <td>
                                                    @if ($i % 3 == 0)
                                                        <span class="badge bg-success">Selesai</span>
                                                    @elseif($i % 3 == 1)
                                                        <span class="badge bg-warning">Diproses</span>
                                                    @else
                                                        <span class="badge bg-danger">Menunggu</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada permohonan
                                                hari ini</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header">
                        <h4>Status Permohonan</h4>
                    </div>
                    <div class="card-body">
                        <div id="radialBars"></div>
                        <div class="text-center mb-5">
                            <h6>From last month</h6>
                            <h1 class='text-green'>+{{ $permohonan_hari_ini }}</h1>
                        </div>
                    </div>
                </div>
                <div class="card widget-todo">
                    <div
                        class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h4 class="card-title d-flex">
                            <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Progress Layanan
                        </h4>

                    </div>
                    <div class="card-body px-0 py-1">
                        <table class='table table-borderless'>
                            <tr>
                                <td class='col-3'>Surat Keterangan</td>
                                <td class='col-6'>
                                    <div class="progress progress-info">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class='col-3 text-center'>60%</td>
                            </tr>
                            <tr>
                                <td class='col-3'>Surat Domisili</td>
                                <td class='col-6'>
                                    <div class="progress progress-success">
                                        <div class="progress-bar" role="progressbar" style="width: 35%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class='col-3 text-center'>35%</td>
                            </tr>
                            <tr>
                                <td class='col-3'>Surat Tidak Mampu</td>
                                <td class='col-6'>
                                    <div class="progress progress-danger">
                                        <div class="progress-bar" role="progressbar" style="width: 50%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class='col-3 text-center'>50%</td>
                            </tr>
                            <tr>
                                <td class='col-3'>Surat Pengantar</td>
                                <td class='col-6'>
                                    <div class="progress progress-primary">
                                        <div class="progress-bar" role="progressbar" style="width: 80%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class='col-3 text-center'>80%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
