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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page"> المتدربين</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">
                        المتدربين</h6>
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
        <div class="container-fluid py-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6> المتدربين</h6>
                        </div>
                        <div class="card-body px-2 pt-0 pb-2">
                            <div class="table-responsive px-2 ">
                                <table class="table align-items-center mb-0 py-2 " id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-end">الاسم</th>
                                            <th class="text-end">المستوى </th>
                                            <th class="text-end">رقم الهاتف </th>
                                            <th class="text-end">اسم المدرب </th>
                                            <th class="text-end">نوع التدريب </th>
                                            <th class="text-end">الموقع </th>
                                            <th class="text-end">السعر </th>
                                            <th class="text-end">تاريخ التسجيل</th>
                                            <th class="text-end">تاريخ اخر التحديث</th>
                                            <th class="text-end">عدد الايام المتبقيه </th>
                                            <th class="text-end">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->level }}</td>
                                                <td>{{ $member->phoneNumber }}</td>
                                                <td>{{ $member->coachName }}</td>
                                                <td>{{ $member->typeOfTrain }}</td>
                                                <td>{{ $member->location }}</td>
                                                <td>{{ optional($member->subscriptions->first())->price ?? 'غير متوفر' }}
                                                </td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($member->created_at)) }}
                                                    <br>
                                                    {{ date('h:m:s', strtotime($member->created_at)) }}
                                                </td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($member->updated_at)) }}
                                                    <br>
                                                    {{ date('h:m:s', strtotime($member->updated_at)) }}
                                                </td>
                                                <td class="text-center">
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

                                                        <span
                                                            class="badge bg-{{ $color }}">{{ $daysRemaining }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">غير مشترك</span>
                                                    @endif
                                                </td>




                                                <td>
                                                    <a href="{{ route('superAdmin.edit', $member->id) }}"
                                                        class="btn btn btn-primary">تعديل</a>
                                                    <a href="{{ route('superAdmin.destroy', $member->id) }}"
                                                        class="btn btn btn-danger">حذف</a>
                                                    <a href="{{ route('superAdmin.show', $member->id) }}"
                                                        class="btn btn btn-success">عرض البيانات</a>
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
        </div>
    </main>
@endsection
@push('js')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js ') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js ') }}"></script>
    <script src="{{ asset('assets/js/dataTables.buttons.min.js ') }}"></script>
    <script src="{{ asset('assets/js/jszip.min.js ') }}"></script>
    <script src="{{ asset('assets/js/buttons.html5.min.js ') }}"></script>
    <script src="{{ asset('assets/js/buttons.print.min.js ') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'نسخ',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'csv',
                        text: 'ملف نصي',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excel',
                        text: 'اكسيل',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'pdf',
                        text: 'بي دي اف',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'print',
                        text: 'طباعة',
                        className: 'btn btn-primary'
                    }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json'
                },
                pageLength: 5,
                lengthMenu: [5, 10, 25],
            });
        });
    </script>
@endpush
