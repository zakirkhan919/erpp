@extends('admin.common.master')
@section('title')
    <title>Add Payment Fund</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Payment </h1>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Payment Information</h3>
                            </div>
                            <form action="{{ route('submit-payment') }}" method="post" id="payment-form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="employee">Employee <span
                                                        class="text-red">*</span></label>
                                                <select class="form-control @error('employee_id') is-invalid @enderror"
                                                    id="employee" name="employee_id">
                                                    <option value="">Select an employee</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('employee_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
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
