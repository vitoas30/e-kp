@extends('layouts.user')

@section('content')
<div class="row gy-5 g-xl-8">
	<div class="col-xl-4">
		<div class="card card-xl-stretch mb-xl-8 bg-body">
			<div class="card-body p-0">
				<div class="card-rounded-top position-relative overflow-hidden" 
				     style="height: 200px; background: linear-gradient(135deg, #f43f5e 0%, #dc2626 100%);">
					<div class="position-relative z-index-2 px-9 pt-8">
						<h3 class="fw-bold fs-2x mb-2 text-white">Employee Statistics</h3>
						<span class="text-white text-opacity-75 fw-semibold fs-7">All Time Overview</span>
					</div>
					<div class="position-absolute" style="top: -30px; right: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
					<div class="position-absolute" style="bottom: -50px; left: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
				</div>
				<div class="px-9 mt-n17 position-relative z-index-1">
					<div class="row g-5 mb-5">
						<div class="col-6">
							<div class="bg-body shadow-sm px-6 py-8 rounded-3 h-100 border border-gray-300 border-opacity-50 hover-elevate-up transition-base">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<div class="symbol symbol-circle symbol-50px bg-light-danger">
										<i class="ki-duotone ki-cross-circle fs-2x text-danger">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
									<span class="badge badge-light-danger fs-1 fw-bolder px-4 py-3">{{ $absentCount }}</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-danger fw-bold fs-6 d-block">Absent</a>
								<span class="text-gray-600 fw-semibold fs-7">Total</span>
							</div>
						</div>
						<div class="col-6">
							<div class="bg-body shadow-sm px-6 py-8 rounded-3 h-100 border border-gray-300 border-opacity-50 hover-elevate-up transition-base">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<div class="symbol symbol-circle symbol-50px bg-light-success">
										<i class="ki-duotone ki-check-circle fs-2x text-success">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
									<span class="badge badge-light-success fs-1 fw-bolder px-4 py-3">{{ $presentCount }}</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-success fw-bold fs-6 d-block">Present</a>
								<span class="text-gray-600 fw-semibold fs-7">Total</span>
							</div>
						</div>
					</div>
					<div class="row g-5 mb-5">
						<div class="col-6">
							<div class="bg-body shadow-sm px-6 py-8 rounded-3 h-100 border border-gray-300 border-opacity-50 hover-elevate-up transition-base">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<div class="symbol symbol-circle symbol-50px bg-light-warning">
										<i class="ki-duotone ki-chart-simple fs-2x text-warning">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
											<span class="path4"></span>
										</i>
									</div>
									<span class="badge badge-light-warning fs-1 fw-bolder px-4 py-3">{{ $inProgressTasks }}</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-warning fw-bold fs-6 d-block">On Progress</a>
								<span class="text-gray-600 fw-semibold fs-7">Active Tasks</span>
							</div>
						</div>
						<div class="col-6">
							<div class="bg-body shadow-sm px-6 py-8 rounded-3 h-100 border border-gray-300 border-opacity-50 hover-elevate-up transition-base">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<div class="symbol symbol-circle symbol-50px bg-light-primary">
										<i class="ki-duotone ki-check fs-2x text-primary">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
									<span class="badge badge-light-primary fs-1 fw-bolder px-4 py-3">{{ $completedTasks }}</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-primary fw-bold fs-6 d-block">Completed</a>
								<span class="text-gray-600 fw-semibold fs-7">Completed Task</span>
							</div>
						</div>
					</div>
					<div class="row g-5 mb-9">
						<div class="col-6">
							<div class="bg-body shadow-sm px-6 py-8 rounded-3 h-100 border border-gray-300 border-opacity-50 hover-elevate-up transition-base">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<div class="symbol symbol-circle symbol-50px bg-light-warning">
										<i class="ki-duotone ki-time fs-2x text-warning">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
									<span class="badge badge-light-warning fs-1 fw-bolder px-4 py-3">{{ $totalLateDuration }}</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-warning fw-bold fs-6 d-block">Total Late</a>
								<span class="text-gray-600 fw-semibold fs-7">Total Check-ins</span>
							</div>
						</div>
						<div class="col-6">
							<div class="bg-body shadow-sm px-6 py-8 rounded-3 h-100 border border-gray-300 border-opacity-50 hover-elevate-up transition-base">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<div class="symbol symbol-circle symbol-50px bg-light-info">
										<i class="ki-duotone ki-calendar fs-2x text-info">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
									<span class="badge badge-light-info fs-1 fw-bolder px-4 py-3">{{ $pendingOvertimeCount }}</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-info fw-bold fs-6 d-block">Pending Requests</a>
								<span class="text-gray-600 fw-semibold fs-7">Attendance / Overtime</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-8">
		<div class="card mb-5 mb-xl-8 bg-body">
			<div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: auto;">
				<h3 class="card-title align-items-start flex-column mb-0">
					<span class="card-label fw-bold fs-3 text-white">Absensi Hari Ini</span>
					<span class="text-white text-opacity-75 fw-semibold fs-8 mt-1">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
				</h3>
			</div>
			<div class="card-body py-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

				<div class="row g-3 mb-4">
					<div class="col-md-6">
						<div class="d-flex align-items-center p-3 bg-light-success rounded-2 border border-success border-opacity-25">
							<div class="symbol symbol-35px me-3">
								<div class="symbol-label bg-success bg-opacity-10">
									<i class="ki-duotone ki-entrance-right fs-3 text-success">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
							</div>
							<div class="flex-grow-1">
								<span class="text-gray-700 fw-semibold fs-8 d-block">Check In</span>
