@extends('layouts.user')

@section('content')
@include('user.profile.header')
{{-- Security Tab --}}
<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Change Password</h3>
        </div>
    </div>
    <div class="card-body border-top p-9">
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Current Password --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Current Password</label>
                <div class="col-lg-8">
                    <input type="password" name="current_password" class="form-control form-control-lg form-control-solid" placeholder="Current password" />
                </div>
            </div>

            {{-- New Password --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">New Password</label>
                <div class="col-lg-8">
                    <input type="password" name="new_password" class="form-control form-control-lg form-control-solid" placeholder="New password" />
                    <div class="form-text">Password must be at least 8 characters.</div>
                </div>
            </div>

            {{-- Confirm New Password --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Confirm Password</label>
                <div class="col-lg-8">
                    <input type="password" name="new_password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Confirm password" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Profile Modal (Quick Edit) --}}
<div class="modal fade" id="edit_profile_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Edit Profile</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            <div class="modal-body px-5 py-10">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10">
                        {{-- Full Name --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-solid" value="{{ Auth::user()->name }}" required />
                        </div>

                        {{-- Email --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" name="email" class="form-control form-control-solid" value="{{ Auth::user()->email }}" required />
                        </div>

                        {{-- Phone --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Phone</label>
                            <input type="tel" name="phone" class="form-control form-control-solid" value="{{ Auth::user()->phone }}" />
                        </div>
                    </div>

                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
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
$(document).ready(function() {
    @if(session('success'))
        Swal.fire({
            text: "{{ session('success') }}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { 
                confirmButton: "btn btn-primary" 
            }
        });
    @endif

    @if(session('error'))
        Swal.fire({
            text: "{{ session('error') }}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { 
                confirmButton: "btn btn-primary" 
            }
        });
    @endif
});
</script>
@endpush