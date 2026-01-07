<div class="card-header border-0 pt-6">
    {{-- Tabs Navigation --}}
    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
        <li class="nav-item">
            <a class="nav-link text-active-primary {{ request()->routeIs('user.tasks.index', $project->id) ? 'active' : '' }}" href="{{ route('user.tasks.index', $project->id) }}">
                <i class="ki-duotone ki-abstract-41 fs-2 me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                All Tasks
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary {{ request()->routeIs('user.tasks.my-task', $project->id) ? 'active' : '' }}" href="{{ route('user.tasks.my-task', $project->id) }}">
                <i class="ki-duotone ki-user fs-2 me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                My Tasks
            </a>
        </li>
    </ul>
</div>