<<<<<<< HEAD
                                @if(isset($todayAttendance))
                                    @if(in_array($todayAttendance->status, ['sakit', 'permission', 'wfh', 'leave']))
                                        <span class="text-muted fw-bold fs-3 d-block">-</span>
                                        <span class="badge badge-light-secondary fs-9 fw-semibold px-2 py-1">Tidak Perlu Absen</span>
                                    @else
                                        <span class="text-success fw-bold fs-3 d-block">{{ $todayAttendance->check_in }}</span>
                                        <span class="badge badge-light-success fs-9 fw-semibold px-2 py-1">
                                            Success
                                        </span>
                                    @endif
									@if($todayAttendance->status == 'late')
										@php
											// Match the controller's threshold (currently 00:00:00 for testing)
											$startTime = \Carbon\Carbon::parse('09:00:00');
											$checkIn = \Carbon\Carbon::parse($todayAttendance->check_in);
											$diff = $startTime->diff($checkIn);
											
											$parts = [];
											if ($diff->h > 0) $parts[] = $diff->h . ' Jam';
											if ($diff->i > 0) $parts[] = $diff->i . ' Menit';
											if ($diff->s > 0) $parts[] = $diff->s . ' Detik';
										@endphp
										<span class="text-danger d-block fs-8 mt-1">
											Terlambat {{ implode(' ', $parts) }}
										</span>
									@endif
                                @else
                                    <form action="{{ route('attendance.checkin') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success mt-2">Check In</button>
                                    </form>
                                @endif
=======
								<span class="text-success fw-bold fs-3 d-block">09:58:02</span>
								<span class="badge badge-light-danger fs-9 fw-semibold px-2 py-1">Terlambat 1 jam 28 menit</span>
>>>>>>> 6cc5c70515829a55ce3e5bc35db56011845fa022
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="d-flex align-items-center p-3 bg-light-warning rounded-2 border border-warning border-opacity-25">
							<div class="symbol symbol-35px me-3">
								<div class="symbol-label bg-warning bg-opacity-10">
									<i class="ki-duotone ki-entrance-left fs-3 text-warning">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</div>
							</div>
							<div class="flex-grow-1">
								<span class="text-gray-700 fw-semibold fs-8 d-block">Check Out</span>
