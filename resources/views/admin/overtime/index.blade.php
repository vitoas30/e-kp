@extends('layouts.admin')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3 class="card-label">Daftar Pengajuan Lembur</h3>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_overtime">
                        <i class="ki-duotone ki-plus fs-2"></i> Input Lembur
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_overtimes">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">User</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-100px">Time</th>
                                <th class="min-w-125px">Project</th>
                                <th class="min-w-150px">Reason</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-125px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($overtimes as $overtime)
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $overtime->user->name }}</a>
                                            <span>{{ $overtime->user->email }}</span>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($overtime->date)->format('d M Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($overtime->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($overtime->end_time)->format('H:i') }}
                                        <div class="text-muted fs-7">
                                            @php
                                                $start = \Carbon\Carbon::parse($overtime->start_time);
                                                $end = \Carbon\Carbon::parse($overtime->end_time);
                                                echo $start->diff($end)->format('%H Jam %I Menit');
                                            @endphp
                                        </div>
                                    </td>
                                    <td>
                                        {{ $overtime->project->name }}
                                        <div class="text-muted fs-7">{{ $overtime->task->name ?? '-' }}</div>
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($overtime->reason, 50) }}</td>
                                    <td>
                                        @php
                                            $color = match($overtime->status) {
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                'pending' => 'warning',
                                                default => 'primary'
                                            };
                                        @endphp
                                        <span class="badge badge-light-{{ $color }}">{{ ucfirst($overtime->status) }}</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-light btn-active-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_overtime_{{ $overtime->id }}">
                                            Update Status
                                        </button>

                                        <!-- Modal Update Status -->
                                        <div class="modal fade" id="kt_modal_edit_overtime_{{ $overtime->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="fw-bold">Update Status Lembur</h2>
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                        <form action="{{ route('admin.overtime.update', $overtime->id) }}" method="POST" class="form">
                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <div class="mb-5">
                                                                <label class="required fs-6 fw-semibold mb-2">Status</label>
                                                                <select name="status" class="form-select form-select-solid" required>
                                                                    <option value="pending" {{ $overtime->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                    <option value="approved" {{ $overtime->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                                    <option value="rejected" {{ $overtime->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-5">
                                                                <label class="fs-6 fw-semibold mb-2">Admin Notes</label>
                                                                <textarea name="admin_notes" class="form-control form-control-solid" rows="3">{{ $overtime->admin_notes }}</textarea>
                                                            </div>

                                                            <div class="text-center pt-10">
                                                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <span class="indicator-label">Simpan</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if($overtimes->isEmpty())
                                <tr><td colspan="7" class="text-center">Belum ada data lembur</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    {{ $overtimes->links() }}
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal Add Overtime -->
    <div class="modal fade" id="kt_modal_add_overtime" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">Input Data Lembur</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form action="{{ route('admin.overtime.store') }}" method="POST" class="form">
                        @csrf
                        
                        <div class="mb-5">
                            <label class="required fs-6 fw-semibold mb-2">User</label>
                            <select name="user_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_overtime" data-placeholder="Pilih User" required>
                                <option></option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="required fs-6 fw-semibold mb-2">Tanggal</label>
                            <input type="date" name="date" class="form-control form-control-solid" required value="{{ date('Y-m-d') }}" />
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Jam Mulai</label>
                                <input type="time" name="start_time" class="form-control form-control-solid" required />
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Jam Selesai</label>
                                <input type="time" name="end_time" class="form-control form-control-solid" required />
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="required fs-6 fw-semibold mb-2">Project</label>
                            <select name="project_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_overtime" data-placeholder="Pilih Project" required>
                                <option></option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="fs-6 fw-semibold mb-2">Task (Optional)</label>
                            <select name="task_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_overtime" data-placeholder="Pilih Task">
                                <option></option>
                                @foreach($tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="required fs-6 fw-semibold mb-2">Alasan</label>
                            <textarea name="reason" class="form-control form-control-solid" rows="3" required></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select name="status" class="form-select form-select-solid" required>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        
                         <div class="mb-5">
                            <label class="fs-6 fw-semibold mb-2">Admin Notes</label>
                            <textarea name="admin_notes" class="form-control form-control-solid" rows="2"></textarea>
                        </div>

                        <div class="text-center pt-10">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        @if(session('success'))
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { confirmButton: "btn btn-primary" }
            });
        @endif
    });
</script>
@endpush
