@extends('layouts.user')

@section('content')
{{-- Profile Header --}}
@include('user.profile.header')

    <div class="row gy-5 g-xl-8">
        {{-- Personal Information --}}
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Personal Information</span>
                        <span class="text-muted fw-semibold fs-7">Your personal details</span>
                    </h3>
                </div>
                <div class="card-body pt-5">
                    <div class="mb-7">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fw-bold text-gray-600 fs-6 me-3" style="min-width: 130px;">Full Name</span>
                            <span class="text-gray-800 fs-6">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fw-bold text-gray-600 fs-6 me-3" style="min-width: 130px;">Email</span>
                            <span class="text-gray-800 fs-6">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fw-bold text-gray-600 fs-6 me-3" style="min-width: 130px;">Phone</span>
                            <span class="text-gray-800 fs-6">{{ Auth::user()->phone ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fw-bold text-gray-600 fs-6 me-3" style="min-width: 130px;">Job Category</span>
                            <span class="text-gray-800 fs-6">{{ Auth::user()->position->category->name ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fw-bold text-gray-600 fs-6 me-3" style="min-width: 130px;">Position</span>
                            <span class="badge badge-light-primary fs-7">{{ Auth::user()->position->name ?? 'Employee' }}</span>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fw-bold text-gray-600 fs-6 me-3" style="min-width: 130px;">Join Date</span>
                            <span class="text-gray-800 fs-6">{{ Auth::user()->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Employee Statistics --}}
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-xl-8 bg-body">
                <div class="card-body p-0">
                    <div class="card-rounded-top position-relative overflow-hidden" 
                            style="height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="position-relative z-index-2 px-9 pt-7">
                            <h3 class="fw-bold fs-2x mb-2 text-white">Monthly Statistics</h3>
                            <span class="text-white text-opacity-75 fw-semibold fs-7">October 2025</span>
                        </div>
                        <div class="position-absolute" style="top: -30px; right: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                    </div>
                    <div class="px-9 mt-n12 position-relative z-index-1">
                        <div class="row g-4 mb-7">
                            <div class="col-6">
                                <div class="bg-body shadow-sm px-6 py-6 rounded-3 border border-gray-300 border-opacity-50">
                                    <div class="symbol symbol-40px mb-3">
                                        <span class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-check-circle fs-2x text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <span class="text-gray-900 fw-bold fs-2 d-block">22</span>
                                    <span class="text-gray-600 fw-semibold fs-7">Days Present</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-body shadow-sm px-6 py-6 rounded-3 border border-gray-300 border-opacity-50">
                                    <div class="symbol symbol-40px mb-3">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="ki-duotone ki-cross-circle fs-2x text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <span class="text-gray-900 fw-bold fs-2 d-block">8</span>
                                    <span class="text-gray-600 fw-semibold fs-7">Days Absent</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-body shadow-sm px-6 py-6 rounded-3 border border-gray-300 border-opacity-50">
                                    <div class="symbol symbol-40px mb-3">
                                        <span class="symbol-label bg-light-warning">
                                            <i class="ki-duotone ki-clock fs-2x text-warning">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <span class="text-gray-900 fw-bold fs-2 d-block">24h</span>
                                    <span class="text-gray-600 fw-semibold fs-7">Overtime</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-body shadow-sm px-6 py-6 rounded-3 border border-gray-300 border-opacity-50">
                                    <div class="symbol symbol-40px mb-3">
                                        <span class="symbol-label bg-light-info">
                                            <i class="ki-duotone ki-calendar fs-2x text-info">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <span class="text-gray-900 fw-bold fs-2 d-block">5</span>
                                    <span class="text-gray-600 fw-semibold fs-7">Leave Requests</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Today's Attendance --}}
        <div class="col-xl-12">
            <div class="card mb-5 mb-xl-8 bg-body">
                <div class="card-header border-0 py-5" style="background: linear-gradient(135deg, #f43f5e 0%, #dc2626 100%);">
                    <h3 class="card-title align-items-start flex-column mb-0">
                        <span class="card-label fw-bold fs-3 text-white">Today's Attendance</span>
                        <span class="text-white text-opacity-75 fw-semibold fs-8 mt-1">{{ now()->format('l, d F Y') }}</span>
                    </h3>
                </div>
                <div class="card-body py-6">
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-4 bg-light-success rounded-3 border border-success border-opacity-25">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-success bg-opacity-10">
                                        <i class="ki-duotone ki-entrance-right fs-2x text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-gray-700 fw-semibold fs-7 d-block">Check In</span>
                                    <span class="text-success fw-bold fs-2 d-block">09:58:02</span>
                                    <span class="badge badge-light-danger fs-9 fw-semibold">Late 1h 28m</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-4 bg-light-warning rounded-3 border border-warning border-opacity-25">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-warning bg-opacity-10">
                                        <i class="ki-duotone ki-entrance-left fs-2x text-warning">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-gray-700 fw-semibold fs-7 d-block">Check Out</span>
                                    <span class="text-warning fw-bold fs-2 d-block">Not checked out</span>
                                    <span class="text-gray-600 fs-9 fw-semibold">Waiting...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center p-4 bg-light-primary rounded-3 border border-primary border-opacity-25">
                        <i class="ki-duotone ki-geolocation fs-2x text-primary me-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div>
                            <span class="text-gray-700 fw-semibold fs-7 d-block">Location</span>
                            <span class="text-gray-900 fw-bold fs-5">DQ Metro Office</span>
                        </div>
                    </div>
                </div>
            </div>
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