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
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/seller')) active @endif" data-bs-toggle="slide" href="{{ route('seller') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Seller</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/product')) active @endif" data-bs-toggle="slide" href="{{ route('product') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Product</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/purchase')) active @endif" data-bs-toggle="slide" href="{{ route('purchase') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Purchase</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/customer')) active @endif" data-bs-toggle="slide" href="{{ route('customer') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Customer</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/sell')) active @endif" data-bs-toggle="slide" href="{{ route('sell') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Sell</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/holiday')) active @endif" data-bs-toggle="slide" href="{{ route('holiday') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Holiday</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/roaster')) active @endif" data-bs-toggle="slide" href="{{ route('roaster') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Roaster</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/')) active @endif" data-bs-toggle="slide" href="#">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Employee</span>
                        <i class="fe fe-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="slide-menu">

                        <li>
                            <a class="slide-item" href="{{ route('department') }}">Department</a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('designation') }}">Designation</a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('employee') }}">Employee</a>
                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item @if(Request::is('/')) active @endif" data-bs-toggle="slide" href="#">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Salary</span>
                        <i class="fe fe-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="slide-menu">

                        <li>
                            <a class="slide-item" href="{{ route('miscellaneous') }}">Miscellaneous</a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('provident_fund') }}">Provident Fund</a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('add_payment') }}">Payment</a>
                        </li>

                        <li>
                            <a class="slide-item" href="">Salary Settings</a>
                        </li>

                        <li>
                            <a class="slide-item" href="">Process Salary</a>
                        </li>


                    </ul>
                </li>

                <li class="slide @if(array_search("user/view_users",$access) > -1 ||
                    array_search("user/add_user",$access) > -1 ||
                    array_search("user/edit_user/*",$access) > -1 ||
                    array_search("user/add_role_permission",$access) > -1 ||
                    array_search("user/edit_role_permission/*",$access) > -1 ||
                    array_search("user/view_role_permissions",$access) > -1 ||

                    $checkAdmin) @else d-none @endif @if(Request::is('user/view_users') || Request::is('user/manage')) is-expended @endif">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Users</span><i class="angle fe fe-chevron-right"></i></a>
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
                        <li class="side-menu-label1"><a href="javascript:void(0)">User Manage</a></li>
                        <li class="@if(array_search("user/manage",$access) > -1 || $checkAdmin == true) @else d-none @endif"><a href="{{ route('view_users') }}" class="slide-item @if(Request::is('user/view_users') || Request::is('user/add_user')) active @endif"> User manage </a></li>
                        <li class="@if(array_search("user/manage",$access) > -1 || $checkAdmin == true) @else d-none @endif"><a href="{{ route('view_role_permissions') }}" class="slide-item @if(Request::is('user/add_role_permission') ||
                            Request::is('user/edit_role_permission/*') ||
                            Request::is('user/view_role_permissions')) active @endif"> Role Permissions </a></li>
                    </ul>
                </li>

                <li class="slide @if(array_search("sales",$access) > -1 ||

                    $checkAdmin) @else d-none @endif @if(Request::is('sales') || Request::is('seller')) is-expended @endif">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-ship"></i><span class="side-menu__label">Sales</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu
                    @if(Request::is('saller') || Request::is('customer')
                    ) open
                    @endif "
                    @if(Request::is('seller') || Request::is('customer')
                    ) style="display: block"
                    @endif>
                        <li class="side-menu-label1"><a href="javascript:void(0)">Sales</a></li>
                        <li class="@if(array_search("seller",$access) > -1 || $checkAdmin == true) @else d-none @endif"><a href="{{ route('seller') }}" class="slide-item @if(Request::is('seller') || Request::is('add-seller')) active @endif"> Seller </a></li>
                        <li class="@if(array_search("customer",$access) > -1 || $checkAdmin == true) @else d-none @endif"><a href="{{ route('customer') }}" class="slide-item @if(Request::is('customer') || Request::is('add-customer')) active @endif"> Customer </a></li>
                        <li class="@if(array_search("sell",$access) > -1 || $checkAdmin == true) @else d-none @endif"><a href="{{ route('sell') }}" class="slide-item @if(Request::is('sell') || Request::is('add-sell')) active @endif"> Sell </a></li>
                    </ul>
                </li>


            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
