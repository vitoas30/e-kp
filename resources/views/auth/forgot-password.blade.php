@extends('layouts.guest')

@section('content')
<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
    <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="text-center mb-10">
            <h1 class="text-gray-900 fw-bolder mb-3">Forgot Password?</h1>
            <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="fv-row mb-8">
            <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/custom/authentication/password-reset/general.js') }}"></script>
@endpush
