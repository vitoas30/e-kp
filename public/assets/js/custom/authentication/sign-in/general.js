"use strict";

var KTSigninGeneral = function () {
    var form, submitBtn, validator;

    return {
        init: function () {
            form = document.querySelector("#kt_sign_in_form");
            submitBtn = document.querySelector("#kt_sign_in_submit");

            if (!form || !submitBtn) {
                return;
            }

            validator = FormValidation.formValidation(form, {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Email address is required"
                            },
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "The value is not a valid email address"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row"
                    })
                }
            });

            submitBtn.addEventListener("click", function (e) {
                e.preventDefault();

                validator.validate().then(function (status) {
                    if (status === "Valid") {
                        submitBtn.setAttribute("data-kt-indicator", "on");
                        submitBtn.disabled = true;

                        axios.post(form.getAttribute("action"), new FormData(form))
                            .then(function (response) {
                                // This block only runs for successful HTTP status codes (e.g., 200)
                                Swal.fire({
                                    text: "Login berhasil!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        window.location.href = form.getAttribute("data-kt-redirect-url");
                                    } else {
                                        // If user dismisses the modal without confirming, re-enable the button
                                        submitBtn.removeAttribute("data-kt-indicator");
                                        submitBtn.disabled = false;
                                    }
                                });
                            })
                            .catch(function (error) {
                                // This block runs for network errors or non-2xx HTTP status codes
                                let message = "Login gagal. Silakan periksa kembali email dan password Anda.";

                                if (error.response) {
                                    // Use the specific message from the backend if available
                                    if (error.response.data?.message) {
                                        message = error.response.data.message;
                                    }
                                    // Handle validation errors specifically
                                    else if (error.response.status === 422) {
                                        const errors = error.response.data.errors;
                                        if (errors?.email) {
                                            message = errors.email[0];
                                        } else if (errors?.password) {
                                            message = errors.password[0];
                                        }
                                    }
                                }

                                Swal.fire({
                                    text: message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                
                                // Re-enable button after showing error
                                submitBtn.removeAttribute("data-kt-indicator");
                                submitBtn.disabled = false;
                            });
                    } else {
                        Swal.fire({
                            text: "Ada kesalahan validasi form. Silakan isi data dengan benar.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
