@extends('admin.common.master')
@section('title')
    <title>Make Payment</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Make Payment </h1>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12 ">
                        <div class="card d-flex justify-content-center">
                            <div class="card-header">
                                <h3 class="card-title">Payment Information</h3>
                            </div>
                            <form action="{{ route('submit-payment') }}" method="post" id="payment-form">
                                @csrf
                                <div class="card-body">
                                    <div class="row ">
                                        <div class="col-md-3">
                                            <div class="form-group" >
                                              <h4>Employee Name: {{ $employee->name }}</h4>
                                              <h4>Department: {{ $employee->department_id }}</h4>
                                              <h4>Designation: {{ $employee->designation_id }}</h4>
                                              <h4>Net pay: {{ $salary->net_pay }}</h4>
                                             
                                              @if(!$bank_detail)
                                              <h4 style="color: blue">Bank account Available</h4>
                                              @else
                                              <h4 style="color: red">Bank account Not Available</h4>
                                              @endif



                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="payment_type">Payment Type <span
                                                    class="text-red">*</span></label>
                                            <select class="form-control @error('payment_type') is-invalid @enderror"
                                                id="payment_type" name="payment_type">
                                                <option value="">Select Type</option>
                                                <option value="cash">Cash</option>
                                                <option value="bank">Bank</option>


                                            </select>
                                            @error('payment_type')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror


                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="amount">Amount <span
                                                    class="text-red">*</span></label>
                                                <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror">

                                            @error('amount')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror


                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="remarks">remarks <span
                                                    class="text-red">*</span></label>
                                                <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror"></textarea>

                                            @error('remarks')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror


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

                        employee_id: {
                            required: true,
                        },

                    },
                    messages: {

                        employee_id: {
                            required: "Please select an employee",
                        },


                    },
                });
            }
        </script>
    @endsection
