@extends('admin.common.master')
@section('title')
    <title>Add Roaster Csv</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Roaster Csv</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Roaster Csv</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Roaster Add Csv</h3>
                            </div>
                            @if (\Session::has('success1'))
                                            <div class="alert alert-success">
                                                <ul>
                                                    <li>{!! \Session::get('success1') !!}</li>
                                                </ul>
                                            </div>
                                        @endif
                            <form action="{{ route('submit_csv') }}" method="post" id="frmCheckout" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Csv file <span class="text-danger">*</span></label>
                                                <input type="file" name="csv_file" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="float-left" style="float: left;">
                                        <button class="btn btn-danger mt-4 mb-2">Cencel</button>
                                    </div>
                                    <div class="float-right" style="float: right;">
                                        <button onclick="roastersubmit()" type="submit" class="btn btn-primary mt-4 mb-2">
                                            Submit </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        @include('Hrm::roaster.roaster_js')
    @endsection
