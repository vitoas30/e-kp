@extends('layouts.admin')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Edit User</h2>
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-10">
                            <label for="name" class="required form-label">Name</label>
                            <input type="text" class="form-control form-control-solid" name="name" id="name" value="{{ $user->name }}" required/>
                        </div>
                        <div class="mb-10">
                            <label for="email" class="required form-label">Email</label>
                            <input type="email" class="form-control form-control-solid" name="email" id="email" value="{{ $user->email }}" required/>
                        </div>
                        <div class="mb-10">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-solid" name="password" id="password" />
                            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                        </div>
                        <div class="mb-10">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control form-control-solid" name="password_confirmation" id="password_confirmation" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
                            </button>
                        </div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
@endsection
