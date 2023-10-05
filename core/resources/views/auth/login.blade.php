<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Membership Database Management">
    <meta name="author" content="Innovatech Solutions>
    <meta name="keywords" content="">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>NeuronERP - Login</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('assets/admin/css/dark-style.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/admin/css/transparent-style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/admin/css/skin-modes.css') }}" rel="stylesheet" /> --}}

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/admin/colors/color1.css') }}" />

</head>

<body class="app sidebar-mini ltr">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('assets/admin/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="{{ asset('assets/admin/images/brand/erplogo.png') }}" class="header-brand-img"
                            alt="Logo Icon" style="height: 100px; width: 100px;">
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">

                        <span class="login100-form-title pb-5">
                            Login
                        </span>
                        <div class="panel panel-primary">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li class="mx-0"><a href="#tab5" class="active"
                                                data-bs-toggle="tab">Email Login</a></li>
                                        {{-- <li class="mx-0"><a href="#tab6" data-bs-toggle="tab">মোবাইল </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body p-0 pt-5">
                                <div class="tab-content">
                                    <form class="login100-form" method="POST" action="{{ route('admin') }}">
                                        @csrf
                                        <div class="tab-pane active" id="tab5">
                                            <div class="input-group form-control @error('email') is-invalid @enderror">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="email"
                                                    name="email" placeholder="Enter your valid email">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div class="text-end pt-4">

                                            </div>
                                            <div class="wrap-input100 validate-input input-group  form-control @error('password') is-invalid @enderror"
                                                id="Password-toggle">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="password"
                                                    name="password" placeholder="Password ">


                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="text-end pt-4">

                                            </div>
                                            <div class="container-login100-form-btn">
                                                <button type="submit" style="cursor:pointer;" class="login100-form-btn btn-primary">
                                                    Login
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                    {{-- <div class="tab-pane" id="tab6">
                                        <div id="mobile-num" class="wrap-input100 validate-input input-group mb-4">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <span>+৮৮০</span>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0">
                                        </div>
                                        <div id="login-otp" class="justify-content-around mb-5">
                                            <input class="form-control text-center w-15" id="txt1"
                                                maxlength="1">
                                            <input class="form-control text-center w-15" id="txt2"
                                                maxlength="1">
                                            <input class="form-control text-center w-15" id="txt3"
                                                maxlength="1">
                                            <input class="form-control text-center w-15" id="txt4"
                                                maxlength="1">
                                        </div>
                                        <span>দ্রষ্টব্য: OTP তৈরি করতে নিবন্ধিত মোবাইল নম্বর দিয়ে লগইন
                                            করুন।</span>
                                        <div class="container-login100-form-btn ">
                                            <a href="javascript:void(0)" class="login100-form-btn btn-primary"
                                                id="generate-otp">
                                                লগইন
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{ asset('assets/admin/js/show-password.min.js') }}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{ asset('assets/admin/js/generate-otp.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('assets/admin/plugins/p-scroll/perfect-scrollbar.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('assets/admin/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

</body>

</html>
