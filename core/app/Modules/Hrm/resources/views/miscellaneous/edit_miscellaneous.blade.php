@extends('admin.common.master')
@section('title')
    <title>Miscellaneous</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Miscellaneous Edit</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Miscellaneous </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Miscellaneous edit </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Miscellaneous information edit</h3>
                            </div>
                            <form action="{{ route('update-miscellaneous') }}" method="post" id="miscellaneous-edit" name="miscellaneous-edit">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="employee_id">Employee <span class="text-red">*</span></label>
                                                <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                                                    <option value="">Select an employee</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}" {{ $data->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('employee_id')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Type <span class="text-red">*</span></label>
                                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                                    <option value="Addition" {{ $data->type == 'Addition' ? 'selected' : '' }}>Addition</option>
                                                    <option value="Deduction" {{ $data->type == 'Deduction' ? 'selected' : '' }}>Deduction</option>
                                                </select>
                                                @error('type')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Month <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->month }}" class="form-control @error('month') is-invalid @enderror" id="month" name="month" placeholder="Month">
                                                @error('month')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Year <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->year }}" class="form-control @error('year') is-invalid @enderror" id="year" name="year" placeholder="Year">
                                                @error('year')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Amount <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->amount }}" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="Amount">
                                                @error('amount')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Comment</label>
                                                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ $data->comment }}</textarea>
                                                @error('comment')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                    <button class="btn btn-danger mt-4 mb-2">Cancel</button>
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
        if ($("#miscellaneous-edit").length > 0) {
            $("#miscellaneous-edit").validate({
                rules: {
                    employee: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    month: {
                        required: true,
                        maxlength: 255
                    },
                    year: {
                        required: true,
                        maxlength: 255
                    },
                    amount: {
                        required: true,
                        number: true,
                    },
                    comment: {
                        maxlength: 255
                    },
                    status: {
                        required: true,
                        in: ['1', '2'], // Adjust values as needed
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
                        required: "Please select a status",
                        in: "Please select a valid status",
                    },
                },
            });
        }
    </script>
@endsection



