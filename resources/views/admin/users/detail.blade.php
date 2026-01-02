@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Info Account</h1>
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
                    <li class="breadcrumb-item text-muted">Info Account</li>
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
                        <h5 class="mb-1">success</h5>

                        <span>{{ session()->get('success') }}</span>
                    </div>

                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-3 text-success"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif
            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    @include('admin.users.header')
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 mt-5">
                            <tr>
                                <td class="w-200px">Fullname</td>
                                <td>: {{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: {{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>: {{ $user->roles->pluck('name')->join(', ') == "admin" ? "Admin" : "User" }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>: {{$user->phone}}</td>
                            </tr>
                            <tr>
                                <td>Job Category</td>
                                <td>: {{$user->position?->category?->name}}</td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>: {{$user->position?->name}}</td>
                            </tr>
                            <tr>
                                <td>Salary</td>
                                <td>: Rp {{ number_format($user->salary, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: <span class="badge badge-light-{{ $user->status == 'active' ? 'success' : 'danger' }}">{{ $user->status == 'active' ? 'Active' : 'Inactive' }}</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateUser">Ubah Detail User</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateUser" data-bs-focus="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h2 class="fw-bold">Update Detail User</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body px-5 my-7">
                    <form id="kt_modal_new_target_form" class="form" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{ old('name', $user->name) }}" required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', $user->email) }}" required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label for="role" class="form-label fw-semibold required">Role</label>
                                @php
                                    $userRoles = $user->roles->pluck('name')->toArray();
                                @endphp
                                <select id="role" name="role" class="form-select" data-control="select2" data-placeholder="Pilih Role" data-allow-clear="true" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    <option value="admin" {{ in_array('admin', old('role') ? [old('role')] : $userRoles) ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ in_array('user', old('role') ? [old('role')] : $userRoles) ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label for="phone" class="required form-label">Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="ki-duotone ki-phone fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone', $user->phone) }}"/>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label for="position_id" class="form-label fw-semibold required">Position</label>
                                <select id="position_id" name="position_id" class="form-select" data-control="select2" data-placeholder="Pilih Position" data-allow-clear="true" required>
                                    <option value="" disabled></option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}" 
                                                {{ old('position_id', $user->position_id ?? null) == $position->id ? 'selected' : '' }}>
                                            {{ $position->category->name }} - {{ $position->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label for="position_id" class="form-label fw-semibold required">Salary</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input
                                        type="text"
                                        name="salary_display"
                                        id="salary_display"
                                        class="form-control"
                                        placeholder="Enter Salary"
                                        value="{{ old('salary') ? number_format((int) old('salary'), 0, ',', '.') : ($user->salary ? number_format((int) $user->salary, 0, ',', '.') : '') }}"
                                        required
                                    >
                                </div>
                                <input type="hidden" name="salary" id="salary" value="{{ old('salary', $user->salary ?? 0) }}">
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="required form-label">Status</label>
                                <div class="d-flex mt-2">
                                    <div class="form-check form-check-custom form-check-primary me-10">
                                        <input class="form-check-input" type="radio" name="status" value="active" 
                                                id="status_active" {{ old('status', $user->status ?? 'active') == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_active">Active</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-danger">
                                        <input class="form-check-input" type="radio" name="status" value="inactive" 
                                                id="status_inactive" {{ old('status', $user->status ?? 'inactive') == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-left pt-10">
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Wait... 
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
