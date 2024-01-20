@extends('admin.common.master')
@section('title')
    <title>Edit Credit Cost</title>
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
                    <h1 class="page-title">Edit Credit Cost</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Credit Cost</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Credit Cost </h3>
                            </div>
                            <div class="card-body">
                                <livewire:finance::transection.spend-form-edit :id="$id" />
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
