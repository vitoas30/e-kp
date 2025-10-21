<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>@yield('title', 'E-KP | Elektronik Kerja Perkantoran')</title>
        <meta name="description" content="Aplikasi manajemen kerja perkantoran berbasis web." />
        <meta name="keywords" content="e-kp, kerja perkantoran, aplikasi kantor, manajemen digital, administrasi online" />

        <link rel="shortcut icon" href="{{ asset('assets/media/logos/e-kp.png') }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" />

        <!-- Frame Busting (Keamanan) -->
        <script>
            if (window.top !== window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>

        <!-- Theme Mode Handler -->
        <script>
            var defaultThemeMode = "light";
            var themeMode = document.documentElement.hasAttribute("data-bs-theme-mode")
                ? document.documentElement.getAttribute("data-bs-theme-mode")
                : localStorage.getItem("data-bs-theme") ?? defaultThemeMode;

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        </script>
    </head>
    <body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">

        <!-- Background Image -->
        <style>
            body {
                background-image: url('{{ asset('assets/media/auth/bg10.jpeg') }}');
            }
            [data-bs-theme="dark"] body {
                background-image: url('{{ asset('assets/media/auth/bg10-dark.jpeg') }}');
            }
        </style>

        <div class="d-flex flex-column flex-root"> 
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-lg-row-fluid position-relative">
                    <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                            src="{{ asset('assets/media/auth/agency.png') }}" alt="Logo" />
                        <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                            src="{{ asset('assets/media/auth/agency-dark.png') }}" alt="Logo Dark" />

                        <h1 class="theme-dark-show text-gray-800 fs-2qx fw-bold text-center mb-7">
                            Selamat Datang di E-KP
                        </h1>
                        <h1 class="theme-light-show text-light fs-2qx fw-bold text-center mb-7">
                            Selamat Datang di E-KP
                        </h1>
                        <div class="theme-light-show text-light fs-base text-center fw-semibold mb-10">
                            Aplikasi manajemen kerja perkantoran digital yang efisien dan produktif.
                        </div>
                        <div class=" theme-dark-show text-gray-800 fs-base text-center fw-semibold mb-10">
                            Aplikasi manajemen kerja perkantoran digital yang efisien dan produktif.
                        </div>

                        <a href="{{ url('/') }}" class="theme-light-show btn btn-outline btn-outline-dashed btn-outline-light fw-semibold">
                            ← Back to Landing Page
                        </a>
                        <a href="{{ url('/') }}" class="theme-dark-show btn btn-outline btn-outline-dashed btn-outline-light-dark fw-semibold">
                            ← Back to Landing Page
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script>var hostUrl = "{{ asset('assets') }}/";</script>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        @stack('scripts')
    </body>
</html>
