<!--APP-SIDEBAR-->
<?php $access = config('global.access') ? config('global.access') : [];
$checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
?>
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('home') }}">
                <img src="{{ asset('assets/admin/images/brand/erplogo.png') }}" class="header-brand-img desktop-logo"
                    alt="logo">
                <img src="{{ asset('assets/admin/images/brand/erplogo.png') }}" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="{{ asset('assets/admin/images/brand/erplogo.png') }}" class="header-brand-img light-logo"
                    alt="logo">
                <img src="{{ asset('assets/admin/images/brand/erplogo.png') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <!--                            <li class="sub-category">-->
                <!--                                <h3>Main</h3>-->
                <!--                            </li>-->
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/')) active @endif" data-bs-toggle="slide" href="{{ route('home') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">ড্যাশবোর্ড</span></a>
                </li>
                <li class="slide @if(array_search("user/view_users",$access) > -1 ||
                    array_search("user/add_user",$access) > -1 ||
                    array_search("user/edit_user/*",$access) > -1 ||
                    array_search("user/add_role_permission",$access) > -1 ||
                    array_search("user/edit_role_permission/*",$access) > -1 ||
                    array_search("user/view_role_permissions",$access) > -1 ||

                    $checkAdmin) @else d-none @endif @if(Request::is('user/view_users') || Request::is('user/manage')) is-expended @endif">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">ব্যবহারকারী</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu
                    @if(Request::is('user/view_users') ||
                    Request::is('user/add_user') ||
                    Request::is('user/edit_user/*') ||
                    Request::is('user/add_role_permission') ||
                    Request::is('user/edit_role_permission/*') ||
                    Request::is('user/view_role_permissions')
                    ) open
                    @endif "
                    @if(Request::is('user/view_users') ||
                    Request::is('user/add_user') ||
                    Request::is('user/edit_user/*') ||
                    Request::is('user/add_role_permission') ||
                    Request::is('user/edit_role_permission/*') ||
                    Request::is('user/view_role_permissions')
                    ) style="display: block"
                    @endif>
                        <li class="side-menu-label1"><a href="javascript:void(0)">ব্যবহারকারী ম্যানেজ</a></li>
                        <li class="@if(array_search("user/manage",$access) > -1 || $checkAdmin == true) @else d-none @endif"><a href="{{ route('view_users') }}" class="slide-item @if(Request::is('user/view_users') || Request::is('user/add_user')) active @endif"> ব্যবহারকারী ম্যানেজ </a></li>
                        <li class="@if(array_search("user/manage",$access) > -1 || $checkAdmin == true) @else d-none @endif"><a href="{{ route('view_role_permissions') }}" class="slide-item @if(Request::is('user/add_role_permission') ||
                            Request::is('user/edit_role_permission/*') ||
                            Request::is('user/view_role_permissions')) active @endif"> অনুমতি পরিচালনা </a></li>
                    </ul>
                </li>

                <li class="slide @if(array_search("amount/credit",$access) > -1 ||
                    array_search("amount/credit/add",$access) > -1 ||
                    array_search("amount/credit/delete",$access) > -1 ||
                    array_search("amount/credit/edit/*",$access) > -1 ||

                    $checkAdmin) @else d-none @endif">
                    <a class="side-menu__item @if(Request::is('amount/credit')) active @endif" data-bs-toggle="slide" href="{{ route('credit.transection') }}"><i
                            class="side-menu__icon fe fe-zap"></i><span class="side-menu__label">নগদ গ্রহণ </span></a>
                </li>

                <li class="slide @if(array_search("amount/spend",$access) > -1 ||
                    array_search("amount/spend/add",$access) > -1 ||
                    array_search("amount/spend/delete",$access) > -1 ||
                    array_search("amount/spend/edit/*",$access) > -1 ||

                    $checkAdmin) @else d-none @endif">
                    <a class="side-menu__item @if(Request::is('amount/spend')) active @endif" data-bs-toggle="slide" href="{{ route('spend.transection') }}"><i
                            class="side-menu__icon fe fe-zap"></i><span class="side-menu__label">নগদ খরচ </span></a>
                </li>

                <li class="slide @if(array_search("financial",$access) > -1 ||
                    array_search("member/report",$access) > -1 ||
                    $checkAdmin) @else d-none @endif">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-file"></i><span class="side-menu__label">রিপোর্ট</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu @if(Request::is('financial') ||
                    Request::is('member/report')
                    ) open
                    @endif"
                    @if(Request::is('financial') ||
                    Request::is('member/report')
                    ) style="display: block"
                    @endif>
                        <li class="side-menu-label1"><a href="javascript:void(0)">রিপোর্ট</a></li>
                        <li><a href="{{ route('financial') }}" class="slide-item @if(Request::is('financial')) active @endif"> আর্থিক</a></li>
                        {{-- <li><a href="{{ route('member.report') }}" class="slide-item @if(Request::is('member/report')) active @endif"> সদস্য </a></li> --}}
                    </ul>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
