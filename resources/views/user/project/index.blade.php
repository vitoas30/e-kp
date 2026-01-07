@extends('layouts.user')

@section('content')
{{-- Statistics Cards --}}
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C; background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalProject ?? 0 }}</span>
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">My Projects</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                        <span>Avg Progress</span>
                        <span>{{ number_format($averageProgress, 0) }}%</span>
                    </div>
                    <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-8px" role="progressbar" style="width: {{ $averageProgress }}%;" aria-valuenow="{{ $averageProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

@if(isset($isAdminAccess) && $isAdminAccess)
<ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_my_projects">My Projects</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_all_projects">Manage All Projects</a>
    </li>
</ul>
@endif

<div class="tab-content" id="myTabContent">
    <!-- My Projects Tab -->
    <div class="tab-pane fade show active" id="kt_tab_my_projects" role="tabpanel">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3 class="fw-bold m-0">My Projects</h3>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="row g-6 g-xl-9">
                    @forelse ($myProjects as $project)
                        @include('user.project.card_content', ['project' => $project, 'allowEdit' => false])
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <p class="mb-0">No projects found for you.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if(isset($isAdminAccess) && $isAdminAccess)
    <!-- All Projects Tab -->
    <div class="tab-pane fade" id="kt_tab_all_projects" role="tabpanel">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span><span class="path2"></span></i>
                        <input type="text" id="searchTask" class="form-control form-control-solid w-250px ps-13" placeholder="Search project..." />
                    </div>
                    <div class="ms-3">
                         <select class="form-select form-select-solid fw-bold w-auto" id="filterStatus">
                            <option value="">All Status</option>
                            <option value="planning">Planning</option>
                            <option value="in_progress">In Progress</option>
                            <option value="on_hold">On Hold</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_task">
                        <i class="ki-duotone ki-plus fs-2"></i> Add Project
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="row g-6 g-xl-9" id="projectsContainer">
                    @foreach ($allProjects as $project)
                        @include('user.project.card_content', ['project' => $project, 'allowEdit' => true])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Add Project Modal --}}
@if(isset($isAdminAccess) && $isAdminAccess)
<div class="modal fade" id="kt_modal_add_task" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add Project</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.projects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-7">
                                <label class="required form-label fw-semibold">Project Name</label>
                                <input type="text" class="form-control" name="name" required />
                            </div>
                            <div class="mb-7">
                                <label class="required form-label fw-semibold">Project Code</label>
                                <input type="text" class="form-control" name="code" required />
                            </div>
                             <div class="mb-7">
                                <label class="form-label fw-semibold">Start Date</label>
                                <input type="date" class="form-control" name="start_date" />
                            </div>
                            <div class="mb-7">
                                <label class="form-label fw-semibold">End Date</label>
                                <input type="date" class="form-control" name="end_date" />
                            </div>
                            <div class="mb-7">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-7">
                                <label class="form-label fw-semibold">Project Leader</label>
                                <select name="leader_id" class="form-select" data-control="select2" data-placeholder="Select leader">
                                    <option value=""></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-7">
                                <label class="required form-label fw-semibold">Priority</label>
                                <select name="priority" class="form-select" required>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                            <div class="mb-7">
                                <label class="required form-label fw-semibold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="planning">Planning</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Update Project Modals --}}
@foreach ($allProjects as $project)
<div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Update Project</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.projects.update', $project->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-7">
                                <label class="required form-label fw-semibold">Project Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $project->name }}" required />
                            </div>
                            <!-- Add other fields similarly populated -->
                             <div class="mb-7">
                                <label class="required form-label fw-semibold">Project Code</label>
                                <input type="text" class="form-control" name="code" value="{{ $project->code }}" required />
                            </div>
                             <div class="mb-7">
                                <label class="form-label fw-semibold">Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="{{ $project->start_date }}" />
                            </div>
                            <div class="mb-7">
                                <label class="form-label fw-semibold">End Date</label>
                                <input type="date" class="form-control" name="end_date" value="{{ $project->end_date }}" />
                            </div>
                            <div class="mb-7">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-7">
                                <label class="form-label fw-semibold">Project Leader</label>
                                <select name="leader_id" class="form-select">
                                    <option value=""></option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}" {{ $project->manager_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="mb-7">
                                <label class="required form-label fw-semibold">Priority</label>
                                <select name="priority" class="form-select" required>
                                    <option value="low" {{ $project->priority == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $project->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $project->priority == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ $project->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                            <div class="mb-7">
                                <label class="required form-label fw-semibold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="planning" {{ $project->status == 'planning' ? 'selected' : '' }}>Planning</option>
                                    <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="on_hold" {{ $project->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                    <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $project->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection

@push('scripts')
<script>
    @if(session('success'))
        Swal.fire({ text: "{{ session('success') }}", icon: "success", buttonsStyling: false, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
    @endif
    @if(session('error'))
        Swal.fire({ text: "{{ session('error') }}", icon: "error", buttonsStyling: false, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
    @endif

    // JS for filter/search would go here, applied to #projectsContainer children
    $(document).ready(function() {
         $('#searchTask').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#projectsContainer > div").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
        $('#filterStatus').on('change', function() {
             var value = $(this).val();
              if(value == "") {
                 $("#projectsContainer > div").show();
             } else {
                 $("#projectsContainer > div").hide();
                 $("#projectsContainer > div[data-status='" + value + "']").show();
             }
        });

        // Handle Status Change
        $(document).on('click', '.status-change', function(e) {
            e.preventDefault();
            const url = $(this).data('url');
            const newStatus = $(this).data('status');
            
            Swal.fire({
                title: 'Update Status?',
                text: `Change status to ${newStatus.replace(/_/g, ' ')}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-light" }
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
                            Swal.fire({
                                text: "Status has been updated.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            }).then(() => location.reload());
                        },
                        error: function(xhr) {
                            Swal.fire({
                                text: xhr.responseJSON?.message || "Failed to update status",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush