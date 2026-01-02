@forelse($notifications as $notification)
    <!--begin::Item-->
    <div class="d-flex flex-stack py-4 {{ $notification->read_at ? '' : 'bg-light-primary rounded px-2' }}">
        <!--begin::Section-->
        <div class="d-flex align-items-center">
            <!--begin::Symbol-->
            <div class="symbol symbol-35px me-4">
                <span class="symbol-label bg-light-{{ $notification->data['type'] ?? 'primary' }}">
                    <i class="ki-duotone {{ $notification->data['icon'] ?? 'ki-abstract-28' }} fs-2 text-{{ $notification->data['type'] ?? 'primary' }}">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="mb-0 me-2">
                <a href="{{ route('user.notifications.read', $notification->id) }}" class="fs-6 text-gray-800 text-hover-primary {{ $notification->read_at ? '' : 'fw-bold' }}">{{ $notification->data['title'] ?? 'Notification' }}</a>
                <div class="text-gray-500 fs-7">{{ $notification->data['message'] ?? '' }}</div>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Section-->
        <!--begin::Label-->
        <span class="badge badge-light fs-8">{{ $notification->created_at->diffForHumans() }}</span>
        <!--end::Label-->
    </div>
    <!--end::Item-->
@empty
    <div class="d-flex flex-column px-9 py-4 text-center">
        <span class="text-gray-500 fs-6">No new notifications</span>
    </div>
@endforelse
