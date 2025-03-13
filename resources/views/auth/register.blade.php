@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('{{ asset('assets/img/bg-register.webp') }}'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-5"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">! مرحبًا </h1>
                        <p class="text-lead text-white fs-4">استخدم هذه التمارين الرائعة لتحسين مهاراتك في السباحة والاستمتاع
                            بالماء بثقة</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-5">
                            <h5>انشاء حساب</h5>
                        </div>
                        <div class="row px-xl-5 px-sm-4 px-3">

                            <div class="card-body">
                                <form role="form" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text"
                                            class="form-control @error('name')
                                            is-invalid
                                            @enderror"
                                            placeholder="الاسم " aria-label="Name" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="email"
                                            class="form-control @error('email')
                                            is-invalid
                                            @enderror "
                                            placeholder="البريد الالكتروني" aria-label="Email" name="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password"
                                            class="form-control @error('password')
                                            is-invalid
                                            @enderror"
                                            placeholder="كلمه السر" name="password" aria-label="Password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password"
                                            class="form-control form-control-lg  @error('password_confirmation')
                                            is-invalid
                                            @enderror"
                                            name="password_confirmation" placeholder="تاكيد كلمه السر"
                                            aria-label="password_confirmation" value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-check form-check-info text-start">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                            checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            أوافق علي <a href="javascript:;" class="text-dark font-weight-bolder"> جميع
                                                الشروط</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">انشاء
                                            حساب</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">املك حساب ؟ <a href="{{ route('login') }}"
                                            class="text-dark font-weight-bolder">تسجيل الدخول</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
