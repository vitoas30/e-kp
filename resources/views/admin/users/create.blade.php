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
                        <h2>Add New User</h2>
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-10">
                            <label for="name" class="required form-label">Name</label>
                            <input type="text" class="form-control form-control-solid" name="name" id="name" placeholder="User Name" required/>
                        </div>
                        <div class="mb-10">
                            <label for="email" class="required form-label">Email</label>
                            <input type="email" class="form-control form-control-solid" name="email" id="email" placeholder="user@example.com" required/>
                        </div>
                        <div class="mb-10">
                            <label for="password" class="required form-label">Password</label>
                            <input type="password" class="form-control form-control-solid" name="password" id="password" required/>
                        </div>
                        <div class="mb-10">
                            <label for="password_confirmation" class="required form-label">Confirm Password</label>
                            <input type="password" class="form-control form-control-solid" name="password_confirmation" id="password_confirmation" required/>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
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
