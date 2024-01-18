@extends('admin.common.master')
@section('title')
    <title>Cash receipt
    </title>
@endsection
@section('header-resource')
    @livewireStyles
@endsection
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">List of Cash receipt
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cash receipt
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Cash receipt
                                </h3>
                            </div>
                            <div class="card-body">
                                @livewire('finance::transection.earn-form')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-2 END -->

                <!-- ROW-3 -->

                <!-- ROW-3 END -->

                <!-- ROW-4 -->


                <!-- ROW-4 END -->
            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content close-->
@endsection
@section('js')
    @livewireScripts
    @stack('scripts')
@endsection
