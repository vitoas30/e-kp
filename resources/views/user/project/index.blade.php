@extends('layouts.user')

@section('content')
{{-- Statistics Cards --}}
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C; background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalProject ?? 0 }}</span>
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Project</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                        <span>Progress</span>
                        <span>{{ number_format($averageProgress) ?? 0 }}%</span>
                    </div>
                    <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-8px" role="progressbar" style="width: {{ number_format($averageProgress) ?? 0 }}%;" aria-valuenow="{{ number_format($averageProgress) ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Completed Tasks --}}
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card card-flush h-xl-100" style="background-color: #50CD89">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $completedTasks ?? 0 }}</span>
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Completed</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <span class="text-white fw-bold fs-6">Great job! Keep it up</span>
            </div>
        </div>
    </div>

    {{-- In Progress Tasks --}}
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card card-flush h-xl-100" style="background-color: #7239EA">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $inProgressTasks ?? 0 }}</span>
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">In Progress</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <span class="text-white fw-bold fs-6">Currently working on</span>
            </div>
        </div>
    </div>

    {{-- Overdue Tasks --}}
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card card-flush h-xl-100" style="background-color: #FFC700">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $overdueTasks ?? 0 }}</span>
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Overdue</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <span class="text-white fw-bold fs-6">Need attention</span>
            </div>
        </div>
    </div>
</div>

