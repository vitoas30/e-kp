@extends('layouts.user')

@section('content')
{{-- Profile Header --}}
@include('user.profile.header')
    
<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Profile Settings</h3>
        </div>
    </div>
    <div class="card-body border-top p-9">
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Avatar --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                <div class="col-lg-8">
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset('assets/media/avatars/blank.png') }}')">
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ Auth::user()->avatar ?? asset('assets/media/avatars/blank.png') }}')"></div>
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                            <i class="ki-duotone ki-pencil fs-7">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                            <i class="ki-duotone ki-cross fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                </div>
            </div>

            {{-- Full Name --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                <div class="col-lg-8">
                    <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Full name" value="{{ Auth::user()->name }}" />
                </div>
            </div>

            {{-- Email --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                <div class="col-lg-8">
                    <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{ Auth::user()->email }}" />
                </div>
            </div>

            {{-- Phone --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Phone</label>
                <div class="col-lg-8">
                    <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{ Auth::user()->phone }}" />
                </div>
            </div>

            {{-- Position --}}
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Position</label>
                <div class="col-lg-8">
                    <input type="text" name="position" class="form-control form-control-lg form-control-solid" placeholder="Position" value="{{ Auth::user()->position?->name }}" readonly />
                </div>
            </div>

            {{-- Actions --}}
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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