<<<<<<< HEAD
                                @if(isset($todayAttendance) && $todayAttendance->check_out)
                                    <span class="text-warning fw-bold fs-3 d-block">{{ $todayAttendance->check_out }}</span>
                                    <span class="badge badge-light-warning fs-9 fw-semibold px-2 py-1">Completed</span>
                                @elseif(isset($todayAttendance) && in_array($todayAttendance->status, ['sakit', 'permission', 'wfh', 'leave']))
                                    <span class="text-muted fw-bold fs-3 d-block">-</span>
                                    <span class="badge badge-light-secondary fs-9 fw-semibold px-2 py-1">Tidak Perlu Absen</span>
                                @elseif(isset($todayAttendance))
                                    <span class="text-warning fw-bold fs-3 d-block">--:--:--</span>
                                    <form action="{{ route('attendance.checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning mt-2">Check Out</button>
                                    </form>
                                @else
                                    <span class="text-warning fw-bold fs-3 d-block">--:--:--</span>
                                    <span class="text-gray-600 fs-9 fw-semibold">Waiting Check In...</span>
                                @endif
=======
								<span class="text-warning fw-bold fs-3 d-block">Belum check out</span>
								<span class="text-gray-600 fs-9 fw-semibold">Waiting...</span>
>>>>>>> 6cc5c70515829a55ce3e5bc35db56011845fa022
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex align-items-center p-3 bg-light-primary rounded-2 border border-primary border-opacity-25">
					<i class="ki-duotone ki-geolocation fs-2x text-primary me-3">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
					<div>
<<<<<<< HEAD
						<span class="text-gray-700 fw-semibold fs-8 d-block">Status Kehadiran</span>
						<span class="text-gray-900 fw-bold fs-6">
                            @if(isset($todayAttendance))
                                {{ ucfirst($todayAttendance->status) }}
                            @else
                                Belum Hadir
                            @endif
                        </span>
					</div>
				</div>
			</div>
			<!-- Permission Button - Only show if no attendance today -->
			@if(!isset($todayAttendance))
			<div class="separator separator-dashed my-4"></div>
			<div class="d-flex justify-content-center">
				<button type="button" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary w-100 fw-bold border-1" data-bs-toggle="modal" data-bs-target="#kt_modal_permission">
					<i class="ki-duotone ki-document fs-2 me-1">
							<span class="path1"></span><span class="path2"></span>
					</i>
					Pengajuan Izin / Sakit / WFH / Cuti (Absen)
				</button>
			</div>
			
			<!-- Permission Modal -->
			<div class="modal fade" id="kt_modal_permission" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered mw-500px">
					<div class="modal-content">
						<div class="modal-header pb-0 border-0 justify-content-end">
							<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
								<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
							</div>
						</div>
						<div class="modal-header mt-n5 pt-0 px-10 pb-2 border-0">
							<h2 class="fw-bold">Form Pengajuan Absen</h2>
						</div>
						<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
							<form action="{{ route('attendance.permission') }}" method="POST" id="form_permission" enctype="multipart/form-data">
								@csrf
								<div class="fv-row mb-7">
									<label class="required fs-6 fw-semibold mb-2">Jenis Pengajuan</label>
									<select name="status" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis" required>
										<option></option>
										<option value="sakit">Sakit</option>
										<option value="permission">Izin Keluarga</option>
										<option value="wfh">WFH (Work From Home)</option>
										<option value="leave">Cuti</option>
									</select>
								</div>
								<div class="fv-row mb-7">
									<label class="required fs-6 fw-semibold mb-2">Keterangan / Alasan</label>
									<textarea class="form-control form-control-solid" rows="4" name="notes" placeholder="Tuliskan alasan lengkap pengajuan..." required></textarea>
								</div>
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Lampiran Bukti (Opsional)</label>
                                    <input type="file" name="file" class="form-control form-control-solid" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" />
                                    <div class="text-muted fs-7 mt-2">Format: Image, PDF, Doc. Max: 2MB</div>
                                </div>
								<div class="text-center">
									<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-primary">
										<span class="indicator-label">Kirim Pengajuan</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endif
=======
						<span class="text-gray-700 fw-semibold fs-8 d-block">Lokasi</span>
						<span class="text-gray-900 fw-bold fs-6">DQ Metro</span>
					</div>
				</div>
			</div>
