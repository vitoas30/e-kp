@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
				<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
					<li class="breadcrumb-item text-muted">
						<a href="index.html" class="text-muted text-hover-primary">Home</a>
					</li>
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-500 w-5px h-2px"></span>
					</li>
					<li class="breadcrumb-item text-muted">Dashboards</li>
				</ul>
			</div>
		</div>
	</div>
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<div id="kt_app_content_container" class="app-container container-fluid">
			<div class="row g-5 g-xl-8">
				<!-- Total Users Card -->
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-xl-8 bg-primary hover-elevate-up">
						<div class="card-body d-flex align-items-center">
							<div class="d-flex align-items-center flex-column flex-grow-1">
								<div class="text-white fw-bold fs-2 mb-1">{{ $totalUsers }}</div>
								<span class="text-white fw-semibold">Total Users</span>
							</div>
							<i class="ki-duotone ki-users fs-3x text-white">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
							</i>
						</div>
					</div>
				</div>

				<!-- Total Projects Card -->
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-xl-8 bg-success hover-elevate-up">
						<div class="card-body d-flex align-items-center">
							<div class="d-flex align-items-center flex-column flex-grow-1">
								<div class="text-white fw-bold fs-2 mb-1">{{ $totalProjects }}</div>
								<span class="text-white fw-semibold">Total Projects</span>
							</div>
							<i class="ki-duotone ki-folder fs-3x text-white">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
					</div>
				</div>

				<!-- Active Projects Card -->
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-xl-8 bg-info hover-elevate-up">
						<div class="card-body d-flex align-items-center">
							<div class="d-flex align-items-center flex-column flex-grow-1">
								<div class="text-white fw-bold fs-2 mb-1">{{ $activeProjects }}</div>
								<span class="text-white fw-semibold">Active Projects</span>
							</div>
							<i class="ki-duotone ki-rocket fs-3x text-white">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
					</div>
				</div>

				<!-- Total Tasks Card -->
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-xl-8 bg-dark hover-elevate-up">
						<div class="card-body d-flex align-items-center">
							<div class="d-flex align-items-center flex-column flex-grow-1">
								<div class="text-white fw-bold fs-2 mb-1">{{ $totalTasks }}</div>
								<span class="text-white fw-semibold">Total Tasks</span>
							</div>
							<i class="ki-duotone ki-checklist fs-3x text-white">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
								<span class="path5"></span>
								<span class="path6"></span>
								<span class="path7"></span>
							</i>
						</div>
					</div>
				</div>
			</div>

			<div class="row g-5 g-xl-8">
				<!-- Task Status Overview -->
				<div class="col-xl-6">
					<div class="card card-xl-stretch mb-xl-8 shadow-sm">
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-dark">Task Status Overview</span>
								<span class="text-muted mt-1 fw-semibold fs-7">Current task distribution</span>
							</h3>
						</div>
						<div class="card-body pt-5">
							<!-- Item -->
							<div class="d-flex align-items-center mb-7">
								<div class="symbol symbol-50px me-5">
									<span class="symbol-label bg-light-success">
										<i class="ki-duotone ki-check fs-2x text-success">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</span>
								</div>
								<div class="d-flex flex-column">
									<a href="#" class="text-dark text-hover-primary fs-6 fw-bold">Completed Tasks</a>
									<span class="text-muted fw-semibold">Finished work</span>
								</div>
								<div class="d-flex flex-column ms-auto text-end">
									<span class="text-dark fw-bold fs-4">{{ $completedTasks }}</span>
									<span class="text-muted fs-7">Tasks</span>
								</div>
							</div>
							<!-- End Item -->
							
							<!-- Separator -->
							<div class="separator separator-dashed my-4"></div>
							
							<!-- Item -->
							<div class="d-flex align-items-center mt-7">
								<div class="symbol symbol-50px me-5">
									<span class="symbol-label bg-light-warning">
										<i class="ki-duotone ki-watch fs-2x text-warning">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</span>
								</div>
								<div class="d-flex flex-column">
									<a href="#" class="text-dark text-hover-primary fs-6 fw-bold">Active Tasks</a>
									<span class="text-muted fw-semibold">Active completion</span>
								</div>
								<div class="d-flex flex-column ms-auto text-end">
									<span class="text-dark fw-bold fs-4">{{ $activeTasks }}</span>
									<span class="text-muted fs-7">Tasks</span>
								</div>
							</div>
							<!-- End Item -->
						</div>
					</div>
				</div>

				<!-- Recent Activity Placeholder -->
				<div class="col-xl-6">
					<div class="card card-xl-stretch mb-xl-8 shadow-sm">
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-dark">Recent Activity</span>
								<span class="text-muted mt-1 fw-semibold fs-7">Latest system updates</span>
							</h3>
						</div>
						<div class="card-body pt-0">
                            <!-- Timeline -->
                            <div class="timeline-label">
                                @foreach($recentActivities as $activity)
                                    @if(class_basename($activity) === 'Project')
                                    <!-- Project Item -->
                                    <div class="timeline-item">
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">{{ $activity->created_at->format('H:i') }}</div>
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-primary fs-1"></i>
                                        </div>
                                        <div class="fw-semibold text-gray-700 ps-3 fs-7">
                                            New Project created: <a href="#" class="text-primary opacity-75-hover fw-bold">{{ $activity->name }}</a>
                                            <br/>
                                            <span class="text-muted fs-8">Manager: {{ $activity->manager->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    @else
                                    <!-- Task Item -->
                                    <div class="timeline-item">
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">{{ $activity->created_at->format('H:i') }}</div>
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-warning fs-1"></i>
                                        </div>
                                        <div class="fw-semibold text-gray-700 ps-3 fs-7">
                                            New Task assigned: <a href="#" class="text-primary opacity-75-hover fw-bold">{{ $activity->name }}</a>
                                            <br/>
                                            <span class="text-muted fs-8">To: {{ $activity->assignee->name ?? 'Unassigned' }}</span>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                
                                @if($recentActivities->isEmpty())
                                <div class="text-center py-10">
                                    <p class="text-muted fs-6">No recent activity found.</p>
                                </div>
                                @endif
                            </div>
                            <!-- End Timeline -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
