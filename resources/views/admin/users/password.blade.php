@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Change Password</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.users.index')}}" class="text-muted text-hover-primary">List User</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Change Password</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            @if(session()->has('message'))
                <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row p-5 mb-10">
                    <i class="ki-duotone ki-information fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h5 class="mb-1">Error</h5>
                        <span>{{ session()->get('message') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-3 text-danger"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row p-5 mb-10">
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h5 class="mb-1">Success</h5>
                        <span>{{ session()->get('success') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-3 text-success"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif

            <div class="card mb-6 mb-xl-9">
                <form action="{{ route('admin.users.change.password.update', $user->id) }}" method="POST">
                    @csrf
                    
                    <div class="card-body pt-9 pb-0">
                        @include('admin.users.header')

                        <div class="row mb-7">
                            <label for="password" class="required form-label">New Password</label>
                            <input type="password" class="form-control" name="password" id="password" 
                                placeholder="***********" required />
                            <div id="password-error" class="invalid-feedback" style="display: none;"></div>
                            <div class="form-text mt-2">
                                <small id="password-requirements">
                                    Password harus:
                                    <ul class="mb-0 ps-3">
                                        <li id="req-length" class="text-muted">Minimal 8 karakter</li>
                                        <li id="req-uppercase" class="text-muted">Mengandung huruf besar (A-Z)</li>
                                        <li id="req-lowercase" class="text-muted">Mengandung huruf kecil (a-z)</li>
                                    </ul>
                                </small>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label for="password_confirmation" class="required form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" 
                                id="password_confirmation" placeholder="***********" required />
                            <div id="password-confirmation-error" class="invalid-feedback" style="display: none;"></div>
                        </div>
                    </div>

                    <div class="card-footer border-top p-9">
                        <div class="d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="ki-duotone ki-check fs-2"></i>
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('password-confirmation-error');
    const reqLength = document.getElementById('req-length');
    const reqUppercase = document.getElementById('req-uppercase');
    const reqLowercase = document.getElementById('req-lowercase');

    function validatePassword(password) {
        const errors = [];
        const requirements = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password)
        };

        // Update visual indicators
        updateRequirement(reqLength, requirements.length);
        updateRequirement(reqUppercase, requirements.uppercase);
        updateRequirement(reqLowercase, requirements.lowercase);

        // Collect error messages
        if (!requirements.length) {
            errors.push('minimal 8 karakter');
        }
        if (!requirements.uppercase) {
            errors.push('huruf besar');
        }
        if (!requirements.lowercase) {
            errors.push('huruf kecil');
        }

        return {
            valid: Object.values(requirements).every(r => r),
            errors: errors
        };
    }

    function validatePasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword.length === 0) {
            return { valid: true, message: '' };
        }
        
        if (password !== confirmPassword) {
            return { valid: false, message: 'Password tidak sama' };
        }
        
        return { valid: true, message: '' };
    }

    function updateRequirement(element, isValid) {
        if (isValid) {
            element.classList.remove('text-muted', 'text-danger');
            element.classList.add('text-success');
            if (!element.innerHTML.includes('✓')) {
                element.innerHTML = '✓ ' + element.innerHTML.replace('✓ ', '');
            }
        } else {
            element.classList.remove('text-muted', 'text-success');
            element.classList.add('text-danger');
            element.innerHTML = element.innerHTML.replace('✓ ', '');
        }
    }

    function showError(input, errorElement, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }

    function clearError(input, errorElement) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        errorElement.style.display = 'none';
    }

    function removeValidation(input, errorElement) {
        input.classList.remove('is-invalid', 'is-valid');
        errorElement.style.display = 'none';
    }

    // Validasi password saat user mengetik
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        if (password.length === 0) {
            removeValidation(passwordInput, passwordError);
            // Reset requirements display
            [reqLength, reqUppercase, reqLowercase].forEach(el => {
                el.classList.remove('text-success', 'text-danger');
                el.classList.add('text-muted');
                el.innerHTML = el.innerHTML.replace('✓ ', '');
            });
            return;
        }

        const validation = validatePassword(password);
        
        if (validation.valid) {
            clearError(passwordInput, passwordError);
        } else {
            showError(passwordInput, passwordError, 'Password harus memenuhi semua persyaratan');
        }

        // Re-validate confirmation if it has value
        if (confirmPasswordInput.value.length > 0) {
            const matchValidation = validatePasswordMatch();
            if (matchValidation.valid) {
                clearError(confirmPasswordInput, confirmPasswordError);
            } else {
                showError(confirmPasswordInput, confirmPasswordError, matchValidation.message);
            }
        }
    });

    // Validasi confirm password saat user mengetik
    confirmPasswordInput.addEventListener('input', function() {
        const confirmPassword = this.value;
        
        if (confirmPassword.length === 0) {
            removeValidation(confirmPasswordInput, confirmPasswordError);
            return;
        }

        const matchValidation = validatePasswordMatch();
        
        if (matchValidation.valid) {
            clearError(confirmPasswordInput, confirmPasswordError);
        } else {
            showError(confirmPasswordInput, confirmPasswordError, matchValidation.message);
        }
    });

    // Validasi saat form disubmit
    passwordInput.closest('form')?.addEventListener('submit', function(e) {
        const password = passwordInput.value;
        const validation = validatePassword(password);
        const matchValidation = validatePasswordMatch();
        
        let hasError = false;

        // Cek validasi password
        if (!validation.valid) {
            e.preventDefault();
            showError(passwordInput, passwordError, 'Password harus ' + validation.errors.join(', '));
            passwordInput.focus();
            hasError = true;
        }

        // Cek kecocokan password
        if (!matchValidation.valid) {
            e.preventDefault();
            showError(confirmPasswordInput, confirmPasswordError, matchValidation.message);
            if (!hasError) {
                confirmPasswordInput.focus();
            }
            hasError = true;
        }
    });
});
</script>
@endpush