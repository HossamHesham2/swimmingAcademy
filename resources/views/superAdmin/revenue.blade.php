@extends('superAdmin.layouts.layout')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
@endpush
@section('content')
    <main class="main-content position-relative border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                        <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-white" href="javascript:;">لوحات
                                القيادة</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page"> الايرادات</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">
                        الايرادات</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">

                    <ul class="navbar-nav me-auto ms-0 justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('logout') }}" class="nav-link text-white font-weight-bold px-0"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out me-sm-1"></i>
                                <span class="d-sm-inline d-none">تسجيل الخروج</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown ps-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4 ">

                <div class="row">
                    <!-- فورم اختيار الشهر والسنة -->
                    <div class="col-md-12">
                        <form method="GET" class="d-flex gap-2">
                            <select name="month" class="form-select-lg w-50">
                                @php
                                    $months = [
                                        1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل', 5 => 'مايو', 6 => 'يونيو',
                                        7 => 'يوليو', 8 => 'أغسطس', 9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر'
                                    ];
                                @endphp
                                @foreach ($months as $num => $name)
                                    <option value="{{ $num }}" {{ request('month', now()->month) == $num ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                                <select name="year" class="form-select-lg w-50">
                                @for ($i = now()->year - 5; $i <= now()->year; $i++)
                                    <option value="{{ $i }}" {{ request('year', now()->year) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>


                            <button type="submit" class="btn btn-primary">عرض الإيرادات</button>
                        </form>
                    </div>

                    <!-- كارد عرض الإيرادات -->
                    <div class="col-md-12">
                        @php
                            $selectedMonth = request('month', now()->month);
                            $selectedYear = request('year', now()->year);

                            $monthlyRevenue = \App\Models\Subscription::whereMonth('created_at', $selectedMonth)
                                            ->whereYear('created_at', $selectedYear)
                                            ->sum('price');
                        @endphp

                        <div class="card text-center shadow-sm mt-2">
                            <div class="card-header bg-primary text-white">
                                الإيرادات لشهر {{ $months[$selectedMonth] }} {{ $selectedYear }}
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-success">
                                    {{ number_format($monthlyRevenue, 2) }} ج.م
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
