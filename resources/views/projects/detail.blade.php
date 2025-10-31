@extends('layouts.admin')

@section('title', 'Detail Project')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Detail Project</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.projects.index')}}" class="text-muted text-hover-primary">List Project</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Detail Project</li>
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
                                <td class="w-200px">Project Name</td>
                                <td>: <span class="text-gray-800 fw-bold text-nowrap">{{ $project->name }}</span></td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td>: <span class="badge badge-light-info">{{ $project->code ?? '-' }}</span></td>
                            </tr>
                            <tr>
                                <td>Leader</td>
                                <td>: 
                                    @if($project->manager)
                                        <span class="text-gray-800">{{ $project->manager->name }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td>: 
                                    <span class="text-nowrap">
                                        {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td>: 
                                    <span class="text-nowrap">
                                        {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: 
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
                                    <span class="badge badge-light-{{ $color }} text-nowrap">
                                        {{ ucwords(str_replace('_', ' ', $project->status ?? 'Unknown')) }}
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
                                        $priorityColor = $priorityColors[$project->priority] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-light-{{ $priorityColor }}">
                                        {{ ucfirst($project->priority ?? '-') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Progress</td>
                                <td>: 
                                    <span class="text-muted fs-7 fw-bold">{{ (int) $project->progress }}%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-200px">Description</td>
                                <td>: {{ $project->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