>>>>>>> 6cc5c70515829a55ce3e5bc35db56011845fa022
		</div>
		@if($projects->isNotEmpty())
			<div class="card mb-xl-8 bg-body">
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold fs-3 mb-1">Project Terbaru Saya</span>
						<span class="text-muted mt-1 fw-semibold fs-7">Leading the latest project</span>
					</h3>
					<div class="card-toolbar">
						<a href="{{ route('user.projects.index') }}" class="btn btn-sm btn-light-primary">
							<i class="ki-duotone ki-eye fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
							Lihat Semua
						</a>
					</div>
				</div>
				<div class="card-body py-3">
					<div class="table-responsive">
						<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
							<thead>
								<tr class="fw-bold text-muted">
									<th class="min-w-150px">Project Name</th>
									<th class="min-w-120px">Assigned By</th>
									<th class="min-w-100px">Priority</th>
									<th class="min-w-100px">Status</th>
<<<<<<< HEAD
									<th class="min-w-100px">Progress</th>
=======
>>>>>>> 6cc5c70515829a55ce3e5bc35db56011845fa022
									<th class="min-w-100px">Due Date</th>
									<th class="min-w-100px text-end">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($projects as $project)
									<tr>
										<td>
											<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6"> {{ $project->name }} </a>
										</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="symbol symbol-circle symbol-35px me-3">
													<span class="symbol-label bg-light-primary text-primary fw-bold">
														{{ strtoupper(substr($project->createdBy?->name, 0, 1)) }}
													</span>
												</div>
												<span class="text-gray-800 fw-bold">{{ $project->createdBy?->name }}</span>
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
												$priorityColor = $priorityColors[$project->priority] ?? 'secondary';
											@endphp
											<span class="badge badge-light-{{ $priorityColor }}">
												{{ ucfirst($project->priority ?? '-') }}
											</span>
										</td>
										<td>
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
										<td>
<<<<<<< HEAD
											@php
												$tasks = $project->tasks;
												$totalTasks = $tasks->count();
												
												if ($totalTasks > 0) {
													$totalScore = 0;
													foreach($tasks as $t) {
														$status = $t->status ?? 'todo';
														if ($status === 'completed' || $status === 'cancelled') {
															$totalScore += 100;
														} elseif ($status === 'review') {
															$totalScore += 75;
														} elseif ($status === 'in_progress') {
															$totalScore += 50;
														} else { // todo
															$totalScore += 25;
														}
													}
													$progress = round($totalScore / $totalTasks);
												} else {
                                                    // If no tasks, fallback to status-based progress
                                                    $status = $project->status ?? 'planning';
                                                    if ($status == 'completed' || $status == 'cancelled') $progress = 100;
                                                    else $progress = 0;
												}

												$color = 'primary';
												if ($progress == 100) $color = 'success';
												elseif ($progress >= 75) $color = 'info';
												elseif ($progress >= 50) $color = 'primary';
                                                elseif ($progress > 0) $color = 'warning';
												else $color = 'secondary';
											@endphp
											<div class="d-flex flex-column w-100 me-2">
												<div class="d-flex flex-stack mb-2">
													<span class="text-muted me-2 fs-7 fw-bold">{{ $progress }}%</span>
												</div>
												<div class="progress h-6px w-100">
													<div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</td>
										<td>
