@extends('layouts.admin.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>About Developer</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            {{-- PERUBAHAN DISINI: Menggunakan col-12 agar FULL WIDTH --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row align-items-center">

                            {{-- KOLOM KIRI: FOTO (Responsif: lebar disesuaikan layar) --}}
                            {{-- col-lg-3 artinya di layar besar ambil 3 kolom, sisanya teks --}}
                            <div class="col-lg-3 col-md-4 text-center border-end">
                                <div class="avatar-wrapper mb-3 mb-md-0">
                                    <img src="https://i.ibb.co.com/S4hFhkrV/Pas-Foto-Kuliah-Copy.jpg" alt="Pas-Foto-Kuliah-Copy" border="0"
                                         alt="Foto Profil"
                                         class="rounded-circle img-thumbnail"
                                         style="width: 180px; height: 180px; object-fit: cover;">
                                </div>
                            </div>

                            {{-- KOLOM KANAN: IDENTITAS --}}
                            <div class="col-lg-9 col-md-8 ps-md-4">
                                <h3 class="mb-1 font-weight-bold">Faqih Hidayah</h3>
                                <p class="text-muted mb-2" style="font-size: 1.1rem;">NIM: 2457301047</p>

                                <div class="badge bg-light-primary text-primary mb-3 px-3 py-2">
                                    Mahasiswa Prodi Sistem Informasi - Semester 3
                                </div>

                                <p class="text-muted text-justify">
                                    "Aplikasi ini dibuat sebagai pemenuhan tugas Project Matakuliah Pemrograman Framework.
                                    Dibangun dengan penuh semangat menggunakan Laravel 11 dan Template Voler."
                                </p>

                                <hr class="my-3">
                                <div class="d-flex justify-content-start flex-wrap">
                                    <a href="https://github.com/faqihsib/surat-admin" target="_blank" class="btn btn-outline-dark btn-sm me-2 mb-2" title="Github">
                                        <i data-feather="github" class="me-1"></i> Github
                                    </a>
                                    <a href="https://linkedin.com/in/faqih-hidayah-b4a134381" target="_blank" class="btn btn-outline-primary btn-sm me-2 mb-2" title="LinkedIn">
                                        <i data-feather="linkedin" class="me-1"></i> LinkedIn
                                    </a>
                                    <a href="https://www.instagram.com/faqihhdyh._?igsh=MW0xcHVldDN4eW5xeA==" target="_blank" class="btn btn-outline-danger btn-sm me-2 mb-2" title="Instagram">
                                        <i data-feather="instagram" class="me-1"></i> Instagram
                                    </a>
                                    <a href="mailto:faqih24si@mahasiswa.pc.ac.id" class="btn btn-outline-warning btn-sm me-2 mb-2" title="Email">
                                        <i data-feather="mail" class="me-1"></i> Email
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
