@extends('layouts.admin')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Add Task
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.tasks.index') }}" class="text-muted text-hover-primary">List Task</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Add Task</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card">
                <div class="card-header border-1 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Form Add New Task</h3>
                    </div>
                </div>
                <div class="card-body py-4">
                    <form action="{{ route('admin.tasks.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="project" class="required form-label">Project</label>
                                    <select id="project" name="project" class="form-select" required>
                                        <option value="" disabled selected>Pilih Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" {{ old('project') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" 
                                           placeholder="Start Date" value="{{ old('start_date') }}" />
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="assign_to" class="form-label fw-semibold">Assign To</label>
                                    <select id="assign_to" name="assign_to" class="form-select">
                                        <option value="" disabled selected>Pilih User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('assign_to') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="description" class="form-label fw-semibold">Description</label>
                                    <textarea name="description" id="description" class="form-control form-control-solid" rows="3" placeholder="Enter description (optional)">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="name" class="required form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" 
                                           placeholder="Full Name" value="{{ old('name') }}" required />
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="date" class="form-control" name="due_date" id="due_date" 
                                           placeholder="Due Date" value="{{ old('due_date') }}" />
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="priority" class="form-label fw-semibold">Priority</label>
                                    <select id="priority" name="priority" class="form-select">
                                        <option value="" disabled selected>Pilih Priority</option>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Hight</option>
                                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                    </select>
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="form-label">Status Task</label>
                                    <div class="d-flex mt-2">
                                        <div class="form-check form-check-custom form-check-warning me-20">
                                            <input class="form-check-input" type="radio" name="status" value="todo" 
                                                   id="todo" checked>
                                            <label class="form-check-label" for="todo">To do</label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-primary me-10">
                                            <input class="form-check-input" type="radio" name="status" value="in_progress" 
                                                   id="in_progress" {{ old('status') == "in_progress" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="in_progress">In Progress</label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-danger me-10">
                                            <input class="form-check-input" type="radio" name="status" value="review" 
                                                   id="review" {{ old('status') == "review" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="review">Review</label>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="form-check form-check-custom form-check-success me-10">
                                            <input class="form-check-input" type="radio" name="status" value="completed" 
                                                   id="completed" {{ old('status') == "completed" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="completed">Completed</label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-danger">
                                            <input class="form-check-input" type="radio" name="status" value="cancelled" 
                                                   id="cancelled" {{ old('status') == "cancelled" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cancelled">Cancelled</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if ($('#assign_to').length) {
            $('#assign_to').select2({
                placeholder: 'Pilih User',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#kt_content_container'), // ✅ perbaikan: sebelumnya pakai modal yang tidak ada
                language: {
                    noResults: function() {
                        return "Tidak ditemukan";
                    }
                }
            });
        }
        if ($('#priority').length) {
            $('#priority').select2({
                placeholder: 'Pilih Priority',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#kt_content_container'), // ✅ perbaikan: sebelumnya pakai modal yang tidak ada
                language: {
                    noResults: function() {
                        return "Tidak ditemukan";
                    }
                }
            });
        }
        if ($('#project').length) {
            $('#project').select2({
                placeholder: 'Pilih Project',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#kt_content_container'), // ✅ perbaikan: sebelumnya pakai modal yang tidak ada
                language: {
                    noResults: function() {
                        return "Tidak ditemukan";
                    }
                }
            });
        }
    });
</script>
@endpush
