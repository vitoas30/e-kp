@extends('layouts.lp')

@section('title', 'Fitur Utama - E-KP')

@section('content')
<div class="d-flex flex-column flex-root">
    <!-- Header/Hero -->
    <div class="mb-0">
        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url({{ asset('assets/media/svg/illustrations/landing.svg') }})">
            <div class="d-flex flex-column flex-center w-100 min-h-200px px-9">
                <div class="text-center mb-5 py-10">
                    <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-5">
                       Fitur Utama
                    </h1>
                    <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                        <span class="fs-4 fw-bold">Keunggulan E-KP untuk Produktivitas Anda</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="landing-curve landing-dark-color mb-10">
            <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mb-n10 mb-lg-n20 z-index-2 py-10">
        <div class="container">
            <div class="row w-100 gy-10 mb-md-20">
                <!-- Feature 1 -->
                <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-archive fs-2x text-success"></i>
                            </span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Arsip Digital Terpusat</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Simpan dan kelola seluruh dokumen penting dalam satu tempat yang aman dan mudah diakses kapan saja.
                        </div>
                    </div>
                </div>
                
                 <!-- Feature 2 -->
                <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-tasks fs-2x text-success"></i>
                            </span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Manajemen Proyek</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Pantau perkembangan proyek tim secara real-time, atur tenggat waktu, dan delegasikan tugas dengan efisien.
                        </div>
                    </div>
                </div>

                 <!-- Feature 3 -->
                <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-share-square fs-2x text-success"></i>
                            </span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Disposisi Surat</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Alur disposisi surat yang jelas dan cepat, meminimalisir birokrasi dan mempercepat pengambilan keputusan.
                        </div>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-user-clock fs-2x text-success"></i>
                            </span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Presensi & Kinerja</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Catat kehadiran karyawan dan evaluasi kinerja bulanan secara otomatis dan transparan.
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                 <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-chart-line fs-2x text-success"></i>
                            </span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Laporan Statistik</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Dapatkan wawasan mendalam melalui grafik dan laporan statistik untuk mendukung pengambilan keputusan strategis.
                        </div>
                    </div>
                </div>

                <!-- Feature 6 -->
                 <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-mobile-alt fs-2x text-success"></i>
                            </span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Akses Mobile</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Akses sistem dari mana saja melalui perangkat mobile, memastikan produktivitas tidak terhambat oleh lokasi.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="mt-20">
         <div class="landing-dark-bg pt-20">
            <div class="container">
                <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                    <div class="d-flex align-items-center order-2 order-md-1">
                        <a href="{{ url('/') }}">
                            <img alt="Logo" src="{{ asset('assets/media/logos/ekp.png') }}" class="h-15px h-md-20px" />
                        </a>
                        <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1">&copy; 2024 E-KP.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
