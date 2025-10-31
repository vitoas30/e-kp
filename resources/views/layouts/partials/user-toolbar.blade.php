<div class="toolbar py-5 pb-lg-15" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-white fw-bold my-1 fs-3">
                @if(request()->routeIs('user.tasks.*'))
                    {{$project->name}} - Task
                @elseif (request()->routeIs('user.projects.*'))
                    Project
                @elseif (request()->routeIs('user.profile.*'))
                    My Profile
                @else
                    Dashboard
                @endif
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-white opacity-75">
                    <a href="{{ route('dashboard') }}" class="text-white text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-white opacity-75">
                    @if(request()->routeIs('user.tasks.*'))
                        Tasks
                    @elseif (request()->routeIs('user.projects.*'))
                        Project
                    @elseif (request()->routeIs('user.profile.*'))
                        My Profile
                    @else
                        Dashboards
                    @endif
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-white opacity-75">Default</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
</div>