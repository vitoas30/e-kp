@extends('layouts.admin')

@section('title', 'Detail Task')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Detail Task</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.tasks.index')}}" class="text-muted text-hover-primary">List Task</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Detail Task</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            @if(session()->has('message'))
                <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row p-5 mb-10">
                    <i class="ki-duotone ki-information fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>

                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h5 class="mb-1">Error</h5>

                        <span>{{ session()->get('message') }}</span>
                    </div>

                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-3 text-danger"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row p-5 mb-10">
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>

                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h5 class="mb-1">success</h5>

                        <span>{{ session()->get('success') }}</span>
                    </div>

                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-3 text-success"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif
            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 mt-5">
                            <tr>
                                <td class="w-200px">Project</td>
                                <td>: <span class="text-gray-800 fw-bold text-nowrap">{{ $task->project->name ?? '-'}}</span></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>: <span class="text-gray-800 fw-bold text-nowrap">{{ $task->name ?? '-' }}</span></td>
                            </tr>
                            <tr>
                                <td>Assign To</td>
                                <td>: 
                                    @if($task->assignee)
                                        <span class="text-gray-800">{{ $task->assignee->name }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td>: 
                                    <span class="text-nowrap">
                                        {{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d M Y') : '-' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Due Date</td>
                                <td>: 
                                    <span class="text-nowrap">
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: 
                                    @php
                                        $statusColors = [
                                            'todo' => 'info',
                                            'in_progress' => 'primary',
                                            'review' => 'warning',
                                            'completed' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                        $color = $statusColors[$task->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-light-{{ $color }} text-nowrap">
                                        {{ ucwords(str_replace('_', ' ', $task->status ?? 'Unknown')) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>: 
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
                            </tr>
                            <tr>
                                <td>Progress</td>
                                <td>: 
                                    <span class="text-muted fs-7 fw-bold">{{ (int) $task->progress }}%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-200px">Description</td>
                                <td>: {{ $task->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
