@extends('layouts.admin.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Dashboard Admin Desa</h3>
        <p class="text-subtitle text-muted">Halo <b>{{ Auth::user()->name }}</b>! Selamat datang di panel admin.</p>
    </div>
    <section class="section">
        {{-- BAGIAN 1: KARTU STATISTIK --}}
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

        {{-- BAGIAN 2: GRAFIK & TABEL --}}
        <div class="row mb-4">
            <div class="col-md-8">
                {{-- KARTU GRAFIK --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>Statistik Permohonan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="pl-3">
                                    <h1 class='mt-5'>{{ $total_permohonan }}</h1>
                                    <p class='text-xs'><span class="text-green"><i data-feather="bar-chart" width="15"></i> Data Real</span> Total Permohonan Masuk</p>
                                    <div class="legends">
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-info mr-2'></div><span class='text-xs'>Permohonan</span>
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

                {{-- KARTU TABEL PERMOHONAN TERBARU --}}
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Permohonan Terbaru</h4>
                        <div class="d-flex ">
                            <a href="{{ route('permohonan-surat.index') }}">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>Nama Pemohon</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- LOOPING DATA REAL --}}
                                    @forelse($permohonan_terbaru as $item)
                                        <tr>
                                            <td>{{ $item->pemohon->nama }}</td>
                                            <td>{{ $item->jenisSurat->nama_jenis }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($item->status == 'Selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @elseif($item->status == 'Ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center p-3">Belum ada data permohonan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BAGIAN 3: WIDGET KANAN (PROFIL USER) --}}
            <div class="col-md-4">
                {{-- WIDGET STATUS SAYA (Ganti Progress Layanan) --}}
                <div class="card widget-todo">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h4 class="card-title d-flex">
                            <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Status Saya
                        </h4>
                    </div>
                    <div class="card-body px-0 py-4">
                        <div class="text-center">
                            {{-- Tampilkan Foto Profil --}}
                            <div class="avatar avatar-xl mb-3">
                                @if(Auth::user()->foto_profil)
                                    <img src="{{ asset('uploads/profile/' . Auth::user()->foto_profil) }}" alt="Avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="Avatar">
                                @endif
                            </div>

                            {{-- Nama & Role --}}
                            <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                            <p class="text-muted mb-3">{{ ucfirst(Auth::user()->role) }}</p>

                            {{-- Tombol Edit Profil --}}
                            <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-sm btn-primary">Edit Profil</a>
                        </div>
                    </div>
                </div>

                {{-- CHART BULAT (Optional - Biarkan Static atau Hapus) --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Status Permohonan</h4>
                    </div>
                    <div class="card-body">
                        <div id="radialBars"></div>
                        <div class="text-center mb-5">
                            <h6>Total Diproses</h6>
                            <h1 class='text-green'>{{ $permohonan_diproses }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    {{-- Script Bawaan Template --}}
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
