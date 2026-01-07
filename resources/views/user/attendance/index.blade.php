@extends('layouts.user')

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Riwayat Absensi</h3>
        </div>
    </div>
    <div class="card-body border-top p-9">
        
        @if(isset($hasFullAccess) && $hasFullAccess)
        <!-- Tabs in Body -->
        <ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
            <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                <a class="nav-link btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-150px h-85px pt-5 pb-2 active" id="kt_tab_my_attendance_link" data-bs-toggle="pill" href="#kt_tab_my_attendance" aria-selected="true" role="tab">
                    <div class="nav-icon mb-3">
                        <i class="ki-duotone ki-user fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Absensi Saya</span>
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                </a>
            </li>
            <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                <a class="nav-link btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-150px h-85px pt-5 pb-2" id="kt_tab_all_attendance_link" data-bs-toggle="pill" href="#kt_tab_all_attendance" aria-selected="false" role="tab">
                    <div class="nav-icon mb-3">
                        <i class="ki-duotone ki-people fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                    </div>
                    <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Semua Absensi</span>
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                </a>
            </li>
        </ul>
        @endif

        <div class="tab-content" id="myTabContent">
            <!-- TAB 1: My Attendance -->
            <div class="tab-pane fade show active" id="kt_tab_my_attendance" role="tabpanel">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_my_attendance">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Check In</th>
                                <th class="min-w-125px">Check Out</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($myAttendances as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                    <td><span class="badge badge-light-success">{{ $attendance->check_in }}</span></td>
                                    <td>
                                        @if($attendance->check_out)
                                            <span class="badge badge-light-warning">{{ $attendance->check_out }}</span>
                                        @else - @endif
                                    </td>
                                    <td>
                                        @php
                                            $color = match($attendance->status) {
                                                'present' => 'success',
                                                'late' => 'warning',
                                                'absent' => 'danger',
                                                'sick' => 'secondary',
                                                'permission' => 'info',
                                                'wfh' => 'primary',
                                                'leave' => 'info',
                                                default => 'primary'
                                            };
                                        @endphp
                                        <span class="badge badge-light-{{ $color }}">{{ ucfirst($attendance->status) }}</span>
                                    </td>
                                    <td>{{ $attendance->notes ?? '-' }}</td>
                                </tr>
                            @endforeach
                            @if($myAttendances->isEmpty())
                                <tr><td colspan="5" class="text-center text-muted">Belum ada data absensi.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>

            @if(isset($hasFullAccess) && $hasFullAccess)
            <!-- TAB 2: All Attendance -->
            <div class="tab-pane fade" id="kt_tab_all_attendance" role="tabpanel">
                <div class="d-flex justify-content-end mb-5">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_attendance_user">
                        <i class="ki-duotone ki-plus fs-2"></i> Input Absensi
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_all_attendance">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">User</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Check In</th>
                                <th class="min-w-125px">Check Out</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">Notes</th>
                                <th class="min-w-125px text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($allAttendances as $attendance)
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">{{ $attendance->user->name }}</span>
                                            <span class="text-muted fs-7">{{ $attendance->user->email }}</span>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                    <td><span class="badge badge-light-success">{{ $attendance->check_in }}</span></td>
                                    <td>
                                        @if($attendance->check_out)
                                            <span class="badge badge-light-warning">{{ $attendance->check_out }}</span>
                                        @else - @endif
                                    </td>
                                    <td>
                                        @php
                                            $color = match($attendance->status) {
                                                'present' => 'success',
                                                'late' => 'warning',
                                                'absent' => 'danger',
                                                'sick' => 'secondary',
                                                'permission' => 'info',
                                                'wfh' => 'primary',
                                                'leave' => 'info',
                                                default => 'primary'
                                            };
                                        @endphp
                                        <span class="badge badge-light-{{ $color }}">{{ ucfirst($attendance->status) }}</span>
                                    </td>
                                    <td>{{ $attendance->notes ?? '-' }}</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 m-0"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_attendance_user_{{ $attendance->id }}">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" class="menu-link px-3 deleteAlert" data-url="{{ route('user.attendance.destroy', $attendance->id) }}">Delete</a>
                                            </div>
                                        </div>
                                        
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="kt_modal_edit_attendance_user_{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="fw-bold">Edit Waktu Absensi</h2>
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7 text-start">
                                                        <form action="{{ route('user.attendance.update', $attendance->id) }}" method="POST" class="form">
                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                <div class="mb-5">
                                                                    <label class="fs-6 fw-semibold mb-2">User</label>
                                                                    <input type="text" class="form-control form-control-solid" value="{{ $attendance->user->name }}" readonly />
                                                                </div>

                                                                <div class="mb-5">
                                                                    <label class="fs-6 fw-semibold mb-2">Tanggal</label>
                                                                    <input type="text" class="form-control form-control-solid" value="{{ $attendance->date }}" readonly />
                                                                </div>
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
                            @if($allAttendances->isEmpty())
                                <tr><td colspan="7" class="text-center text-muted">Belum ada data absensi.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
            @endif
        </div>
    </div>
</div>

@if(isset($hasFullAccess) && $hasFullAccess)
<!-- Modal Add Attendance (User Manager) -->
<div class="modal fade" id="kt_modal_add_attendance_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Input Absensi Manual</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form action="{{ route('user.attendance.storeManual') }}" method="POST" class="form">
                    @csrf
                    
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="required fs-6 fw-semibold mb-2">User</label>
                        <select name="user_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select User" data-dropdown-parent="#kt_modal_add_attendance_user" required>
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
@endif

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables
        if ($('#kt_table_my_attendance').length) {
            $('#kt_table_my_attendance').DataTable({
                responsive: true,
                searching: true,
                info: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                order: [[0, 'desc']],
                language: {
                    emptyTable: "Belum ada data absensi",
                    zeroRecords: "Tidak ada data yang cocok"
                }
            });
        }

        if ($('#kt_table_all_attendance').length) {
            $('#kt_table_all_attendance').DataTable({
                responsive: true,
                searching: true,
                info: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                order: [[1, 'desc']],
                language: {
                    emptyTable: "Belum ada data absensi",
                    zeroRecords: "Tidak ada data yang cocok"
                }
            });
        }

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

        // Initialize Menu
        if (typeof KTMenu !== 'undefined') {
            KTMenu.createInstances();
        }
    });
</script>
@endpush
