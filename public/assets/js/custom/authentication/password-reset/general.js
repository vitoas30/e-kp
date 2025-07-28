"use strict";

var KTPasswordResetGeneral = function () {
    var form, submitBtn, validator;

    return {
        init: function () {
            form = document.querySelector("#kt_password_reset_form");
            submitBtn = document.querySelector("#kt_password_reset_submit");

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
                                Swal.fire({
                                    text: "We have emailed your password reset link!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        form.querySelector('[name="email"]').value = "";
                                    }
                                });
                            })
                            .catch(function (error) {
                                let message = "An error occurred. Please try again.";

                                if (error.response && error.response.data && error.response.data.errors && error.response.data.errors.email) {
                                    message = error.response.data.errors.email[0];
                                } else if (error.response && error.response.data && error.response.data.message) {
                                    message = error.response.data.message;
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
                            })
                            .finally(function () {
                                // Always re-enable button
                                submitBtn.removeAttribute("data-kt-indicator");
                                submitBtn.disabled = false;
                            });
                    } else {
                        Swal.fire({
                            text: "Please enter a valid email address.",
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
    KTPasswordResetGeneral.init();
});
