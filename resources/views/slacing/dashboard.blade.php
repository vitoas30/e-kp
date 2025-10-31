@extends('layouts.user')

@section('content')
<div class="row gy-5 g-xl-8">
	<div class="col-xl-4">
		<!--begin::Mixed Widget 2-->
		<div class="card card-xl-stretch">
			<!--begin::Header-->
			<div class="card-header border-0 bg-danger py-5">
				<h3 class="card-title fw-bold text-white">Employee Statistics</h3>
				<div class="card-toolbar">
					<!--begin::Menu-->
					<button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color- border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
						<i class="ki-duotone ki-category fs-6">
							<span class="path1"></span>
							<span class="path2"></span>
							<span class="path3"></span>
							<span class="path4"></span>
						</i>
					</button>
					<!--begin::Menu 3-->
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
						<!--begin::Heading-->
						<div class="menu-item px-3">
							<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
						</div>
						<!--end::Heading-->
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">Create Invoice</a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="#" class="menu-link flex-stack px-3">Create Payment 
							<span class="ms-2" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
								<i class="ki-duotone ki-information fs-6">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
								</i>
							</span></a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">Generate Bill</a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
							<a href="#" class="menu-link px-3">
								<span class="menu-title">Subscription</span>
								<span class="menu-arrow"></span>
							</a>
							<!--begin::Menu sub-->
							<div class="menu-sub menu-sub-dropdown w-175px py-4">
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3">Plans</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3">Billing</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3">Statements</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<div class="menu-content px-3">
										<!--begin::Switch-->
										<label class="form-check form-switch form-check-custom form-check-solid">
											<!--begin::Input-->
											<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
											<!--end::Input-->
											<!--end::Label-->
											<span class="form-check-label text-muted fs-6">Recuring</span>
											<!--end::Label-->
										</label>
										<!--end::Switch-->
									</div>
								</div>
								<!--end::Menu item-->
							</div>
							<!--end::Menu sub-->
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-3 my-1">
							<a href="#" class="menu-link px-3">Settings</a>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::Menu 3-->
					<!--end::Menu-->
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Body-->
			<div class="card-body p-0">
				<!--begin::Chart-->
				<div class="mixed-widget-2-chart card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 200px"></div>
				<!--end::Chart-->
				<!--begin::Stats-->
				<div class="card-p mt-n20 position-relative">
					<!--begin::Row-->
					<div class="row g-0">
						<!--begin::Col-->
						<div class="col d-flex flex-column bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
							<i class="ki-duotone ki-chart-simple fs-2x text-warning my-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
							</i>
							<a href="#" class="text-warning fw-semibold fs-6">Weekly Sales</a>
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col d-flex flex-column bg-light-primary px-6 py-8 rounded-2 mb-7">
							<i class="ki-duotone ki-briefcase fs-2x text-primary my-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
							<a href="#" class="text-primary fw-semibold fs-6">New Projects</a>
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
					<!--begin::Row-->
					<div class="row g-0">
						<!--begin::Col-->
						<div class="col d-flex flex-column bg-light-danger px-6 py-8 rounded-2 me-7">
							<i class="ki-duotone ki-abstract-26 fs-2x text-danger my-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
							<a href="#" class="text-danger fw-semibold fs-6 mt-2">Item Orders</a>
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col d-flex flex-column bg-light-success px-6 py-8 rounded-2">
							<i class="ki-duotone ki-sms fs-2x text-success my-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
							<a href="#" class="text-success fw-semibold fs-6 mt-2">Bug Reports</a>
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
				</div>
				<!--end::Stats-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Mixed Widget 2-->
	</div>
	<!--end::Col-->
	<!--begin::Col-->
	<div class="col-xl-4">
		<!--begin::List Widget 5-->
		<div class="card card-xl-stretch">
			<!--begin::Header-->
			<div class="card-header align-items-center border-0 mt-4">
				<h3 class="card-title align-items-start flex-column">
					<span class="fw-bold mb-2 text-gray-900">Activities</span>
					<span class="text-muted fw-semibold fs-7">890,344 Sales</span>
				</h3>
				<div class="card-toolbar">
					<!--begin::Menu-->
					<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
						<i class="ki-duotone ki-category fs-6">
							<span class="path1"></span>
							<span class="path2"></span>
							<span class="path3"></span>
							<span class="path4"></span>
						</i>
					</button>
					<!--begin::Menu 1-->
					<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_65a108d06d4e0">
						<!--begin::Header-->
						<div class="px-7 py-5">
							<div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
						</div>
						<!--end::Header-->
						<!--begin::Menu separator-->
						<div class="separator border-gray-200"></div>
						<!--end::Menu separator-->
						<!--begin::Form-->
						<div class="px-7 py-5">
							<!--begin::Input group-->
							<div class="mb-10">
								<!--begin::Label-->
								<label class="form-label fw-semibold">Status:</label>
								<!--end::Label-->
								<!--begin::Input-->
								<div>
									<select class="form-select form-select-solid" multiple="multiple" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select option" data-dropdown-parent="#kt_menu_65a108d06d4e0" data-allow-clear="true">
										<option></option>
										<option value="1">Approved</option>
										<option value="2">Pending</option>
										<option value="2">In Process</option>
										<option value="2">Rejected</option>
									</select>
								</div>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10">
								<!--begin::Label-->
								<label class="form-label fw-semibold">Member Type:</label>
								<!--end::Label-->
								<!--begin::Options-->
								<div class="d-flex">
									<!--begin::Options-->
									<label class="form-check form-check-sm form-check-custom form-check-solid me-5">
										<input class="form-check-input" type="checkbox" value="1" />
										<span class="form-check-label">Author</span>
									</label>
									<!--end::Options-->
									<!--begin::Options-->
									<label class="form-check form-check-sm form-check-custom form-check-solid">
										<input class="form-check-input" type="checkbox" value="2" checked="checked" />
										<span class="form-check-label">Customer</span>
									</label>
									<!--end::Options-->
								</div>
								<!--end::Options-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10">
								<!--begin::Label-->
								<label class="form-label fw-semibold">Notifications:</label>
								<!--end::Label-->
								<!--begin::Switch-->
								<div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
									<label class="form-check-label">Enabled</label>
								</div>
								<!--end::Switch-->
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="d-flex justify-content-end">
								<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
								<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
							</div>
							<!--end::Actions-->
						</div>
						<!--end::Form-->
					</div>
					<!--end::Menu 1-->
					<!--end::Menu-->
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Body-->
			<div class="card-body pt-5">
				<!--begin::Timeline-->
				<div class="timeline-label">
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">08:42</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-warning fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Text-->
						<div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest. And keep structure</div>
						<!--end::Text-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">10:00</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-success fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Content-->
						<div class="timeline-content d-flex">
							<span class="fw-bold text-gray-800 ps-3">AEOL meeting</span>
						</div>
						<!--end::Content-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">14:37</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-danger fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Desc-->
						<div class="timeline-content fw-bold text-gray-800 ps-3">Make deposit 
						<a href="#" class="text-primary">USD 700</a>. to ESL</div>
						<!--end::Desc-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-primary fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Text-->
						<div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
						<!--end::Text-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-danger fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Desc-->
						<div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed 
						<a href="#" class="text-primary">#XF-2356</a>.</div>
						<!--end::Desc-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-primary fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Text-->
						<div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
						<!--end::Text-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-danger fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Desc-->
						<div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed 
						<a href="#" class="text-primary">#XF-2356</a>.</div>
						<!--end::Desc-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="timeline-item">
						<!--begin::Label-->
						<div class="timeline-label fw-bold text-gray-800 fs-6">10:30</div>
						<!--end::Label-->
						<!--begin::Badge-->
						<div class="timeline-badge">
							<i class="fa fa-genderless text-success fs-1"></i>
						</div>
						<!--end::Badge-->
						<!--begin::Text-->
						<div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app launch preparion meeting</div>
						<!--end::Text-->
					</div>
					<!--end::Item-->
				</div>
				<!--end::Timeline-->
			</div>
			<!--end: Card Body-->
		</div>
		<!--end: List Widget 5-->
	</div>
	<!--end::Col-->
	<!--begin::Col-->
	<div class="col-xl-4">
		<!--begin::Mixed Widget 7-->
		<div class="card card-xl-stretch-50 mb-5 mb-xl-8">
			<!--begin::Body-->
			<div class="card-body d-flex flex-column p-0">
				<!--begin::Stats-->
				<div class="flex-grow-1 card-p pb-0">
					<div class="d-flex flex-stack flex-wrap">
						<div class="me-2">
							<a href="#" class="text-gray-900 text-hover-primary fw-bold fs-3">Generate Reports</a>
							<div class="text-muted fs-7 fw-bold">Finance and accounting reports</div>
						</div>
						<div class="fw-bold fs-3 text-primary">$24,500</div>
					</div>
				</div>
				<!--end::Stats-->
				<!--begin::Chart-->
				<div class="mixed-widget-7-chart card-rounded-bottom" data-kt-chart-color="primary" style="height: 150px"></div>
				<!--end::Chart-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Mixed Widget 7-->
		<!--begin::Mixed Widget 10-->
		<div class="card card-xl-stretch-50 mb-5 mb-xl-8">
			<!--begin::Body-->
			<div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
				<!--begin::Hidden-->
				<div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
					<div class="me-2">
						<span class="fw-bold text-gray-800 d-block fs-3">Sales</span>
						<span class="text-gray-500 fw-bold">Oct 8 - Oct 26 24</span>
					</div>
					<div class="fw-bold fs-3 text-primary">$15,300</div>
				</div>
				<!--end::Hidden-->
				<!--begin::Chart-->
				<div class="mixed-widget-10-chart" data-kt-color="primary" style="height: 175px"></div>
				<!--end::Chart-->
			</div>
		</div>
		<!--end::Mixed Widget 10-->
	</div>
	<!--end::Col-->
</div>
@endsection