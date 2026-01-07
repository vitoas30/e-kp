@extends('layouts.admin')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Update User
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.users.index') }}" class="text-muted text-hover-primary">List Users</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Update User</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card">
                <div class="card-header border-1 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Form Update User</h3>
                    </div>
                </div>
                <div class="card-body py-4">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="name" class="required form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" 
                                           placeholder="User Name" value="{{ old('name', $user->name) }}" required />
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="password" class="required form-label">Password</label>
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

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="role" class="form-label fw-semibold required">Role</label>
                                    <select id="role" name="role" class="form-select" required>
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="email" class="required form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" 
                                           placeholder="user@example.com" value="{{ old('email') }}" required />
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="password_confirmation" class="required form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" 
                                        id="password_confirmation" placeholder="***********" required />
                                    <div id="password-confirmation-error" class="invalid-feedback" style="display: none;"></div>
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="required form-label">Status</label>
                                    <div class="d-flex mt-2">
                                        <div class="form-check form-check-custom form-check-primary me-10">
                                            <input class="form-check-input" type="radio" name="status" value="1" 
                                                   id="status_active" {{ old('status', 1) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-danger">
                                            <input class="form-check-input" type="radio" name="status" value="2" 
                                                   id="status_inactive" {{ old('status') == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="separator separator-dotted border-default border-3 my-8"></div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="email" class="required form-label">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="ki-duotone ki-phone fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ old("phone") }}"/>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="position_id" class="form-label fw-semibold required">Position</label>
                                    <select id="position_id" name="position_id" class="form-select" required>
                                        <option value="" disabled selected>Pilih Position</option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                                {{ $position->category->name }} - {{ $position->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="employee_type_id" class="form-label fw-semibold required">Employee Type</label>
                                    <select id="employee_type_id" name="employee_type_id" class="form-select" required>
                                        <option value="" disabled selected>Pilih Employee Type</option>
                                        @foreach ($employeeTypes as $employeeType)
                                            <option value="{{ $employeeType->id }}" {{ old('employee_type_id') == $employeeType->id ? 'selected' : '' }}>
                                                {{ $employeeType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="salary" class="required form-label">Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" 
                                            name="salary_display" 
                                            id="salary_display" 
                                            class="form-control" 
                                            placeholder="Enter Salary" 
                                            value="{{ old('salary') ? number_format(old('salary'), 0, ',', '.') : '' }}" 
                                            required>
                                    </div>
                                    <input type="hidden" name="salary" id="salary" value="{{ old('salary') }}">
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="allowance_id" class="form-label fw-semibold required">Allowance</label>
                                    <select id="allowance_id" class="form-control form-select mb-2" data-control="select2" data-placeholder="Select allowance" name="allowance_id[]" multiple/>
                                        <option></option>
                                        @foreach ($allowances as $allowance)
                                            <option value="{{ $allowance->id }}" {{ old('allowance_id') == $allowance->id ? 'selected' : '' }}>
                                                {{ $allowance->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="required form-label">Status Employee</label>
                                    <div class="d-flex mt-2">
                                        <div class="form-check form-check-custom form-check-primary me-10">
                                            <input class="form-check-input" type="radio" name="is_active" value="1" 
                                                   id="is_active" {{ old('is_active', 1) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-danger">
                                            <input class="form-check-input" type="radio" name="is_active" value="2" 
                                                   id="is_inactive" {{ old('is_active') == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
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
<script>
    $(document).ready(function() {
        if ($('#role').length) {
            $('#role').select2({
                placeholder: 'Pilih Role',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#kt_content_container'), // ✅ perbaikan: sebelumnya pakai modal yang tidak ada
                language: {
                    noResults: function() {
                        return "Tidak ditemukan";
                    }
                }
            });
        }

        if ($('#position_id').length) {
            $('#position_id').select2({
                placeholder: 'Pilih Position',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#kt_content_container'), // sesuaikan jika di dalam modal
                language: {
                    noResults: function() {
                        return "Tidak ditemukan";
                    }
                }
            });
        }
        
        if ($('#employee_type_id').length) {
            $('#employee_type_id').select2({
                placeholder: 'Pilih Employee Type',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#kt_content_container'), // sesuaikan jika di dalam modal
                language: {
                    noResults: function() {
                        return "Tidak ditemukan";
                    }
                }
            });
        }
        // ✅ perbaikan: sebelumnya tertulis $.document.ready (salah)
        
        function formatRupiah(angka) {
            if (!angka) return '';
            var number_string = angka.replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        function parseRupiah(rupiah) {
            if (!rupiah) return 0;
            return parseInt(rupiah.replace(/\./g, '').replace(/,/g, '')) || 0;
        }

        // Format saat mengetik
        $('#salary_display').on('input', function() {
            let value = $(this).val();
            let formatted = formatRupiah(value);
            $(this).val(formatted);
            $('#salary').val(parseRupiah(formatted));
        });

        // Format ulang saat blur
        $('#salary_display').on('blur', function() {
            let value = $(this).val();
            let formatted = formatRupiah(value);
            $(this).val(formatted);
            $('#salary').val(parseRupiah(formatted));
        });

        // Tangani event paste
        $('#salary_display').on('paste', function() {
            setTimeout(() => {
                let value = $(this).val();
                let formatted = formatRupiah(value);
                $(this).val(formatted);
                $('#salary').val(parseRupiah(formatted));
            }, 10);
        });

        // Cegah karakter non-angka
        $('#salary_display').on('keypress', function(e) {
            const charCode = e.which ? e.which : e.keyCode;
            // Hanya izinkan angka (0–9)
            if (charCode < 48 || charCode > 57) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
