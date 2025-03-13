<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <title>
        Diaa Academy
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    @stack('css')

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0 ') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show rtl  bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-4 rotate-caret"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
                target="_blank">
                <img src="{{ asset('assets/img/logo.png') }}" width="26px" height="26px"
                    class="navbar-brand-img h-100" alt="main_logo">
                <span class="me-1 font-weight-bold">{{ Auth::user()->name }}</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}"
                        href="{{ route('admin.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1"> لوحه التحكم </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.create' ? 'active' : '' }} "
                        href="{{ route('admin.create') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-user-run text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1"> اضافه متدرب جديد</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.create' ? 'active' : '' }} "
                        href="{{ route('admin.return') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-user-run text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1"> المرتجعات</span>
                    </a>
                </li>

        </div>

    </aside>

    @yield('content')

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    @stack('js')
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html>
