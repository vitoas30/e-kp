<div class="card mb-6">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ Auth::user()->photo ? url('/uploads/user/profile/' . Auth::user()->photo) : url('assets/img/user.png') }}" class="img-fluid object-center object-fit-cover rounded-pill" alt="" style="max-width: 200px"/>
                </div>
            </div>
            <div class="flex-grow-1">
                <h3 class="fw-semibold">{{$user->name}}</h3>
                <h6 class="text-body-secondary fw-semibold">{{$user->position->name}}</h6>
                <div class="d-flex gap-3 mt-3 flex-wrap">
                    <div class="d-flex justify-content-center align-middle content-center gap-2 text-secondary">
                        <i class="ki-solid ki-pin"></i>
                        <h6 class="fw-semibold">
                            {{$user->employeeType->name}}
                        </h6>
                    </div>
                    <div class="d-flex justify-content-center align-middle content-center gap-2 text-secondary">
                        <i class="far fa-envelope"></i>
                        <h6 class="fw-semibold">{{$user->email}}</h6>
                    </div>
                </div>
                <div class="d-flex flex-wrap fw-semibold fs-8 mb-4 pe-2">
                    <div class="d-flex flex-column">
                        <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                            Start Date {{$user->employeeType->name}}
                        </a>
                        <a href="#" class="d-flex align-items-center text-success text-hover-primary me-5 mb-2">
                            {{$user->latestContract->start_date != null ? date('d F Y', strtotime($user->latestContract->start_date)) : ''}}
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                            End Date {{$user->employeeType->name}}
                        </a>
                        <a href="#" class="d-flex align-items-center text-success text-hover-primary me-5 mb-2">
                            {{$user->latestContract->end_date != null ? date('d F Y', strtotime($user->latestContract->end_date)) : ''}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="separator"></div>
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.users.show', $user->id) ? 'active' : '' }}" href="{{ route('admin.users.show', $user->id) }}">Detail User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.users.employee', $user->id) ? 'active' : '' }}" href="{{ route('admin.users.employee', $user->id) }}">Info Employee</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.users.allowance', $user->id) ? 'active' : '' }}" href="{{ route('admin.users.allowance', $user->id) }}">Info Allowance</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6" href="#">Change Password</a>
    </li>
</ul>