@extends('admin.common.master')
@section('title')
    <title>Department</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Department Edit</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Department </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Department edit </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Department information edit</h3>
                            </div>
                            <form action="{{ route('update-department')}}" method="post" id="seller-edit" name="seller-edit">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Name <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    placeholder="Name">
                                                @error('name')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Description <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->description }}" class="form-control @error('name') is-invalid @enderror" id="description" name="description"
                                                    placeholder="Description">
                                                @error('description')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
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
    @endsection
    @section('js')
    <script src="{{ asset('assets/admin/validation/jquery.validate.min.js') }}"></script>
    @include('vendor.sweetalert2.sweetalert2_js')
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <script>
            if ($("#seller-add").length > 0) {
                $("#seller-add").validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 50
                        },
                        email: {
                            required: true,
                        },
                        phone: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                    },
                    messages: {
                        name: {
                            required: "Please enter name",
                        },
                        email: {
                            required: "Please enter valid email",
                        },
                        phone: {
                            required: "Please enter phone number",
                        },
                        address: {
                            required: "Please enter address",
                        },
                    },
                })
            }


        </script>
    @endsection
