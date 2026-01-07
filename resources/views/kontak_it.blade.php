@extends('layouts.lp')

@section('title', 'Kontak IT - E-KP')

@section('content')
<div class="d-flex flex-column flex-root">
    <!-- Header/Hero -->
    <div class="mb-0">
        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url({{ asset('assets/media/svg/illustrations/landing.svg') }})">
            <div class="d-flex flex-column flex-center w-100 min-h-200px px-9">
                <div class="text-center mb-5 py-10">
                    <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-5">
                       Kontak IT Support
                    </h1>
                     <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                        <span class="fs-4 fw-bold">Bantuan Teknis & Layanan</span>
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

    <!-- Contact Info Section -->
    <div class="mb-n10 mb-lg-n20 z-index-2 py-10">
        <div class="container">
            <div class="text-center mb-17">
                <h3 class="fs-2hx text-gray-900 mb-5">Hubungi Kami</h3>
                <div class="fs-5 text-muted fw-bold">Jika Anda mengalami kendala teknis atau memiliki pertanyaan seputar aplikasi E-KP,<br>tim IT kami siap membantu Anda.</div>
            </div>
            
            <div class="row w-100 gy-10 mb-md-20 justify-content-center">
                
                <!-- Contact Card 1: Email -->
                <div class="col-md-4 px-5">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-center flex-column p-10">
                            <div class="d-flex flex-center w-60px h-60px rounded-circle bg-light-primary mb-5">
                                <i class="fas fa-envelope fs-2x text-primary"></i>
                            </div>
                            <h4 class="fs-4 text-gray-900 fw-bold mb-2">Email Support</h4>
                            <div class="fw-semibold fs-6 text-gray-600 mb-2">Respon cepat via email</div>
                            <a href="mailto:it.support@company.com" class="text-primary fw-bold fs-5">it.support@company.com</a>
                        </div>
                    </div>
                </div>

                 <!-- Contact Card 2: WhatsApp/Phone -->
                <div class="col-md-4 px-5">
                    <div class="card h-100 border-0 shadow-sm">
                         <div class="card-body d-flex flex-center flex-column p-10">
                             <div class="d-flex flex-center w-60px h-60px rounded-circle bg-light-success mb-5">
                                <i class="fab fa-whatsapp fs-2x text-success"></i>
                            </div>
                            <h4 class="fs-4 text-gray-900 fw-bold mb-2">WhatsApp Helpdesk</h4>
                            <div class="fw-semibold fs-6 text-gray-600 mb-2">Senin - Jumat, 08:00 - 17:00</div>
                            <a href="https://wa.me/6281234567890" target="_blank" class="text-success fw-bold fs-5">+62 812-3456-7890</a>
                        </div>
                    </div>
                </div>

                 <!-- Contact Card 3: Location -->
                <div class="col-md-4 px-5">
                    <div class="card h-100 border-0 shadow-sm">
                         <div class="card-body d-flex flex-center flex-column p-10">
                             <div class="d-flex flex-center w-60px h-60px rounded-circle bg-light-info mb-5">
                                <i class="fas fa-map-marker-alt fs-2x text-info"></i>
                            </div>
                            <h4 class="fs-4 text-gray-900 fw-bold mb-2">Lokasi Kantor IT</h4>
                            <div class="fw-semibold fs-6 text-gray-600 mb-2">Gedung Utama, Lantai 3</div>
                            <span class="text-info fw-bold fs-5">Ruang Server & IT</span>
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
