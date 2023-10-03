@extends('admin.common.master')
@section('title')
    <title>Process Salary</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Process Salary </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ route('salary') }}">All Salaries </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Salary </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Salary Information</h3>
                            </div>
                            <form action="{{ route('submit-salary') }}" method="post" id="salary-form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="month">Month</label>
                                                <select name="month" id="month" class="form-control">
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                                @if ($errors->has('month'))
                                                    <span class="text-danger">{{ $errors->first('month') }}</span>
                                                @endif

                                            </div>
                                            <div class="form-group">

                                                <label for="year">Year</label>
                                                <select name="year" id="year" class="form-control">
                                                    @for ($i = date('Y'); $i >= date('Y') - 50; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @if ($errors->has('year'))
                                                    <span class="text-danger">{{ $errors->first('year') }}</span>
                                                @endif

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


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <!-- Additional scripts and validation -->
    @section('js')
        <script src="{{ asset('assets/admin/validation/jquery.validate.min.js') }}"></script>
        @include('vendor.sweetalert2.sweetalert2_js')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <script>
            if ($("#seller-add").length > 0) {
                $("#seller-add").validate({
                    rules: {

                        month: {
                            required: true,
                        },
                        year: {
                            required: true,
                        },
                    },
                    messages: {

                        month: {
                            required: "Please enter a month",
                        },
                        year: {
                            required: "Please enter a year",
                        },
                    },
                });
            }
        </script>
    @endsection
