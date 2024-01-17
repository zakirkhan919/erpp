@extends('admin.common.master')
@section('title')
    <title>Holiday</title>
@endsection
@section('css')
<style>
    .daylabel{
        margin-left: 11px;
}
</style>
    
@endsection
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Holiday</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Holiday</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Fixed Holiday Add</h3>
                            </div>
                            <form action="{{ route('submit-fixed-holiday') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @if (\Session::has('success'))
                                            <div class="alert alert-success">
                                                <ul>
                                                    <li>{!! \Session::get('success') !!}</li>
                                                </ul>
                                            </div>
                                        @endif
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="confirm" value="confirm" onchange="confirmchecked(this)">
                                                    <span class="custom-control-label">If have weekly fixed holiday</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="daysection" style="display: none;">
                                            <div class="col-sm-4 col-md-9">
                                                <div class="form-group d-flex">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="fixedholidays[]" value="Friday">
                                                        <span class="custom-control-label">Friday</span>
                                                    </label>
                                                    <label class="custom-control custom-checkbox daylabel">
                                                        <input type="checkbox" class="custom-control-input" name="fixedholidays[]" value="Saturday">
                                                        <span class="custom-control-label">Saturday</span>
                                                    </label>
                                                    <label class="custom-control custom-checkbox daylabel">
                                                        <input type="checkbox" class="custom-control-input" name="fixedholidays[]" value="Sunday">
                                                        <span class="custom-control-label">Sunday</span>
                                                    </label>
                                                    <label class="custom-control custom-checkbox daylabel">
                                                        <input type="checkbox" class="custom-control-input" name="fixedholidays[]" value="Monday">
                                                        <span class="custom-control-label">Monday</span>
                                                    </label>
                                                    <label class="custom-control custom-checkbox daylabel">
                                                        <input type="checkbox" class="custom-control-input" name="fixedholidays[]" value="Tuesday">
                                                        <span class="custom-control-label">Tuesday</span>
                                                    </label>
                                                    <label class="custom-control custom-checkbox daylabel">
                                                        <input type="checkbox" class="custom-control-input" name="fixedholidays[]" value="Wednesday">
                                                        <span class="custom-control-label">Wednesday</span>
                                                    </label>
                                                    <label class="custom-control custom-checkbox daylabel">
                                                        <input type="checkbox" class="custom-control-input" name="fixedholidays[]" value="Thursday">
                                                        <span class="custom-control-label">Thursday</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="float-left" style="float: left;">
                                        <button class="btn btn-danger mt-4 mb-2">Cencel</button>
                                    </div>
                                    <div class="float-right" style="float: right;">
                                        <button type="submit" class="btn btn-primary mt-4 mb-2" type="submit">
                                            Submit </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Occasion Holiday Add</h3>
                            </div>
                            @if (\Session::has('success1'))
                                            <div class="alert alert-success">
                                                <ul>
                                                    <li>{!! \Session::get('success1') !!}</li>
                                                </ul>
                                            </div>
                                        @endif
                            <form action="{{ route('submit-occasion-holiday') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Holidays Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" placeholder="" name="date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Occasion <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Write Occasion" name="occasion">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Write Description(optional)"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-left" style="float: left;">
                                        <button class="btn btn-danger mt-4 mb-2">Cencel</button>
                                    </div>
                                    <div class="float-right" style="float: right;">
                                        <button type="submit" class="btn btn-primary mt-4 mb-2" type="submit">
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
        @include('Hrm::holiday.holiday_js')
    @endsection
