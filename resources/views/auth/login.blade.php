@extends('layouts.guest') {{-- Atau sesuaikan dengan layout yang kamu pakai --}}

@section('content')
<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}">
        @csrf

        <div class="text-center mb-11">
            <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
            <div class="text-gray-500 fw-semibold fs-6">Elektronik Kerja Perkantoran</div>
        </div>
        <div class="fv-row mb-8">
            <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="fv-row mb-3" data-kt-password-meter="true">
            <div class="position-relative mb-3">
                <input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" required>
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                    <i class="fas fa-eye-slash"></i>
                    <i class="fas fa-eye d-none"></i>
                </span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-primary">Forgot Password?</a>
            @endif
        </div>

        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary" id="kt_sign_in_submit">
                <span class="indicator-label">Sign In</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>

        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet? 
            <a href="{{ route('register') }}" class="link-primary">Sign up</a>
        </div>
    </form>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
@endpush
@endsection
