@extends('layouts.user')

@section('content')
{{-- Statistics Cards --}}
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    {{-- Total Tasks --}}
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C; background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalTasks ?? 0 }}</span>
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Tasks</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                        <span>Progress</span>
                        <span>{{ number_format($progressPercentage) ?? 0 }}%</span>
                    </div>
                    <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-8px" role="progressbar" style="width: {{ number_format($progressPercentage) ?? 0 }}%;" aria-valuenow="{{ number_format($progressPercentage) ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
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

{{-- Tasks Table with Tabs --}}
<div class="card">
    @include('user.task.header')

    <div class="card-body py-4">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" id="searchMyTask" class="form-control form-control-solid w-250px ps-13" placeholder="Search my task..." />
            </div>

            <div class="d-flex">
                {{-- Filter Status --}}
                <select class="form-select form-select-solid fw-bold w-auto me-3" id="filterMyStatus">
                    <option value="">All Status</option>
                    <option value="To Do">To Do</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Review">Review</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>

                {{-- Filter Priority --}}
                <select class="form-select form-select-solid fw-bold w-auto me-3" id="filterMyPriority">
                    <option value="">All Priority</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                    <option value="Urgent">Urgent</option>
                </select>
            </div>
        </div>

        {{-- My Tasks Table --}}
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_my_tasks">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px">Task</th>
                    <th class="min-w-100px">Priority</th>
                    <th class="min-w-100px">Status</th>
                    <th class="min-w-125px">Due Date</th>
                    <th class="min-w-125px">Assigned By</th>
                    @if($update ?? false || $delete ?? false)
                        <th class="text-end min-w-100px">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @forelse ($tasks as $task)
                <tr>
                    <td>
                        <div class="d-flex flex-column">
                            <a href="#" class="text-gray-800 text-hover-primary mb-1 fs-6 fw-bold">{{ $task->name }}</a>
                            <span class="text-muted fs-7">{{ Str::limit($task->description, 50) }}</span>
                        </div>
                    </td>
                    <td>
                        @php
                            $priorityColors = [
                                'low' => 'info',
                                'medium' => 'warning',
                                'high' => 'danger',
                                'urgent' => 'dark'
                            ];
                            $priorityColor = $priorityColors[$task->priority] ?? 'secondary';
                        @endphp
                        <span class="badge badge-light-{{ $priorityColor }}">
                            {{ ucfirst($task->priority ?? '-') }}
                        </span>
                    </td>
                    <td class="position-relative">
                        @php
                            $statusColors = [
                                'todo' => 'warning',
                                'in_progress' => 'primary',
                                'review' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                            $color = $statusColors[$task->status] ?? 'secondary';
                            $statusDisplay = ucwords(str_replace('_', ' ', $task->status ?? 'Unknown'));
                        @endphp
                        @if(($update ?? false) || $task->project->manager_id == Auth::id() || $task->assigned_to == Auth::id())
                            <a href="#" class="btn btn-sm badge badge-{{ $color }} dropdown-toggle" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                {{ $statusDisplay }}
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a class="menu-link status-change" 
                                        href="javascript:void(0)" 
                                        data-url="{{ route('user.tasks.update-status', $task->id) }}" 
                                        data-status="todo">
                                        <i class="ki-duotone ki-calendar text-warning fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>
                                        To Do
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a class="menu-link status-change" 
                                        href="javascript:void(0)" 
                                        data-url="{{ route('user.tasks.update-status', $task->id) }}" 
                                        data-status="in_progress">
                                        <i class="ki-duotone ki-arrow-right text-primary fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>
                                        In Progress
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a class="menu-link status-change" 
                                        href="javascript:void(0)" 
                                        data-url="{{ route('user.tasks.update-status', $task->id) }}" 
                                        data-status="review">
                                        <i class="ki-duotone ki-arrows-circle text-info fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>
                                        Review
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a class="menu-link status-change" 
                                        href="javascript:void(0)" 
                                        data-url="{{ route('user.tasks.update-status', $task->id) }}" 
                                        data-status="completed">
                                        <i class="ki-duotone ki-check text-success fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>
                                        Completed
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a class="menu-link status-change" 
                                        href="javascript:void(0)" 
                                        data-url="{{ route('user.tasks.update-status', $task->id) }}" 
                                        data-status="cancelled">
                                        <i class="ki-duotone ki-cross text-danger fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>
                                        Cancelled
                                    </a>
                                </div>
                            </div>
                        @else
                            <span class="badge badge-light-{{ $color }} text-nowrap">
                                {{ $statusDisplay }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="text-gray-600">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-35px me-3">
                                <span class="symbol-label bg-light-primary text-primary fw-bold">
                                    {{ substr($task->createdBy->name ?? 'U', 0, 1) }}
                                </span>
                            </div>
                            <span class="text-gray-800">{{ $task->createdBy->name ?? 'Unassigned' }}</span>
                        </div>
                    </td>
                    @if($update ?? false || $delete ?? false)
                    <td class="text-end">
                        @if(($update ?? false) || $task->project->manager_id == Auth::id())
                        <button type="button" class="btn btn-icon btn-sm btn-warning me-1" title="Edit Task" data-bs-toggle="modal" data-bs-target="#edit_task_modal{{ $task->id }}">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        @endif
                        @if(($delete ?? false) || $task->project->manager_id == Auth::id())
                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger deleteAlert" data-url="{{ route('user.tasks.destroy', $task->id) }}" title="Delete Task">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </a>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ ($update ?? false || $delete ?? false) ? 6 : 5 }}" class="text-center">
                        <div class="py-10">
                            <i class="ki-duotone ki-information fs-3x text-muted">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <p class="text-muted fs-5 mt-3">No tasks assigned to you yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!-- Spacer to ensure scrolling reaches bottom -->
<div class="mb-20 pb-20"></div>

{{-- Edit Task Modals --}}
@foreach ($tasks as $task)
<div class="modal fade" id="edit_task_modal{{ $task->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Edit Task</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            <div class="modal-body px-5 py-10">
                <form action="{{ route('user.tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10">
                        {{-- Task Title --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Task Title</label>
                            <input type="text" name="name" class="form-control form-control-solid" value="{{ $task->name }}" required />
                        </div>

                        {{-- Task Description --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Description</label>
                            <textarea name="description" class="form-control form-control-solid" rows="3">{{ $task->description }}</textarea>
                        </div>

                        {{-- Priority --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Priority</label>
                            <select name="priority" class="form-select form-select-solid" required>
                                <option value="">Select Priority</option>
                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                        </div>

                        {{-- Due Date --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Due Date</label>
                            <input type="date" name="due_date" class="form-control form-control-solid" value="{{ $task->due_date }}" required />
                        </div>
                    </div>

                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Update Task</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable for My Tasks
    @if($tasks->count() > 0)
    const myTasksTable = $('#kt_table_my_tasks').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[3, 'asc']], // Sort by due date
        columnDefs: [{
            targets: [4], // Actions column
            orderable: false
        }]
    });

    // Search functionality for All Tasks
    $('#searchAllTask').on('keyup', function() {
        allTasksTable.search(this.value).draw();
    });

    // Filter by status for All Tasks
    $('#filterAllStatus').on('change', function() {
        allTasksTable.column(3).search(this.value).draw();
    });

    // Filter by priority for All Tasks
    $('#filterAllPriority').on('change', function() {
        allTasksTable.column(2).search(this.value).draw();
    });

    // Search functionality for My Tasks
    $('#searchMyTask').on('keyup', function() {
        myTasksTable.search(this.value).draw();
    });

    // Filter by status for My Tasks
    $('#filterMyStatus').on('change', function() {
        myTasksTable.column(2).search(this.value).draw();
    });

    // Filter by priority for My Tasks
    $('#filterMyPriority').on('change', function() {
        myTasksTable.column(1).search(this.value).draw();
    });

    @else
        // Jika tidak ada data, sembunyikan atau disable filter
        $('#searchMyTask, #filterMyStatus, #filterMyPriority').prop('disabled', true);
    @endif


    // Form submission
    $('#kt_modal_add_task_form').on('submit', function(e) {
        e.preventDefault();
        // Add your AJAX submission here
        alert('Task added successfully!');
        $('#kt_modal_add_task').modal('hide');
    });

    $('#kt_modal_add_task').on('shown.bs.modal', function () {
        // Initialize Leader Select
        $('#assign_to').select2({
            dropdownParent: $('#kt_modal_add_task'),
            placeholder: 'Select assign to',
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

    @foreach ($tasks as $task)
        $('#edit_task_modal{{ $task->id }}').on('shown.bs.modal', function () {
            $('#assign_to{{ $task->id }}').select2({
                dropdownParent: $('#edit_task_modal{{ $task->id }}'),
                placeholder: 'Select assign to',
                allowClear: true,
                width: '100%'
            });
            
            // Initialize Priority Select
            $('#priority{{ $task->id }}').select2({
                dropdownParent: $('#edit_task_modal{{ $task->id }}'),
                placeholder: 'Select priority',
                allowClear: true,
                width: '100%'
            });
        });
    @endforeach

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
                confirmButtonText: 'Yes, update it!',
                 showLoaderOnConfirm: true, // Enable loading state
                preConfirm: () => {
                    return $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: newStatus
                        }
                    }).then(response => {
                        return response;
                    }).catch(xhr => {
                        Swal.showValidationMessage(
                            `Request failed: ${xhr.responseJSON?.message || 'Unknown error'}`
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Updated!', 'Status has been updated.', 'success')
                        .then(() => location.reload());
                }
            });
        });
});
</script>
@endpush