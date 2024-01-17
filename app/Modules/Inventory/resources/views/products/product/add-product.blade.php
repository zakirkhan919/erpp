@extends('admin.common.master')
@section('title')
    <title>Product Add</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Product Add</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Product </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product add </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product information Add</h3>
                            </div>
                            <form action="{{ route('submit-product') }}" method="post" id="seller-add"
                                name="seller-add">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Name <span
                                                        class="text-red">*</span></label>
                                                <input type="text" value="{{ old('name') }}"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" placeholder="Name">
                                                @error('name')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Price <span class="text-red">*</span></label>
                                                <input type="text" value="{{ old('price') }}"
                                                    class="form-control @error('name') is-invalid @enderror" id="price"
                                                    name="price" placeholder="Price">
                                                @error('price')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Category <span class="text-red">*</span></label>
                                                <input type="text" value="{{ old('category') }}"
                                                    class="form-control @error('name') is-invalid @enderror" id="category"
                                                    name="category" placeholder="category">
                                                @error('category')
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
