<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Membership Database Management">
    <meta name="author" content="Membership Database Management">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    @yield('title')

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/admin/colors/color1.css') }}" />
    <style>
        span.badge.badge-success {
            background: #6c5ffc;
            color: white;
        }
        span.badge.badge-danger {
            background: #e82646;;
            color: white;
        }

        .modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
    padding-right: 0px !important;
    z-index: 999999999999999999999999999999999999999;
}
    </style>
    @yield('header-resource')
    @yield('css')
</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('assets/admin/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            @include('admin.common.topbar')
            @include('admin.common.side_menu')
            @yield('content')
        </div>
        <!-- Main Sidebar Container -->

        <!-- /.content-wrapper -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copy right 2023 nueron </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SPARKLINE JS-->
    <script src="{{ asset('assets/admin/js/jquery.sparkline.min.js') }}"></script>

    <!-- Sticky js -->
    <script src="{{ asset('assets/admin/js/sticky.js') }}"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{ asset('assets/admin/js/circle-progress.min.js') }}"></script>

    <!-- PIETY CHART JS-->
    <script src="{{ asset('assets/admin/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/peitychart/peitychart.init.js') }}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{ asset('assets/admin/plugins/sidebar/sidebar.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('assets/admin/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/p-scroll/pscroll.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/p-scroll/pscroll-1.js') }}"></script>

    <!-- INTERNAL CHARTJS CHART JS-->
    <script src="{{ asset('assets/admin/plugins/chart/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/chart/rounded-barchart.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL Data tables js-->
    <script src="{{ asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatable/dataTables.responsive.min.js') }}"></script>

    <!-- INTERNAL APEXCHART JS -->
    <script src="{{ asset('assets/admin/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/apexchart/irregular-data-series.js') }}"></script>

    <!-- C3 CHART JS -->
    <script src="{{ asset('assets/admin/plugins/charts-c3/d3.v5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/charts-c3/c3-chart.js') }}"></script>

    <!-- CHART-DONUT JS -->
    <script src="{{ asset('assets/admin/js/charts.js') }}"></script>

    <!-- INTERNAL Flot JS -->
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/chart.flot.sampledata.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/dashboard.sampledata.js') }}"></script>

    <!-- INTERNAL Vector js -->
    <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{ asset('assets/admin/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- INTERNAL INDEX JS -->
    <script src="{{ asset('assets/admin/js/index1.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('assets/admin/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    @yield('js')
</body>

</html>
