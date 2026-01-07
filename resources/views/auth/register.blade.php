@extends('layouts.guest')

@section('content')
<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
	<form method="POST" action="{{ route('register') }}" class="form w-100" id="kt_sign_up_form">
		@csrf
		<div class="text-center mb-11">
			<h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
			<div class="text-gray-500 fw-semibold fs-6">Elektronik Kerja Perkantoran</div>
		</div>
		<div class="fv-row mb-8">
			<input type="text" placeholder="Full Name" name="name" :value="old('name')" required autofocus autocomplete="name" class="form-control bg-transparent" />
			<x-input-error :messages="$errors->get('name')" class="mt-2" />
		</div>
		<div class="fv-row mb-8">
			<input type="email" placeholder="Email" name="email" :value="old('email')" required autocomplete="username" class="form-control bg-transparent" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>
		<div class="fv-row mb-8" data-kt-password-meter="true">
			<div class="mb-1">
				<div class="position-relative mb-3">
					<input class="form-control bg-transparent" type="password" placeholder="Password" name="password" required autocomplete="new-password" />
					<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
						<i class="fas fa-eye-slash"></i>
						<i class="fas fa-eye d-none"></i>
					</span>
				</div>
				<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
					<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
					<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
					<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
					<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
				</div>
			</div>
			<div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<div class="fv-row mb-8">
			<div class="position-relative mb-3">
				<input placeholder="Repeat Password" name="password_confirmation" type="password" required autocomplete="new-password" class="form-control bg-transparent" />
			</div>
			<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
		</div>
		<div class="d-grid mb-10">
			<button type="submit" class="btn btn-primary">
				<span class="indicator-label">Sign up</span>
				<span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
			</button>
		</div>
		<div class="text-gray-500 text-center fw-semibold fs-6">
			Already have an Account? <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a>
		</div>
	</form>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>
@endpush
@endsection
