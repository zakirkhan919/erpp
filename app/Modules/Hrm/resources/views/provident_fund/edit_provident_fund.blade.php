@extends('admin.common.master')
@section('title')
    <title>Provident fund</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Provident fund Edit</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Provident fund </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Provident fund edit </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Provident fund information edit</h3>
                            </div>
                            <form action="{{ route('update-provident_fund') }}" method="post" id="provident-fund-edit" name="provident-fund-edit">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="employee">Employee <span class="text-red">*</span></label>
                                                <select class="form-control @error('employee') is-invalid @enderror" id="employee" name="employee">
                                                    <option value="">Select an employee</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}" {{ $data->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('employee')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Previous Provident Fund</label>
                                                <input type="text" value="{{ $data->previous_provident_fund }}" class="form-control @error('previous_provident_fund') is-invalid @enderror" id="previous_provident_fund" name="previous_provident_fund" placeholder="Previous Provident Fund">
                                                @error('previous_provident_fund')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        {{-- <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Previous Month</label>
                                                <input type="text" value="{{ $data->previous_month }}" class="form-control @error('previous_month') is-invalid @enderror" id="previous_month" name="previous_month" placeholder="Previous Month">
                                                @error('previous_month')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Provident Fund <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->provident_fund }}" class="form-control @error('provident_fund') is-invalid @enderror" id="provident_fund" name="provident_fund" placeholder="Provident Fund">
                                                @error('provident_fund')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Remarks</label>
                                                <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ $data->remarks }}</textarea>
                                                @error('remarks')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status <span class="text-red">*</span></label>
                                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Deactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="float-left" style="float: left;">
                                        <a href="{{ route('provident_fund') }}" class="btn btn-danger mt-4 mb-2">Cancel</a>
                                    </div>
                                    <div class="float-right" style="float: right;">
                                        <button type="submit" class="btn btn-primary mt-4 mb-2" type="submit">
                                            Submit</button>
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
        if ($("#provident-fund-edit").length > 0) {
            $("#provident-fund-edit").validate({
                rules: {
                    employee: {
                        required: true,
                    },
                    type: {
                        required: true,
                        in: ['Addition', 'Deduction'],
                    },
                    month: {
                        required: true,
                        maxlength: 255,
                    },
                    year: {
                        required: true,
                        maxlength: 255,
                    },
                    amount: {
                        required: true,
                        number: true,
                    },
                    comment: {
                        maxlength: 255,
                    },
                    status: {
                        required: true,
                        in: ['1', '2'],
                    },
                },
                messages: {
                    employee: {
                        required: "Please select an employee",
                    },
                    type: {
                        required: "Please select a type",
                    },
                    month: {
                        required: "Please enter a valid month",
                        maxlength: "Month must not exceed 255 characters",
                    },
                    year: {
                        required: "Please enter a valid year",
                        maxlength: "Year must not exceed 255 characters",
                    },
                    amount: {
                        required: "Please enter a valid amount",
                        number: "Please enter a valid number",
                    },
                    comment: {
                        maxlength: "Comment must not exceed 255 characters",
                    },
                    status: {
                        required: "Please enter a valid year",
                        in: "Please select a valid status",


                    }

                },
            });
        }
    </script>
@endsection
