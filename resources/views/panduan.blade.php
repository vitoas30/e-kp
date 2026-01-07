@extends('layouts.lp')

@section('title', 'Panduan - E-KP')

@section('content')
<div class="d-flex flex-column flex-root">
    <!-- Header/Hero -->
    <div class="mb-0">
        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url({{ asset('assets/media/svg/illustrations/landing.svg') }})">
            <div class="d-flex flex-column flex-center w-100 min-h-200px px-9">
                <div class="text-center mb-5 py-10">
                    <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-5">
                       Panduan Penggunaan
                    </h1>
                    <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                        <span class="fs-4 fw-bold">E-KP (Elektronik Kerja Perkantoran)</span>
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

    <!-- Steps Section -->
    <div class="mb-n10 mb-lg-n20 z-index-2 py-10">
        <div class="container">
            <div class="text-center mb-17">
                <h3 class="fs-2hx text-gray-900 mb-5">Cara Melakukan Pencatatan Pekerjaan</h3>
                <div class="fs-5 text-muted fw-bold">Ikuti langkah-langkah singkat berikut untuk memulai input data project</div>
            </div>
            
            <div class="row w-100 gy-10 mb-md-20">
                <!-- Step 1 -->
                <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">1</span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Login</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Masuk ke aplikasi menggunakan akun Anda. Klik tombol <b>Sign In</b> di pojok kanan atas.
                        </div>
                    </div>
                </div>
                
                 <!-- Step 2 -->
                <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">2</span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Menu Projects</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Setelah masuk dashboard, pilih menu <b>Projects</b> di sidebar atau menu utama.
                        </div>
                    </div>
                </div>

                 <!-- Step 3 -->
                <div class="col-md-4 px-5">
                    <div class="text-center mb-10 mb-md-0">
                         <div class="d-flex flex-center mb-5">
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">3</span>
                        </div>
                        <h4 class="fs-5 fs-lg-3 fw-bold text-gray-900">Input Data</h4>
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                            Klik tombol <b>Create/Tambah</b>, isi form detail pekerjaan (Judul, Deskripsi, Tenggat Waktu), lalu simpan.
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
