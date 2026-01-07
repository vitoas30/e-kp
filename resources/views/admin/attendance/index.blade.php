@extends('layouts.admin')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3 class="card-label">Daftar Absensi</h3>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_attendance">
                        <i class="ki-duotone ki-plus fs-2"></i> Input Absensi
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">User</th>
                                <th class="min-w-125px">Role</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Check In</th>
                                <th class="min-w-125px">Check Out</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $attendance->user->name }}</a>
                                            <span>{{ $attendance->user->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($attendance->user->roles as $role)
                                            <span class="badge badge-light-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>
                                        <div class="badge badge-light-success fw-bold">{{ $attendance->check_in }}</div>
                                    </td>
                                    <td>
                                        @if($attendance->check_out)
                                            <div class="badge badge-light-warning fw-bold">{{ $attendance->check_out }}</div>
                                        @else
                                            <div class="badge badge-light-secondary fw-bold">-</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="badge badge-light-info fw-bold">{{ $attendance->status }}</div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 m-0"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_attendance_{{ $attendance->id }}">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" class="menu-link px-3 deleteAlert" data-url="{{ route('admin.attendance.destroy', $attendance->id) }}">Delete</a>
                                            </div>
                                        </div>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="kt_modal_edit_attendance_{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="fw-bold">Edit Waktu Absensi</h2>
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                        <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST" class="form">
                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                <label class="fs-6 fw-semibold mb-2">User</label>
                                                                <input type="text" class="form-control form-control-solid" value="{{ $attendance->user->name }}" readonly />
                                                            </div>

                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                <label class="fs-6 fw-semibold mb-2">Tanggal</label>
                                                                <input type="text" class="form-control form-control-solid" value="{{ $attendance->date }}" readonly />
                                                            </div>

                                                            <div class="row mb-7">
                                                                <div class="col-md-6">
                                                                    <label class="fs-6 fw-semibold mb-2">Check In</label>
                                                                    <input type="time" name="check_in" class="form-control form-control-solid" value="{{ $attendance->check_in }}" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="fs-6 fw-semibold mb-2">Check Out</label>
                                                                    <input type="time" name="check_out" class="form-control form-control-solid" value="{{ $attendance->check_out }}" />
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="status" value="{{ $attendance->status }}">

                                                            <div class="text-center pt-15">
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
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-5">
                    {{ $attendances->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Attendance -->
    <div class="modal fade" id="kt_modal_add_attendance" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">Input Absensi Manual</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form action="{{ route('admin.attendance.store') }}" method="POST" class="form">
                        @csrf
                        
                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">User</label>
                            <select name="user_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select User" data-dropdown-parent="#kt_modal_add_attendance" required>
                                <option></option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Tanggal</label>
                            <input type="date" name="date" class="form-control form-control-solid" required value="{{ date('Y-m-d') }}" />
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Check In</label>
                                <input type="time" name="check_in" class="form-control form-control-solid" required />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">Check Out</label>
                                <input type="time" name="check_out" class="form-control form-control-solid" />
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select name="status" class="form-select form-select-solid" required>
                                <option value="present">Present</option>
                                <option value="late">Late</option>
                                <option value="absent">Absent</option>
                                <option value="leave">Leave</option>
                            </select>
                        </div>

                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Notes</label>
                            <textarea name="notes" class="form-control form-control-solid" rows="3"></textarea>
                        </div>

                        <div class="text-center pt-15">
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
        // Delete Handler with AJAX
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
                    // Create a form and submit it
                    const form = $('<form>', {
                        'method': 'POST',
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

        // Success Notification
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

        // Error Notification
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
    });
</script>
@endpush
