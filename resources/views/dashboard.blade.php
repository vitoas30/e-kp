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
						<span class="text-white text-opacity-75 fw-semibold fs-7">Monthly Overview</span>
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
									<span class="badge badge-light-danger fs-1 fw-bolder px-4 py-3">8</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-danger fw-bold fs-6 d-block">Absent</a>
								<span class="text-gray-600 fw-semibold fs-7">This Month</span>
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
									<span class="badge badge-light-success fs-1 fw-bolder px-4 py-3">22</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-success fw-bold fs-6 d-block">Present</a>
								<span class="text-gray-600 fw-semibold fs-7">This Month</span>
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
										<i class="ki-duotone ki-clock fs-2x text-warning">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
									<span class="badge badge-light-warning fs-1 fw-bolder px-4 py-3">24h</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-warning fw-bold fs-6 d-block">Overtime</a>
								<span class="text-gray-600 fw-semibold fs-7">This Month</span>
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
									<span class="badge badge-light-info fs-1 fw-bolder px-4 py-3">5</span>
								</div>
								<a href="#" class="text-gray-900 text-hover-info fw-bold fs-6 d-block">Leave Requests</a>
								<span class="text-gray-600 fw-semibold fs-7">Pending</span>
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
					<span class="text-white text-opacity-75 fw-semibold fs-8 mt-1">Tuesday, 28 October 2025</span>
				</h3>
			</div>
			<div class="card-body py-4">
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
								<span class="text-success fw-bold fs-3 d-block">09:58:02</span>
								<span class="badge badge-light-danger fs-9 fw-semibold px-2 py-1">Terlambat 1 jam 28 menit</span>
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
								<span class="text-warning fw-bold fs-3 d-block">Belum check out</span>
								<span class="text-gray-600 fs-9 fw-semibold">Waiting...</span>
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
						<span class="text-gray-700 fw-semibold fs-8 d-block">Lokasi</span>
						<span class="text-gray-900 fw-bold fs-6">DQ Metro</span>
					</div>
				</div>
			</div>
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