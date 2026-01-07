"use strict";

var KTSignupGeneral = function () {
    var form, submitBtn, validator, passwordMeter, passwordMain;

    var handleForm = function () {
        validator = FormValidation.formValidation(form, {
            fields: {
                'name': {
                    validators: {
                        notEmpty: {
                            message: 'Nama lengkap wajib diisi'
                        }
                    }
                },
                'email': {
                    validators: {
                        notEmpty: {
                            message: 'Alamat email wajib diisi'
                        },
                        emailAddress: {
                            message: 'Alamat email tidak valid'
                        }
                    }
                },
                'password': {
                    validators: {
                        notEmpty: {
                            message: 'Password wajib diisi'
                        },
                        stringLength: {
                            min: 8,
                            message: 'Password minimal harus 8 karakter'
                        },
                        callback: {
                            message: 'Silakan masukkan password yang valid',
                            callback: function (input) {
                                if (input.value.length > 0) {
                                    return passwordMeter.getScore() > 50;
                                }
                                return true;
                            }
                        }
                    }
                },
                'password_confirmation': {
                    validators: {
                        notEmpty: {
                            message: 'Konfirmasi password wajib diisi'
                        },
                        identical: {
                            compare: function () {
                                return form.querySelector('[name="password"]').value;
                            },
                            message: 'Password dan konfirmasinya tidak sama'
                        }
                    }
                },
                'toc': {
                    validators: {
                        notEmpty: {
                            message: 'Anda harus menyetujui Syarat dan Ketentuan'
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger({
                    event: {
                        password: false
                    }
                }),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row',
                    eleInvalidClass: '',
                    eleValidClass: ''
                })
            }
        });

        submitBtn.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.disabled = true;

                    axios.post(form.getAttribute("action"), new FormData(form))
                        .then(function (response) {
                            form.reset();
                            passwordMeter.reset();
                            
                            Swal.fire({
                                text: "Registrasi berhasil! Silakan cek email Anda untuk verifikasi.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, mengerti!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                    if (redirectUrl) {
                                        location.href = redirectUrl;
                                    }
                                }
                            });
                        })
                        .catch(function (error) {
                            let message = "Maaf, terjadi kesalahan. Silakan coba lagi.";
                            if (error.response && error.response.data.errors) {
                                const errors = error.response.data.errors;
                                if(errors.email) {
                                    message = errors.email[0];
                                } else if (errors.name) {
                                    message = errors.name[0];
                                } else if (errors.password) {
                                    message = errors.password[0];
                                }
                            }
                            Swal.fire({
                                text: message,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, mengerti!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        })
                        .then(function () {
                            submitBtn.removeAttribute('data-kt-indicator');
                            submitBtn.disabled = false;
                        });
                } else {
                    Swal.fire({
                        text: "Maaf, sepertinya ada beberapa data yang salah, silakan coba lagi.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

        passwordMain = form.querySelector('[name="password"]');
        passwordMain.addEventListener('input', function () {
            if (this.value.length > 0) {
                validator.updateFieldStatus('password', 'NotValidated');
            }
            // Revalidate the confirmation field when the main password changes
            if (form.querySelector('[name="password_confirmation"]').value.length > 0) {
                validator.revalidateField('password_confirmation');
            }
        });

        var confirmPassword = form.querySelector('[name="password_confirmation"]');
        confirmPassword.addEventListener('input', function() {
            if (this.value.length > 0) {
                validator.revalidateField('password_confirmation');
            }
        });

        // Handle toggle for confirm password
        const toggleConfirmPassword = document.querySelector('#kt_toggle_password_confirmation');
        if (toggleConfirmPassword) {
            toggleConfirmPassword.addEventListener('click', function (e) {
                const icon = this.querySelector('i');
                if (confirmPassword.getAttribute('type') === 'password') {
                    confirmPassword.setAttribute('type', 'text');
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    confirmPassword.setAttribute('type', 'password');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        }
    }

    return {
        init: function () {
            form = document.querySelector('#kt_sign_up_form');
            submitBtn = document.querySelector('#kt_sign_up_submit');
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

            if (!form || !submitBtn || !passwordMeter) {
                return;
            }

            handleForm();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
