<div id="kt_header" class="header align-items-stretch mb-5 mb-lg-10" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <div class="container-xxl d-flex align-items-center">
        <div class="d-flex topbar align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
            <a href="{{ url('/') }}">
                <img alt="Logo" src="{{ asset('assets/media/logos/ekp-white.png') }}" class="logo-default h-70px" />
                <img alt="Logo" src="{{ asset('assets/media/logos/ekp-sidebar.png') }}" class="logo-sticky h-70px" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold my-5 my-lg-0 align-items-stretch px-2 px-lg-0" id="#kt_header_menu" data-kt-menu="true">
                        
                        <!--begin::Home Menu-->
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                            <a href="{{ url('/') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-home fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Home</span>
                            </a>
                        </div>
                        <!--end::Home Menu-->

                        <!--begin::Dashboard Menu-->
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('dashboard') ? 'here show menu-here-bg' : '' }} menu-lg-down-accordion me-0 me-lg-2">
                            <a href="{{ route('dashboard') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>
                        <!--end::Dashboard Menu-->

                        <!--begin::Project Menu-->
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('user.projects.*') || request()->routeIs('user.tasks.*') ? 'here show menu-here-bg' : '' }} menu-lg-down-accordion me-0 me-lg-2">
                            <a href="{{ route('user.projects.index') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-notepad fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Project</span>
                            </a>
                        </div>
                        <!--end::Project Menu-->

                        <!--begin::Inventory Menu-->
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('user.inventory.*') ? 'here show menu-here-bg' : '' }} menu-lg-down-accordion me-0 me-lg-2">
                            <a href="{{ route('user.inventory.index') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-briefcase fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Inventory</span>
                            </a>
                        </div>
                        <!--end::Inventory Menu-->
                        
                        <!--begin::Dashboard Menu-->
                        {{-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('user.tasks.index') ? 'here show menu-here-bg' : '' }} menu-lg-down-accordion me-0 me-lg-2">
                            <a href="{{ route('user.tasks.index') }}" class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Task</span>
                            </a>
                        </div> --}}
                        <!--end::Dashboard Menu-->

                        <!--begin::Task Menu-->
                        {{-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('task*') ? 'here show menu-here-bg' : '' }} menu-lg-down-accordion me-0 me-lg-2">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-notepad fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Task</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px"> --}}
                                <!--begin::Menu item-->
                                {{-- <div class="menu-item">
                                    <a class="menu-link py-3" href="{{ route('task.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">All Tasks</span>
                                    </a>
                                </div> --}}
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                {{-- <div class="menu-item">
                                    <a class="menu-link py-3" href="{{ route('task.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Create Task</span>
                                    </a>
                                </div> --}}
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                {{-- <div class="menu-item">
                                    <a class="menu-link py-3" href="{{ route('task.my-tasks') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">My Tasks</span>
                                    </a>
                                </div> --}}
                                <!--end::Menu item-->
                            {{-- </div>
                        </div> --}}
                        <!--end::Task Menu-->

                    </div>
                </div>
            </div>
        </div>
        <div class="topbar d-flex align-items-stretch flex-shrink-0">
            <div class="d-flex align-items-stretch ms-1 ms-lg-3">
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <!--begin::Menu- wrapper-->
                    <div id="kt_notification_button" class="position-relative btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-notification fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-danger w-15px h-15px ms-n4 mt-3 notification-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{ asset('assets/media/misc/menu-header-bg.jpg') }}')">
                            <!--begin::Title-->
                            <h3 class="text-white fw-semibold px-9 mt-10 mb-6">Notifications 
                            <span class="fs-8 opacity-75 ps-3">{{ auth()->user()->unreadNotifications->count() }} new</span></h3>
                            <!--end::Title-->
                            <!--begin::Tabs-->
                            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
                                <li class="nav-item">
                                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_1">Alerts</a>
                                </li>
                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab panel-->
                            <div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
                                <!--begin::Items-->
                                <div class="scroll-y mh-325px my-5 px-8" id="kt_notification_list">
                                    @include('user.partials.notification-list', ['notifications' => auth()->user()->notifications()->latest()->limit(20)->get()])
                                </div>
                                <!--end::Items-->
                                <div class="py-3 text-center border-top">
                                    <form action="{{ route('user.notifications.markAsRead') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-color-gray-600 btn-active-color-primary">
                                            Mark all as read <i class="ki-duotone ki-arrow-right fs-5"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab content-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                {{-- <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <!--begin::Menu toggle-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-moon fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-screen fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div> --}}
                <div class="d-flex align-items-center me-lg-n2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img class="h-30px w-30px rounded" src="{{ asset('assets/media/avatars/300-2.jpg')}}" alt="" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('assets/media/avatars/300-2.jpg')}}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ Auth::user()->name }} 
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="{{ route('user.profile.index') }}" class="menu-link px-5">My Profile</a>
                        </div>
                        
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign Out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Alert Container -->
<div id="kt_notification_alerts" class="position-fixed top-0 end-0 p-3 z-index-9999" style="z-index: 9999; max-width: 400px; width: 100%;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let lastNotificationId = null; 
        let isFirstLoad = true;
        const alertContainerId = 'kt_notification_alerts_dynamic';

        // Function to check notifications
        function checkNotifications() {
            fetch('{{ route("user.notifications.check") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update Title Count
                const titleCount = document.querySelector('#kt_menu_notifications .card-title span, #kt_menu_notifications h3 span');
                if(titleCount) titleCount.innerText = data.count + ' new';
                
                // Handle Badge (Number)
                const badgeContainer = document.getElementById('kt_notification_button');
                if (badgeContainer) {
                    let badge = badgeContainer.querySelector('.notification-badge');
                    
                    if (data.count > 0) {
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'position-absolute top-0 start-100 translate-middle badge badge-circle badge-danger w-15px h-15px ms-n4 mt-3 notification-badge';
                            badgeContainer.appendChild(badge);
                        }
                        badge.innerText = data.count;
                    } else {
                        if (badge) badge.remove();
                    }
                }

                // Handle List Update
                const listContainer = document.getElementById('kt_notification_list');
                if(listContainer && listContainer.innerHTML.trim() != data.html.trim()) {
                     listContainer.innerHTML = data.html;
                }

                // Handle Custom Alert Notification Logic
                const currentId = data.latest_id;

                if (isFirstLoad) {
                    // Initial sync only, no alert
                    lastNotificationId = currentId;
                    isFirstLoad = false;
                } else {
                    // Check if we have a NEW valid ID that differs from the last tracked one
                    // This handles null -> 5 (0 to 1) and 5 -> 6 (1 to 2)
                    if (currentId && currentId != lastNotificationId) {
                        lastNotificationId = currentId;
                        showCustomAlert(data);
                    }
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
        }

        function showCustomAlert(data) {
            // Ensure container exists on BODY to avoid z-index/overflow issues
            let container = document.getElementById(alertContainerId);
            if (!container) {
                container = document.createElement('div');
                container.id = alertContainerId;
                container.className = 'position-fixed top-0 end-0 p-3';
                container.style.zIndex = '10099';
                container.style.maxWidth = '400px';
                container.style.width = '100%';
                document.body.appendChild(container); // Append to BODY
            }
            
            // Map type to functionality/colors
            let color = 'primary'; // Default purple-ish
            let icon = 'ki-notification-bing';
            
            // Metronic 8 uses ki-duotone. Some icons have 2 paths, some 3. Safe to include 3.
            if (data.latest_type === 'success') { color = 'success'; icon = 'ki-check-circle'; }
            else if (data.latest_type === 'warning') { color = 'warning'; icon = 'ki-information-5'; }
            else if (data.latest_type === 'danger') { color = 'danger'; icon = 'ki-cross-circle'; }
            else if (data.latest_type === 'info') { color = 'info'; icon = 'ki-information-2'; }

            // Create Alert Element
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-dismissible bg-white border border-${color} border-dashed d-flex flex-column flex-sm-row p-5 mb-5 shadow-sm`;
            alertDiv.style.cursor = 'pointer';
            alertDiv.style.animation = 'fadeIn 0.5s';
            
            // Redirect URL
            var url = "{{ route('user.notifications.read', ':id') }}";
            url = url.replace(':id', data.latest_id);
            
            alertDiv.innerHTML = `
                <!--Icon-->
                <div class="d-flex align-items-center mb-5 mb-sm-0">
                     <i class="ki-duotone ${icon} fs-2hx text-${color} me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                </div>
                <!--Content-->
                <div class="d-flex flex-column pe-0 pe-sm-10 w-100">
                    <h5 class="mb-1 text-gray-900">${data.latest_title}</h5>
                    <span class="text-gray-600 fs-7">${data.latest_message}</span>
                </div>
                <!--Close-->
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" onclick="this.parentElement.remove(); event.stopPropagation();">
                    <i class="ki-duotone ki-cross fs-1 text-${color}"><span class="path1"></span><span class="path2"></span></i>
                </button>
            `;

            // Click event to redirect
            alertDiv.addEventListener('click', function(e) {
                // Don't redirect if close button clicked
                if (!e.target.closest('button')) {
                    window.location.href = url;
                }
            });

            // Append to container
            container.appendChild(alertDiv);

            // Auto dismiss after 10 seconds
            setTimeout(() => {
                if(alertDiv) {
                    alertDiv.style.opacity = '0';
                    alertDiv.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => alertDiv.remove(), 500);
                }
            }, 10000);
        }

        // Poll every 3 seconds
        setInterval(checkNotifications, 3000);
        // Run once on load to set initial state
        checkNotifications();
    });
</script>