{{-- Tasks Table --}}
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" id="searchTask" class="form-control form-control-solid w-250px ps-13" placeholder="Search project..." />
            </div>
        </div>

        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                {{-- Filter Status --}}
                <select class="form-select form-select-solid fw-bold w-auto me-3" id="filterStatus">
                    <option value="">All Status</option>
                    <option value="planning">Planning</option>
                    <option value="in_progress">In Progress</option>
                    <option value="on_hold">On Hold</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>

                {{-- Filter Priority --}}
                <select class="form-select form-select-solid fw-bold w-auto me-3" id="filterPriority">
                    <option value="">All Priority</option>
                    <option value="urgent">Urgent</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>

                {{-- Add Task Button --}}
                @if($create)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_task">
                        <i class="ki-duotone ki-plus fs-2"></i>
                        Add Project
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="card-body py-4">
        <div class="d-flex flex-wrap flex-stack my-5">
            <h2 class="fs-2 fw-semibold my-2">My Projects
            </h2>
        </div>
        
        @include('admin.errors')
        
        <div class="row g-6 g-xl-9" id="projectsContainer">
            @forelse ($projects as $project)
                <div class="col-md-6 col-xl-4 project-card" 
                     data-name="{{ strtolower($project->name) }}" 
                     data-code="{{ strtolower($project->code) }}"
                     data-status="{{ $project->status }}"
                     data-priority="{{ $project->priority ?? '' }}">
                    <div class="card border-hover-dark shadow">
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
                                @endphp
                                <div class="dropdown">
                                    <button class="btn btn-sm badge badge-{{ $color }} dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown">
                                        {{ ucwords(str_replace('_', ' ', $project->status)) }}
                                    </button>
                                    @if(($update ?? false) || $project->manager_id == Auth::user()->id)
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item status-change" 
                                                href="javascript:void(0)" 
                                                data-url="{{ route('user.projects.update-status', $project->id) }}" 
                                                data-status="planning">
                                                <i class="ki-duotone ki-calendar text-warning"><span class="path1"></span><span class="path2"></span></i>
                                                Planning
                                            </a></li>
                                            <li><a class="dropdown-item status-change" 
                                                href="javascript:void(0)" 
                                                data-url="{{ route('user.projects.update-status', $project->id) }}" 
                                                data-status="in_progress">
                                                <i class="ki-duotone ki-arrow-right text-primary"><span class="path1"></span><span class="path2"></span></i>
                                                In Progress
                                            </a></li>
                                            <li><a class="dropdown-item status-change" 
                                                href="javascript:void(0)" 
                                                data-url="{{ route('user.projects.update-status', $project->id) }}" 
                                                data-status="on_hold">
                                                <i class="ki-duotone ki-arrows-circle text-danger"><span class="path1"></span><span class="path2"></span></i>
                                                On Hold
                                            </a></li>
                                            <li><a class="dropdown-item status-change" 
                                                href="javascript:void(0)" 
                                                data-url="{{ route('user.projects.update-status', $project->id) }}" 
                                                data-status="completed">
                                                <i class="ki-duotone ki-check text-success"><span class="path1"></span><span class="path2"></span></i>
                                                Completed
                                            </a></li>
                                            <li><a class="dropdown-item status-change" 
                                                href="javascript:void(0)" 
                                                data-url="{{ route('user.projects.update-status', $project->id) }}" 
                                                data-status="cancelled">
                                                <i class="ki-duotone ki-cross text-danger"><span class="path1"></span><span class="path2"></span></i>
                                                Cancelled
                                            </a></li>
                                        </ul>
                                    @endif
                                </div>
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
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bold">{{ $project->createdBy->name }}</div>
                                    <div class="fw-semibold text-gray-500">Created By</div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-semibold text-gray-700">Project Progress</span>
                                    <span class="fw-bold text-gray-800">{{ $project->progress }}%</span>
                                </div>
                                <div class="h-10px w-100 bg-secondary rounded">
                                    <div class="bg-primary rounded h-10px" 
                                        role="progressbar" 
                                        style="width: {{ $project->progress }}%;" 
                                        aria-valuenow="{{ $project->progress }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('user.tasks.my-task', $project->id) }}" class="btn btn-sm btn-light-primary flex-grow-1">
                                        <i class="ki-duotone ki-eye fs-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        View
                                    </a>

                                    @if($update ?? false)
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProjectModal{{ $project->id }}">
                                            <i class="ki-duotone ki-pencil fs-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            Edit
                                        </button>
                                    @endif
                                    @if($delete ?? false)
                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteAlert" 
                                                    data-url="{{ route('user.projects.destroy', $project->id) }}">
                                            <i class="ki-duotone ki-trash fs-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            Delete
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12" id="noProjectsMessage">
                    <div class="alert alert-info text-center">
                        <i class="ki-duotone ki-information fs-2x mb-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <p class="mb-0">No projects found</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($projects->hasPages())
            <div class="d-flex justify-content-end pt-10">
                {{ $projects->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>

{{-- Add Project Modal --}}
<div class="modal fade" id="kt_modal_add_task" tabindex="-1" aria-labelledby="kt_modal_add_taskLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="kt_modal_add_taskLabel">
                    <i class="ki-duotone ki-plus fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Add Project
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('user.projects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="mb-7 fv-row">
                                <label for="name" class="required form-label fw-semibold">Project Name</label>
                                <input type="text" class="form-control" name="name" id="name" 
                                       placeholder="Enter project name" value="{{ old('name') }}" required />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="code" class="required form-label fw-semibold">Project Code</label>
                                <input type="text" class="form-control" name="code" id="code" 
                                       placeholder="Enter project code" value="{{ old('code') }}" required />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="start_date" class="form-label fw-semibold">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" 
                                       value="{{ old('start_date') }}" />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="end_date" class="form-label fw-semibold">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" 
                                       value="{{ old('end_date') }}" />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea name="description" id="description" class="form-control" 
                                          rows="4" placeholder="Enter project description (optional)">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-7 fv-row">
                                <label for="leader_id" class="form-label fw-semibold">Project Leader</label>
                                <select id="leader_id" name="leader_id" class="form-select" data-control="select2" data-placeholder="Select project leader">
                                    <option value=""></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('leader_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="priority" class="form-label fw-semibold required">Priority</label>
                                <select id="priority" name="priority" class="form-select" data-control="select2" data-placeholder="Select priority" required>
                                    <option value=""></option>
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>

                            <div class="mb-7 fv-row">
                                <label class="form-label fw-semibold mb-3">Project Status</label>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-warning">
                                            <input class="form-check-input" type="radio" name="status" value="planning" 
                                                   id="planning" {{ old('status', 'planning') == 'planning' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="planning">
                                                Planning
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-primary">
                                            <input class="form-check-input" type="radio" name="status" value="in_progress" 
                                                   id="in_progress" {{ old('status') == 'in_progress' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="in_progress">
                                                In Progress
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-danger">
                                            <input class="form-check-input" type="radio" name="status" value="on_hold" 
                                                   id="on_hold" {{ old('status') == 'on_hold' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="on_hold">
                                                On Hold
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-success">
                                            <input class="form-check-input" type="radio" name="status" value="completed" 
                                                   id="completed" {{ old('status') == 'completed' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="completed">
                                                Completed
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-custom form-check-danger">
                                            <input class="form-check-input" type="radio" name="status" value="cancelled" 
                                                   id="cancelled" {{ old('status') == 'cancelled' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="cancelled">
                                                Cancelled
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Update Project Modal --}}
@foreach ($projects as $project)
<div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editProjectModalLabel{{ $project->id }}">
                    <i class="ki-duotone ki-plus fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Update Project
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('user.projects.update', $project->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="mb-7 fv-row">
                                <label for="name_edit{{ $project->id }}" class="required form-label fw-semibold">Project Name</label>
                                <input type="text" class="form-control" name="name" id="name_edit{{ $project->id }}" 
                                       placeholder="Enter project name" value="{{ $project->name }}" required />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="code_edit{{ $project->id }}" class="required form-label fw-semibold">Project Code</label>
                                <input type="text" class="form-control" name="code" id="code_edit{{ $project->id }}" 
                                       placeholder="Enter project code" value="{{ $project->code }}" required />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="start_date{{ $project->id }}" class="form-label fw-semibold">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date{{ $project->id }}" 
                                       value="{{ $project->start_date }}" />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="end_date{{ $project->id }}" class="form-label fw-semibold">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date{{ $project->id }}" 
                                       value="{{ $project->end_date }}" />
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="description{{ $project->id }}" class="form-label fw-semibold">Description</label>
                                <textarea name="description" id="description{{ $project->id }}" class="form-control" 
                                          rows="4" placeholder="Enter project description (optional)">{{ $project->description }}</textarea>
                            </div>

                            <label class="form-check-label fw-semibold" for="in_progress{{ $project->id }}">
                                Updated By : {{ $project->updatedBy->name ?? '-' }}
                            </label>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-7 fv-row">
                                <label for="leader_id{{ $project->id }}" class="form-label fw-semibold">Project Leader</label>
                                <select id="leader_id{{ $project->id }}" name="leader_id" class="form-select" data-control="select2" data-placeholder="Select project leader">
                                    <option value=""></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $project->manager_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-7 fv-row">
                                <label for="priority{{ $project->id }}" class="form-label fw-semibold required">Priority</label>
                                <select id="priority{{ $project->id }}" name="priority" class="form-select" data-control="select2" data-placeholder="Select priority" required>
                                    <option value=""></option>
                                    <option value="low" {{ $project->priority == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $project->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $project->priority == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ $project->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>

                            <div class="mb-7 fv-row">
                                <label class="form-label fw-semibold mb-3">Project Status</label>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-warning">
                                            <input class="form-check-input" type="radio" name="status" value="planning" 
                                                   id="planning{{ $project->id }}" {{ $project->status == 'planning' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="planning{{ $project->id }}">
                                                Planning
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-primary">
                                            <input class="form-check-input" type="radio" name="status" value="in_progress" 
                                                   id="in_progress{{ $project->id }}" {{ $project->status == 'in_progress' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="in_progress{{ $project->id }}">
                                                In Progress
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-danger">
                                            <input class="form-check-input" type="radio" name="status" value="on_hold" 
                                                   id="on_hold{{ $project->id }}" {{ $project->status == 'on_hold' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="on_hold{{ $project->id }}">
                                                On Hold
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="form-check form-check-custom form-check-success">
                                            <input class="form-check-input" type="radio" name="status" value="completed" 
                                                   id="completed{{ $project->id }}" {{ $project->status == 'completed' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="completed{{ $project->id }}">
                                                Completed
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-custom form-check-danger">
                                            <input class="form-check-input" type="radio" name="status" value="cancelled" 
                                                   id="cancelled{{ $project->id }}" {{ $project->status == 'cancelled' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="cancelled{{ $project->id }}">
                                                Cancelled
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 when modal is shown
        $('#kt_modal_add_task').on('shown.bs.modal', function () {
            // Initialize Leader Select
            $('#leader_id').select2({
                dropdownParent: $('#kt_modal_add_task'),
                placeholder: 'Select project leader',
                allowClear: true,
                width: '100%'
            });
            
            // Initialize Priority Select
            $('#priority').select2({
                dropdownParent: $('#kt_modal_add_task'),
                placeholder: 'Select priority',
                allowClear: true,
                width: '100%'
            });
        });

        @foreach ($projects as $project)
            $('#leader_id{{ $project->id }}').select2({
                dropdownParent: $('#editProjectModal{{ $project->id }}'),
                placeholder: 'Select project leader',
                allowClear: true,
                width: '100%'
            });
            
            // Initialize Priority Select
            $('#priority{{ $project->id }}').select2({
                dropdownParent: $('#editProjectModal{{ $project->id }}'),
                placeholder: 'Select priority',
                allowClear: true,
                width: '100%'
            });
        @endforeach
        
        // Destroy Select2 when modal is hidden to prevent duplication
        $('#kt_modal_add_task').on('hidden.bs.modal', function () {
            if ($('#leader_id').hasClass('select2-hidden-accessible')) {
                $('#leader_id').select2('destroy');
            }
            if ($('#priority').hasClass('select2-hidden-accessible')) {
                $('#priority').select2('destroy');
            }
        });

        // Search functionality
        $('#searchTask').on('keyup', function() {
            filterProjects();
        });

        // Status filter
        $('#filterStatus').on('change', function() {
            filterProjects();
        });

        // Priority filter
        $('#filterPriority').on('change', function() {
            filterProjects();
        });

        function filterProjects() {
            var searchValue = $('#searchTask').val().toLowerCase();
            var statusValue = $('#filterStatus').val().toLowerCase();
            var priorityValue = $('#filterPriority').val().toLowerCase();
            
            var visibleCount = 0;

            $('.project-card').each(function() {
                var $card = $(this);
                var name = $card.data('name');
                var code = $card.data('code');
                var status = $card.data('status');
                var priority = $card.data('priority');

                var matchSearch = searchValue === '' || 
                                name.includes(searchValue) || 
                                code.includes(searchValue);
                
                var matchStatus = statusValue === '' || status === statusValue;
                var matchPriority = priorityValue === '' || priority === priorityValue;

                if (matchSearch && matchStatus && matchPriority) {
                    $card.show();
                    visibleCount++;
                } else {
                    $card.hide();
                }
            });

            // Show/hide no results message
            if (visibleCount === 0) {
                if ($('#noResultsMessage').length === 0) {
                    $('#projectsContainer').append(`
                        <div class="col-12" id="noResultsMessage">
                            <div class="alert alert-warning text-center">
                                <i class="ki-duotone ki-information-5 fs-2x mb-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <p class="mb-0">No projects match your search criteria</p>
                            </div>
                        </div>
                    `);
                }
            } else {
                $('#noResultsMessage').remove();
            }
        }

        // Reset filters button (optional)
        function resetFilters() {
            $('#searchTask').val('');
            $('#filterStatus').val('');
            $('#filterPriority').val('');
            filterProjects();
        }

        // Add reset button if needed
        // $('#resetFilters').on('click', resetFilters);

        $(document).on('click', '.deleteAlert', function(e) {
            e.preventDefault();
            const url = $(this).data('url');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        'method': 'GET',
                        'action': url
                    });
                    
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': csrfToken
                    }));
                    
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));
                    
                    $('body').append(form);
                    form.submit();
                }
            });
        });

        @if(session('success'))
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { 
                    confirmButton: "btn btn-primary" 
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                text: "{{ session('error') }}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { 
                    confirmButton: "btn btn-primary" 
                }
            });
        @endif

        $('.status-change').on('click', function() {
            const url = $(this).data('url');
            const newStatus = $(this).data('status');
            
            Swal.fire({
                title: 'Update Status?',
                text: `Change status to ${newStatus.replace(/_/g, ' ')}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: newStatus
                        },
                        success: function(response) {
                            Swal.fire('Updated!', 'Status has been updated.', 'success')
                                .then(() => location.reload());
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseJSON);
                            Swal.fire('Error!', xhr.responseJSON?.message || 'Failed to update status.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush