@extends('layouts.lp')

@section('title', 'E-KP - Elektronik Kerja Perkantoran')

@section('content')
<div class="d-flex flex-column flex-root">
    <!-- Hero Section -->
    <div class="mb-0" id="home">
        <div class="bgi-no-repeat bgi-size-cover bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url(assets/media/svg/illustrations/landing.svg)">
            <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                    <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">
                        Transformasi Digital untuk
                        <br />
                        <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                            <span>Efisiensi Kerja Perkantoran</span>
                        </span>
                    </h1>
                    <p class="fs-4 text-gray-500 fw-semibold mb-10">
                        E-KP adalah solusi terintegrasi untuk mengelola surat-menyurat, disposisi, dan administrasi kantor Anda secara digital.
                        <br/>
                        Tingkatkan produktivitas dan sederhanakan alur kerja dengan platform kami.
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-primary">Mulai Sekarang</a>

                    <div class="mt-2">
                        <div class="d-flex flex-center flex-wrap position-relative px-5">
                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="STMIK BANDUNG">
                                <img src="assets/media/logos/stmik.png" class="mh-30px mh-lg-40px" alt="STMIK Bandung" />
                            </div>
                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Dataquest">
                                <img src="assets/media/logos/dataquest.png" class="mh-30px mh-lg-40px" alt="Dataquest" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
            <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-10 py-lg-20">
        <div class="container">
            <div class="text-center mb-17">
                <h3 class="fs-2hx text-gray-900 mb-5">Fitur Unggulan E-KP</h3>
                <div class="fs-5 text-muted fw-bold">Dirancang untuk menyederhanakan dan mempercepat proses administrasi perkantoran Anda.</div>
            </div>
            <div class="row w-100 gy-10 mb-md-20">
                <!-- Feature 1 -->
                <div class="col-md-4 px-5">
                    <div class="text-center">
                        <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-archive fs-2x text-success"></i>
                            </span>
                        </div>
                        <div class="fs-5 fs-lg-3 fw-bold text-gray-900 mb-5">Arsip Digital Terpusat</div>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">Akses semua surat masuk dan keluar dengan mudah melalui satu sistem. Pencarian cepat dan pengarsipan aman.</div>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-4 px-5">
                    <div class="text-center">
                        <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-share-square fs-2x text-success"></i>
                            </span>
                        </div>
                        <div class="fs-5 fs-lg-3 fw-bold text-gray-900 mb-5">Disposisi Cepat & Tepat</div>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">Lacak dan teruskan disposisi surat secara real-time. Pastikan setiap instruksi sampai ke orang yang tepat tanpa penundaan.</div>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-4 px-5">
                    <div class="text-center">
                        <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">
                                <i class="fas fa-users fs-2x text-success"></i>
                            </span>
                        </div>
                        <div class="fs-5 fs-lg-3 fw-bold text-gray-900 mb-5">Kolaborasi Tanpa Batas</div>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">Tingkatkan kerja sama tim dengan fitur kolaborasi yang memungkinkan komunikasi lancar antar departemen.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="mt-sm-n10">
        <div class="landing-curve landing-dark-color">
            <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
            </svg>
        </div>
        <div class="pb-15 pt-18 landing-dark-bg">
            <div class="container">
                <div class="text-center mt-15 mb-18">
                    <h3 class="fs-2hx text-white fw-bold mb-5">Statistik Kinerja Kantor</h3>
                    <div class="fs-5 text-gray-700 fw-bold">Data kinerja dan aktivitas terbaru dalam lingkup internal.</div>
                </div>
                <div class="d-flex flex-center">
                    <div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">
                        <!-- Stat 1: Registered Users -->
                        <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
                            <i class="fas fa-users fs-2tx text-white mb-3"></i>
                            <div class="mb-0">
                                <div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">150+</div>
                                <span class="text-gray-600 fw-semibold fs-5 lh-0">Pengguna Terdaftar</span>
                            </div>
                        </div>
                        <!-- Stat 2: Completed Jobs -->
                        <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
                            <i class="fas fa-check-circle fs-2tx text-white mb-3"></i>
                            <div class="mb-0">
                                <div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">2,500+</div>
                                <span class="text-gray-600 fw-semibold fs-5 lh-0">Pekerjaan Selesai</span>
                            </div>
                        </div>
                        <!-- Stat 3: Letters Processed -->
                        <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
                            <i class="fas fa-envelope-open-text fs-2tx text-white mb-3"></i>
                            <div class="mb-0">
                                <div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">5,000+</div>
                                <span class="text-gray-600 fw-semibold fs-5 lh-0">Surat Diproses</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="landing-curve landing-dark-color">
            <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Top 3 Employees Section -->
    <div class="py-10 py-lg-20">
        <div class="container">
            <div class="text-center mb-12">
                <h3 class="fs-2hx text-gray-900 mb-5">Karyawan Terbaik Bulan Ini</h3>
                <div class="fs-5 text-muted fw-bold">Apresiasi bagi individu dengan kinerja dan kontribusi luar biasa.</div>
            </div>
            <div class="row g-10">
                <!-- Employee 2 -->
                <div class="col-lg-4">
                    <div class="text-center">
                        <div class="position-relative d-inline-block">
                            <span class="badge badge-circle badge-light-warning fw-bold p-4 fs-3 position-absolute top-0 start-100 translate-middle">2</span>
                            <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('assets/media/avatars/300-2.jpg')"></div>
                        </div>
                        <div class="mb-0">
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Siti Nurbaya</a>
                            <div class="text-muted fs-6 fw-semibold mt-1">Sekretaris</div>
                        </div>
                    </div>
                </div>
                <!-- Employee 1 -->
                <div class="col-lg-4">
                    <div class="text-center">
                        <div class="position-relative d-inline-block">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 fs-1 position-absolute top-0 start-100 translate-middle">1</span>
                            <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('assets/media/avatars/300-1.jpg')"></div>
                        </div>
                        <div class="mb-0">
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Ahmad Subarjo</a>
                            <div class="text-muted fs-6 fw-semibold mt-1">Staf Administrasi</div>
                        </div>
                    </div>
                </div>
                <!-- Employee 3 -->
                <div class="col-lg-4">
                    <div class="text-center">
                        <div class="position-relative d-inline-block">
                            <span class="badge badge-circle badge-light-primary fw-bold p-4 fs-3 position-absolute top-0 start-100 translate-middle">3</span>
                            <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('assets/media/avatars/300-5.jpg')"></div>
                        </div>
                        <div class="mb-0">
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Budi Santoso</a>
                            <div class="text-muted fs-6 fw-semibold mt-1">Staf Keuangan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="mb-lg-n15 position-relative z-index-2">
        <div class="container">
            <div class="card" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
                <div class="card-body p-lg-20">
                    <div class="text-center">
                        <h3 class="fs-2hx text-gray-900 mb-5">Siap Meningkatkan Produktivitas Kantor Anda?</h3>
                        <div class="fs-5 text-muted fw-bold mb-10">Bergabunglah dengan ratusan instansi yang telah bertransformasi secara digital bersama E-KP.</div>
                        <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Daftar Gratis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="mt-20">
        <div class="landing-curve landing-dark-color">
            <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
            </svg>
        </div>
        <div class="landing-dark-bg pt-20">
            <div class="container">
                <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                    <div class="d-flex align-items-center order-2 order-md-1">
                        <a href="{{ url('/') }}">
                            <img alt="Logo" src="assets/media/logos/e-kp.png" class="h-15px h-md-20px" />
                        </a>
                        <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1">&copy; {{ date('Y') }} E-KP.</span>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                        <li class="menu-item">
                            <a href="#" class="menu-link px-2">Tentang</a>
                        </li>
                        <li class="menu-item mx-5">
                            <a href="#" class="menu-link px-2">Dukungan</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('register') }}" class="menu-link px-2">Daftar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
