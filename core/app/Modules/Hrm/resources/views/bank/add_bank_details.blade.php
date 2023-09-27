@extends('admin.common.master')
@section('title')
    <title>Add Bank Details</title>
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
                    <h1 class="page-title">Add Bank Details</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Bank Details</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bank Details Add</h3>
                            </div>
                            @if (\Session::has('success1'))
                                            <div class="alert alert-success">
                                                <ul>
                                                    <li>{!! \Session::get('success1') !!}</li>
                                                </ul>
                                            </div>
                                        @endif
                            <form action="{{ route('submit-bank_detail') }}" method="post" id="bank_detail-add">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Employee name <span class="text-danger">*</span></label>
                                                <select name="employee_id" id="" class="form-control">
                                                    <option value="0" disabled>Select Employee</option>
                                                    @foreach ($employees as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Account Name</label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Account Name" name="account_name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Account Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Account Number" name="account_number">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Bank Name <span class="text-danger">*</span></label>
                                                <input type="text" name="bank_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="">Branch <span class="text-danger">*</span></label>
                                                <input type="text" name="branch" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="">IFSC Code <span class="text-danger">*</span></label>
                                                <input type="text" name="ifsc_code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="">Pan Number <span class="text-danger">*</span></label>
                                                <input type="text" name="pan_number" class="form-control">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="float-left" style="float: left;">
                                        <button class="btn btn-danger mt-4 mb-2">Cancel</button>
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
        <script src="{{ asset('assets/admin/validation/jquery.validate.min.js') }}"></script>
        @include('vendor.sweetalert2.sweetalert2_js')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <script>
            if ($("#bank_detail-add").length > 0) {
                $("#bank_detail-add").validate({
                    rules: {

                        employee_id: {
                            required: true,
                        },
                        account_name: {
                            required: true,
                        },
                        account_number: {
                            required: true,
                        },
                        bank_name: {
                            required: true,
                        },
                        branch: {
                            required: true,
                        },
                        ifsc_code: {
                            required: true,
                        },
                        pan_number: {
                            required: true,
                        },
                    },
                    messages: {

                        employee_id: {
                            required: 'Please select employee',
                        },
                        account_name: {
                            required: 'Please enter account name',
                        },
                        account_number: {
                            required: 'Please enter account number',
                        },
                        bank_name: {
                            required: 'Please enter bank name',
                        },
                        branch: {
                            required: 'Please enter branch ',
                        },
                        ifsc_code: {
                            required: 'Please enter ifsc code',
                        },
                        pan_number: {
                            required: 'Please enter pan number',
                        },
                    },
                });
            }
        </script>
    @endsection


