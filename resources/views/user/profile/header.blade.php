<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap">
            {{-- Avatar --}}
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ Auth::user()->avatar ?? asset('assets/media/avatars/blank.png') }}" alt="image" />
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                </div>
            </div>

            {{-- Info --}}
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ Auth::user()->name }}</a>
                            <a href="#">
                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                        </div>
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>{{ Auth::user()->position->name ?? 'Employee' }}
                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>{{ Auth::user()->email }}
                            </a>
                        </div>
                    </div>

                    <div class="d-flex my-4">
                        <button type="button" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#edit_profile_modal">
                            <i class="ki-duotone ki-pencil fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Edit Profile
                        </button>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="d-flex flex-wrap flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="d-flex flex-wrap">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-calendar fs-3 text-success me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="fs-2 fw-bold counted">22</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-500">Days Present</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-abstract-26 fs-3 text-danger me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="fs-2 fw-bold counted">8</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-500">Days Absent</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-chart-simple fs-3 text-primary me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    <div class="fs-2 fw-bold counted">23</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-500">Total Tasks</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Nav Tabs --}}
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs('user.profile.index') ? 'active' : '' }}" href="{{ route('user.profile.index') }}">Overview</a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs('user.profile.setting') ? 'active' : '' }}" href="{{ route('user.profile.setting') }}">Settings</a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs('user.profile.security') ? 'active' : '' }}" href="{{ route('user.profile.security') }}">Security</a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs('user.profile.task') ? 'active' : '' }}" href="{{ route('user.profile.task') }}">My Task</a>
            </li>
        </ul>
    </div>
</div>