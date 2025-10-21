<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title>EKP - Elektronik Kerja Perkantoran</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/e-kp.png') }}" />

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

		<link href="{{ asset('assets2/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets2/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

		<link href="{{ asset('assets2/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets2/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

		<style>
			@keyframes blink {
				0% { opacity: 1; }
				50% { opacity: 0.5; }
				100% { opacity: 1; }
			}
			.menu-link {
				transition: background-color 0.3s ease;
			}
			.menu-link.active {
				background-color: #0d6efd !important; /* Biru bootstrap */
				color: #fff !important;
				border-radius: 8px;
			}

			.menu-link.active .menu-title {
				color: #fff !important;
				font-weight: 600; /* biar lebih tebal */
			}

			.menu-link.active .menu-icon i {
				color: #fff !important;
				animation: none; /* matikan kedip, biar clean seperti contoh */
			}

			.menu-link:hover, .menu-link.active, .menu-link:focus {
				background-color: #007bff;
				color: white;
				border-radius: 8px;
			}
			.menu-link .menu-title {
				transition: color 0.3s ease, transform 0.3s ease;
				display: inline-block;
			}
			.menu-link:hover .menu-title, .menu-link.active .menu-title, .menu-link:focus .menu-title {
				color: white;
				transform: translateX(5px);
			}
			.menu-link .menu-icon i {
				transition: color 0.3s ease;
				color: #007bff; /* Default icon color */
			}
			.menu-link:hover .menu-icon i, .menu-link.active .menu-icon i, .menu-link:focus .menu-icon i {
				color: white !important;
				animation: blink 1s infinite;
			}
		</style>

		<script>
			if (window.top != window.self) {
				window.top.location.replace(window.self.location.href);
			}
		</script>
	</head>
	<body id="kt_app_body"
		data-kt-app-layout="light-sidebar"
		data-kt-app-header-fixed="true"
		data-kt-app-sidebar-enabled="true"
		data-kt-app-sidebar-fixed="true"
		data-kt-app-sidebar-hoverable="true"
		data-kt-app-sidebar-push-header="true"
		data-kt-app-sidebar-push-toolbar="true"
		data-kt-app-sidebar-push-footer="true"
		data-kt-app-toolbar-enabled="true"
		class="app-default">

		<script>
			var defaultThemeMode = "light";
			var themeMode;
			if (document.documentElement) {
				if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
					themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
				} else {
					if (localStorage.getItem("data-bs-theme") !== null) {
						themeMode = localStorage.getItem("data-bs-theme");
					} else {
						themeMode = defaultThemeMode;
					}
				}
				if (themeMode === "system") {
					themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
				}
				document.documentElement.setAttribute("data-bs-theme", themeMode);
			}
		</script>
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				
				@include('layouts.partials.admin-header')

				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					
					@include('layouts.partials.admin-sidebar')

					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<div class="d-flex flex-column flex-column-fluid">
							
							@yield('content')

						</div>
						@include('layouts.partials.admin-footer')
					</div>
				</div>
			</div>
		</div>

		<script>var hostUrl = "{{ asset('assets2') }}/";</script>
		<script src="{{ asset('assets2/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets2/js/scripts.bundle.js') }}"></script>

		<script src="{{ asset('assets2/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>

		<script src="{{ asset('assets2/plugins/custom/datatables/datatables.bundle.js') }}"></script>

		<script src="{{ asset('assets2/js/widgets.bundle.js') }}"></script>
		<script src="{{ asset('assets2/js/custom/widgets.js') }}"></script>
		<script src="{{ asset('assets2/js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('assets2/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
		<script src="{{ asset('assets2/js/custom/utilities/modals/create-app.js') }}"></script>
		<script src="{{ asset('assets2/js/custom/utilities/modals/new-target.js') }}"></script>
		<script src="{{ asset('assets2/js/custom/utilities/modals/users-search.js') }}"></script>

		<script>
			document.addEventListener('DOMContentLoaded', function() {
				if (typeof KTApp !== 'undefined') {
					KTApp.init();
				}
			});
		</script>
		<script>
			$(document).ready(function() {
				// ✅ perbaikan: sebelumnya tertulis $.document.ready (salah)
				
				function formatRupiah(angka) {
					if (!angka) return '';
					var number_string = angka.replace(/[^,\d]/g, ''),
						split = number_string.split(','),
						sisa = split[0].length % 3,
						rupiah = split[0].substr(0, sisa),
						ribuan = split[0].substr(sisa).match(/\d{3}/gi);

					if (ribuan) {
						var separator = sisa ? '.' : '';
						rupiah += separator + ribuan.join('.');
					}

					return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
				}

				function parseRupiah(rupiah) {
					if (!rupiah) return 0;
					return parseInt(rupiah.replace(/\./g, '').replace(/,/g, '')) || 0;
				}

				// Format saat mengetik
				$('#salary_display').on('input', function() {
					let value = $(this).val();
					let formatted = formatRupiah(value);
					$(this).val(formatted);
					$('#salary').val(parseRupiah(formatted));
				});

				// Format ulang saat blur
				$('#salary_display').on('blur', function() {
					let value = $(this).val();
					let formatted = formatRupiah(value);
					$(this).val(formatted);
					$('#salary').val(parseRupiah(formatted));
				});

				// Tangani event paste
				$('#salary_display').on('paste', function() {
					setTimeout(() => {
						let value = $(this).val();
						let formatted = formatRupiah(value);
						$(this).val(formatted);
						$('#salary').val(parseRupiah(formatted));
					}, 10);
				});

				// Cegah karakter non-angka
				$('#salary_display').on('keypress', function(e) {
					const charCode = e.which ? e.which : e.keyCode;
					// Hanya izinkan angka (0–9)
					if (charCode < 48 || charCode > 57) {
						e.preventDefault();
					}
				});
			});
		</script>
		@stack('scripts')
	</body>
</html>
