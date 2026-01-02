@extends('layouts.lp')

@section('title', 'FAQ - E-KP')

@section('content')
<div class="d-flex flex-column flex-root">
    <!-- Header/Hero -->
    <div class="mb-0">
        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url({{ asset('assets/media/svg/illustrations/landing.svg') }})">
            <div class="d-flex flex-column flex-center w-100 min-h-200px px-9">
                <div class="text-center mb-5 py-10">
                    <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-5">
                       FAQ
                    </h1>
                     <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                        <span class="fs-4 fw-bold">Pertanyaan yang Sering Diajukan</span>
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

    <!-- FAQ Section -->
    <div class="mb-n10 mb-lg-n20 z-index-2 py-10">
        <div class="container">
             <div class="row w-100 gy-10 mb-md-20 justify-content-center">
                <div class="col-md-8">
                     <!-- FAQ Item 1 -->
                    <div class="mb-10">
                        <div class="d-flex align-items-center mb-3">
                             <div class="d-flex flex-center me-3 w-50px h-50px rounded-circle bg-light-success">
                                <i class="fas fa-question text-success fs-3"></i>
                            </div>
                            <h4 class="fs-2 text-gray-900 fw-bold mb-0">Bagaimana cara mendaftar akun E-KP?</h4>
                        </div>
                         <div class="ps-14 text-muted fs-4 fw-semibold lh-lg">
                            Anda dapat mendaftar dengan mengklik tombol "Sign In" di pojok kanan atas, lalu pilih "Sign Up" atau minta admin instansi Anda untuk membuatkan akun.
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="mb-10">
                         <div class="d-flex align-items-center mb-3">
                            <div class="d-flex flex-center me-3 w-50px h-50px rounded-circle bg-light-success">
                                <i class="fas fa-question text-success fs-3"></i>
                            </div>
                            <h4 class="fs-2 text-gray-900 fw-bold mb-0">Apakah data saya aman?</h4>
                        </div>
                        <div class="ps-14 text-muted fs-4 fw-semibold lh-lg">
                            Ya, keamanan data adalah prioritas kami. Semua data dienkripsi dan disimpan di server yang aman dengan backup berkala.
                        </div>
                    </div>
                    
                    <!-- FAQ Item 3 -->
                    <div class="mb-10">
                         <div class="d-flex align-items-center mb-3">
                            <div class="d-flex flex-center me-3 w-50px h-50px rounded-circle bg-light-success">
                                <i class="fas fa-question text-success fs-3"></i>
                            </div>
                            <h4 class="fs-2 text-gray-900 fw-bold mb-0">Bagaimana jika saya lupa password?</h4>
                        </div>
                         <div class="ps-14 text-muted fs-4 fw-semibold lh-lg">
                            Silakan hubungi administrator sistem di kantor Anda untuk me-reset password akun Anda.
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="mb-10">
                         <div class="d-flex align-items-center mb-3">
                            <div class="d-flex flex-center me-3 w-50px h-50px rounded-circle bg-light-success">
                                <i class="fas fa-question text-success fs-3"></i>
                            </div>
                            <h4 class="fs-2 text-gray-900 fw-bold mb-0">Bisakah diakses lewat HP?</h4>
                        </div>
                         <div class="ps-14 text-muted fs-4 fw-semibold lh-lg">
                            Tentu, E-KP didesain responsif sehingga dapat diakses dengan nyaman melalui browser di smartphone atau tablet Anda.
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
