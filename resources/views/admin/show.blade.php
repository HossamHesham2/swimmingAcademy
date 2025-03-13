@extends('admin.layouts.layout')
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page"> عرض السباح</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">
                        عرض السباح</h6>
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
            <div class="card text-center  m-auto">
                <div class="card-body">
                    <h3 class="card-title py-2">اسم السباح : {{ $member->name }}</h3>
                    <p class="card-text mb-4">اسم المدرب: {{ $member->coachName }}</p>
                    <p class="card-text mb-4"> رقم التليفون : {{ $member->phoneNumber }}</p>
                    <p class="card-text mb-4">مكان التدريب : {{ $member->location }}</p>
                    <p class="card-text mb-4">المستوي : {{ $member->level }}</p>
                    <p class="card-text mb-4">تم التسجيل : {{ date('d/m/Y', strtotime($member->created_at)) }}

                    </p>
                    <p class="card-text mb-4"> بدء الاشتراك :

                        {{ date('d/m/Y', strtotime($member->subscriptions->first()->start_date)) }}

                    </p>
                    <p class="card-text mb-4"> انتهاء الاشتراك :  {{ date('d/m/Y', strtotime($member->subscriptions->first()->end_date)) }}</p>
                    <p class="card-text mb-4"> عدد الايام المتبقيه :
                        @if ($member->subscriptions->isNotEmpty())
                            @php
                                $subscription = $member->subscriptions->first(); // أول اشتراك
                                $endDate = \Carbon\Carbon::parse($subscription->end_date);
                                $now = now();
                                $daysRemaining = floor($now->diffInDays($endDate, false)); // تقريب الرقم لأسفل ليكون عدد صحيح

                                // تحديد اللون حسب عدد الأيام المتبقية
                                if ($daysRemaining > 10) {
                                    $color = 'success';
                                } elseif ($daysRemaining > 3) {
                                    $color = 'warning';
                                } elseif ($daysRemaining >= 0) {
                                    $color = 'danger';
                                } else {
                                    $color = 'secondary'; // رمادي إذا كان الاشتراك منتهي
                                    $daysRemaining = 'انتهى الاشتراك';
                                }
                            @endphp

                            <span class="badge bg-{{ $color }}">{{ $daysRemaining }}</span>
                        @else
                            <span class="badge bg-secondary">غير مشترك</span>
                        @endif
                    </p>
                    <a href="{{ route('admin.index') }}" class="btn btn-primary"><i class="fa fa-backward"></i> Go Back</a>
                </div>
            </div>
        </div>
    </main>
@endsection
