@extends('admin.common.master')
@section('title')
    <title>Add Provident Fund</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Provident Fund</h1>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Provide Fund Information</h3>
                            </div>
                            <form action="{{ route('submit-provident_fund') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="employee">Employee <span
                                                        class="text-red">*</span></label>

                                                <select class="form-control @error('employee') is-invalid @enderror"
                                                    id="employee" name="employee">
                                                    <option value="">Select an employee</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Previous Provident Fund</label>
                                                <input type="text" class="form-control" name="previous_provident_fund">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Previous Month</label>
                                                <input type="text" class="form-control" name="previous_month">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Provident Fund</label>
                                                <input type="text" class="form-control" name="provident_fund">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Remarks</label>
                                                <textarea class="form-control" name="remarks" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="2">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                        name: {
                            required: true,
                            maxlength: 50
                        },
                        description: {
                            required: false,
                            maxlength: 255
                        },
                        employee_id: {
                            required: true,
                        },
                        type: {
                            required: true,
                        },
                        year: {
                            required: true,
                        },
                        month: {
                            required: true,
                        },
                        comment: {
                            maxlength: 255
                        },
                        amount: {
                            required: true,
                            number: true,
                        },
                        status: {
                            required: true,
                        },
                        // Add more rules for other fields
                    },
                    messages: {
                        name: {
                            required: "Please enter name",
                        },
                        description: {
                            required: "Please enter a shorter description",
                        },
                        employee_id: {
                            required: "Please select an employee",
                        },
                        type: {
                            required: "Please select a type",
                        },
                        year: {
                            required: "Please select a year",
                        },
                        month: {
                            required: "Please select a month",
                        },
                        amount: {
                            required: "Please enter an amount",
                            number: "Please enter a number ",
                        },
                        status: {
                            required: "Please select a status",
                        },

                    },
                });
            }
        </script>
    @endsection
