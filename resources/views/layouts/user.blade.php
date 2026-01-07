<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EKP - Elektronik Kerja Perkantoran</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/e-kp.png') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		
		<!-- Perbaiki semua path assets -->
		<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		@stack('styles')
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<script>
			(function() {
				const defaultTheme = "light";
				let theme = defaultTheme;
				
				if (document.documentElement) {
					// Priority: data attribute > localStorage > default
					theme = document.documentElement.getAttribute("data-bs-theme-mode") 
							|| localStorage.getItem("data-bs-theme") 
							|| defaultTheme;
					
					// Handle system preference
					if (theme === "system") {
						theme = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
					}
					
					// Apply theme
					document.documentElement.setAttribute("data-bs-theme", theme);
				}
			})();
		</script>
		
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    @include('layouts.partials.user-header')
                    @include('layouts.partials.user-toolbar')
                    
                    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                        <div class="content flex-row-fluid" id="kt_content">
                            @yield('content')
                        </div>
                    </div>
					@include('layouts.partials.user-footer')
				</div>
			</div>
		</div>
		
		<!-- Perbaiki semua path JS -->
		<script>var hostUrl = "{{ asset('assets/') }}/";</script>
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
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
		<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
		<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
		<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
		<script src="{{ asset('assets/js/custom/utilities/modals/create-campaign.js') }}"></script>
		<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
        <script>
			document.addEventListener('DOMContentLoaded', function() {
				if (typeof KTApp !== 'undefined') {
					KTApp.init();
				}
			});
		</script>
		@stack('scripts')
	</body>
</html>