<div class="col-md-6 col-xl-4 project-card" data-status="{{ $project->status }}">
    <div class="card border-hover-dark shadow h-100">
        <div class="card-header border-0 pt-9">
            <div class="card-title m-0">
                <div class="symbol symbol-50px w-50px bg-light">
                    <span class="symbol-label bg-light-primary text-primary fw-bold">
                        {{ strtoupper(substr($project->name, 0, 1)) }}
                    </span>
                </div>
            </div>
            <div class="card-toolbar">
                @php
                    $statusColors = [
                        'planning' => 'warning',
                        'in_progress' => 'primary',
                        'on_hold' => 'danger',
                        'completed' => 'success',
                        'cancelled' => 'danger'
                    ];
                    $color = $statusColors[$project->status] ?? 'secondary';
                    $isManager = $project->manager_id == auth()->id();
                    $canUpdateStatus = $allowEdit || $isManager;
                @endphp

                @if($canUpdateStatus)
                    <div class="dropdown">
                        <button class="btn btn-sm badge badge-light-{{ $color }} fw-bold px-4 py-3 dropdown-toggle" 
                                type="button" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                            {{ ucwords(str_replace('_', ' ', $project->status)) }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item status-change" href="javascript:void(0)" data-url="{{ route('user.projects.update-status', $project->id) }}" data-status="planning">Planning</a></li>
                            <li><a class="dropdown-item status-change" href="javascript:void(0)" data-url="{{ route('user.projects.update-status', $project->id) }}" data-status="in_progress">In Progress</a></li>
                            <li><a class="dropdown-item status-change" href="javascript:void(0)" data-url="{{ route('user.projects.update-status', $project->id) }}" data-status="on_hold">On Hold</a></li>
                            <li><a class="dropdown-item status-change" href="javascript:void(0)" data-url="{{ route('user.projects.update-status', $project->id) }}" data-status="completed">Completed</a></li>
                            <li><a class="dropdown-item status-change" href="javascript:void(0)" data-url="{{ route('user.projects.update-status', $project->id) }}" data-status="cancelled">Cancelled</a></li>
                        </ul>
                    </div>
                @else
                     <span class="badge badge-light-{{ $color }} fw-bold me-auto px-4 py-3">
                        {{ ucwords(str_replace('_', ' ', $project->status)) }}
                    </span>
                @endif
            </div>
        </div>
        <div class="card-body p-9">
            <div class="fs-3 fw-bold text-gray-900">{{ $project->name }}</div>
            <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7">{{ $project->code }}</p>
            
            <div class="d-flex flex-wrap mb-5">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                    <div class="fs-6 text-gray-800 fw-bold">
                        {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-' }}
                    </div>
                    <div class="fw-semibold text-gray-500">Due Date</div>
                </div>
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                    <div class="fs-6 text-gray-800 fw-bold">{{ $project->manager->name ?? '-' }}</div>
                    <div class="fw-semibold text-gray-500">Leader</div>
                </div>
            </div>

            <div class="mb-5">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-semibold text-gray-700">Progress</span>
                    <span class="fw-bold text-gray-800">{{ $project->progress ?? 0 }}%</span>
                </div>
                <div class="h-10px w-100 bg-light rounded">
                    <div class="bg-primary rounded h-10px" role="progressbar" style="width: {{ $project->progress ?? 0 }}%;"></div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('user.tasks.my-task', $project->id) }}" class="btn btn-sm btn-light-primary flex-grow-1">
                    <i class="ki-duotone ki-eye fs-5 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    View Tasks
                </a>
                
                @if($allowEdit)
                <button type="button" class="btn btn-sm btn-light-warning" data-bs-toggle="modal" data-bs-target="#editProjectModal{{ $project->id }}">
                    <i class="ki-duotone ki-pencil fs-5"><span class="path1"></span><span class="path2"></span></i>
                </button>
                <form action="{{ route('user.projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this project?');">
                    @csrf
                    @method('GET') 
                    {{-- Note: Controller uses GET for destroy per previous code, though standard is DELETE. I kept it as per old route def if inconsistent, bu actually routes/web.php defines GET destroy. I should fix this to DELETE ideally but keeping GET for safety with existing routes. Correct, web.php has: Route::get('/{id}', [App\Http\Controllers\User\ProjectController::class, 'destroy'])->name('destroy'); 
                    Wait, let me double check routes/web.php 
                    Step 411: Route::get('/{id}', [App\Http\Controllers\User\ProjectController::class, 'destroy'])->name('destroy');
                    So GET is correct for current route definition. --}}
                    <button type="submit" class="btn btn-sm btn-light-danger">
                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
