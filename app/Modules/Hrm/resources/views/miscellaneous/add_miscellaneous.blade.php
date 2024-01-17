@extends('admin.common.master')

@section('title')
    <title>Miscellaneous Add</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Miscellaneous Add</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ route('miscellaneous') }}">Miscellaneous </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Miscellaneous add </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Miscellaneous Information</h3>
                            </div>
                            <form action="{{ route('submit-miscellaneous') }}" method="post" id="miscellaneous-form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
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
                                                @error('employee')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="type">Type <span
                                                        class="text-red">*</span></label>
                                                <select class="form-control @error('type') is-invalid @enderror"
                                                    id="type" name="type">
                                                    <option value="">Select a type</option>
                                                    <option value="Addition">Addition</option>
                                                    <option value="Deduction">Deduction</option>


                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="year">Year <span
                                                        class="text-red">*</span></label>
                                                <select class="form-control @error('year') is-invalid @enderror"
                                                    id="year" name="year">
                                                    <option value="">Select a year</option>
                                                    @foreach ($availableYears as $year)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @error('year')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="month">Month <span
                                                        class="text-red">*</span></label>
                                                <select class="form-control @error('month') is-invalid @enderror"
                                                    id="month" name="month">
                                                    <option value="">Select a month</option>
                                                    @foreach ($months as $monthNumber)
                                                        <option value="{{ $monthNumber }}">
                                                            {{ date('F', mktime(0, 0, 0, $monthNumber, 1)) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('month')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>



                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="comment">Comment</label>
                                                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="5">{{ old('comment') }}</textarea>
                                                @error('comment')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="amount">Amount <span
                                                        class="text-red">*</span></label>
                                                <input type="text" value="{{ old('amount') }}"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    id="amount" name="amount" placeholder="Amount">
                                                @error('amount')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="status">Status <span
                                                        class="text-red">*</span></label>
                                                <select class="form-control @error('status') is-invalid @enderror"
                                                    id="status" name="status">
                                                    <option value="">Select a status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>

                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
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
    </div>


        <!-- Your existing content -->
    @endsection
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
                        employee: {
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
                        }
                    },
                    messages: {
                        name: {
                            required: "Please enter name",
                        },
                        description: {
                            required: "Please enter a shorter description",
                        },
                        employee: {
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
                            number: "Please enter a valid number",
                        },
                        status: {
                            required: "Please select a status",
                        }
                    },
                });
            }
        </script>
    @endsection