=======
>>>>>>> 6cc5c70515829a55ce3e5bc35db56011845fa022
											<span class="text-gray-900 fw-bold d-block fs-7">{{ $project->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}</span>
											<span class="text-muted fw-semibold d-block fs-8">
												@php
													$dueDate = \Carbon\Carbon::parse($project->due_date);
													$now = \Carbon\Carbon::now();
													
													if ($dueDate->isToday()) {
														echo 'Today';
													} elseif ($dueDate->isTomorrow()) {
														echo 'Tomorrow';
													} elseif ($dueDate->isYesterday()) {
														echo 'Yesterday';
													} elseif ($dueDate->isFuture()) {
														echo $dueDate->diffForHumans();
													} else {
														echo $dueDate->diffForHumans();
													}
												@endphp
											</span>
										</td>
										<td class="text-end">
											<a href="{{ route('user.tasks.index', $project->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-entrance-left fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											{{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
												<i class="ki-duotone ki-pencil fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a> --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@endif
		<div class="card mb-xl-8 bg-body">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bold fs-3 mb-1">Task Terbaru Saya</span>
					<span class="text-muted mt-1 fw-semibold fs-7">Recent assigned tasks</span>
				</h3>
				<div class="card-toolbar">
					<a href="{{ route('user.profile.task') }}" class="btn btn-sm btn-light-primary">
						<i class="ki-duotone ki-eye fs-2">
							<span class="path1"></span>
							<span class="path2"></span>
							<span class="path3"></span>
						</i>
						Lihat Semua
					</a>
				</div>
			</div>
			<div class="card-body py-3">
				<div class="table-responsive">
					<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
						<thead>
							<tr class="fw-bold text-muted">
								<th class="min-w-150px">Task Name</th>
								<th class="min-w-120px">Assigned By</th>
								<th class="min-w-100px">Priority</th>
								<th class="min-w-100px">Status</th>
<<<<<<< HEAD
								<th class="min-w-100px">Progress</th>
=======
>>>>>>> 6cc5c70515829a55ce3e5bc35db56011845fa022
								<th class="min-w-100px">Due Date</th>
								<th class="min-w-100px text-end">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tasks as $task)
								<tr>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6"> {{ $task->name }} </a>
										<span class="text-muted fw-semibold d-block fs-7">{{ $task->project?->name }}</span>
									</td>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-circle symbol-35px me-3">
												<span class="symbol-label bg-light-primary text-primary fw-bold">
													{{ strtoupper(substr($task->project?->manager?->name, 0, 1)) }}
												</span>
											</div>
											<span class="text-gray-800 fw-bold">{{ $task->project?->manager?->name }}</span>
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
										<span class="badge badge-light-{{ $color }} text-nowrap">
											{{ $statusDisplay }}
										</span>
									</td>
									<td>
<<<<<<< HEAD
										@php
											$progress = 0;
											$status = $task->status ?? 'todo';
											$color = 'primary';
											
											if ($status == 'completed' || $status == 'cancelled') {
												$progress = 100;
												$color = $status == 'completed' ? 'success' : 'danger';
											} elseif ($status == 'review') {
												$progress = 75;
												$color = 'info';
											} elseif ($status == 'in_progress') {
												$progress = 50;
												$color = 'primary';
											} else { // todo
												$progress = 25;
												$color = 'warning';
											}
										@endphp
										<div class="d-flex flex-column w-100 me-2">
											<div class="d-flex flex-stack mb-2">
												<span class="text-muted me-2 fs-7 fw-bold">{{ $progress }}%</span>
											</div>
											<div class="progress h-6px w-100">
												<div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
									<td>
                                        <div class="position-relative">
                                            <form action="{{ route('user.tasks.update-status', $task->id) }}" method="POST" class="status-update-form" data-task-id="{{ $task->id }}">
                                                @csrf
                                                <select name="status" class="form-select form-select-solid form-select-sm status-select" onchange="updateTaskStatus(this)">
                                                    <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                                                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>Review</option>
                                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="cancelled" {{ $task->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                                <div class="loading-indicator position-absolute top-50 start-50 translate-middle d-none" id="loading-{{ $task->id }}">
                                                    <div class="spinner-border text-primary w-20px h-20px" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
									</td>
									<td>
=======
>>>>>>> 6cc5c70515829a55ce3e5bc35db56011845fa022
										<span class="text-gray-900 fw-bold d-block fs-7">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}</span>
										<span class="text-muted fw-semibold d-block fs-8">
											@php
												$dueDate = \Carbon\Carbon::parse($task->due_date);
												$now = \Carbon\Carbon::now();
												
												if ($dueDate->isToday()) {
													echo 'Today';
												} elseif ($dueDate->isTomorrow()) {
													echo 'Tomorrow';
												} elseif ($dueDate->isYesterday()) {
													echo 'Yesterday';
												} elseif ($dueDate->isFuture()) {
													echo $dueDate->diffForHumans();
												} else {
													echo $dueDate->diffForHumans();
												}
											@endphp
										</span>
									</td>
									<td class="text-end">
										<a href="{{ route('user.tasks.my-task', $task->project_id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-entrance-left fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										{{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a> --}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('style')
	<style>
		.hover-elevate-up {
			transition: all 0.3s ease;
		}
		.hover-elevate-up:hover {
			transform: translateY(-5px);
			box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.175) !important;
		}
		.transition-base {
			transition: all 0.2s ease-in-out;
		}
	</style>
@endpush