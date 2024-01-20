@extends('admin.common.master')
@section('title')
    <title>Sell</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Sell Edit</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Sell </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sell edit </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sell information edit</h3>
                            </div>
                            <form action="{{ route('update-sell') }}" method="post" id="sell-edit" name="sell-edit">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Product Name <span class="text-red">*</span></label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="{{ $data->product->name }}" name="product_id" id="product_id" >
                                                    <option label="{{ $data->product->name}}" value="{{ $data->product_id }}"></option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Selling Date <span class="text-red">*</span></label>
                                                <input type="date" value="{{ $data->selling_date }}"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="selling_date" name="selling_date" placeholder="{{ $data->selling_date }}">
                                                @error('selling_date')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Seller Name <span class="text-red">*</span></label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="{{ $data->seller->name }}" name="seller_id" id="seller_id" >
                                                    <option label="{{  $data->seller->name  }}" value="{{ $data->seller_id }}"></option>
                                                    @foreach ($sellers as $seller)
                                                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Customer Name <span class="text-red">*</span></label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="{{ $data->customer->name }}" name="customer_id" id="customer_id" >
                                                    <option label="{{ $data->customer->name }}" value="{{ $data->customer_id }}"></option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Selling Quantity <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->selling_quantity }}" class="form-control @error('name') is-invalid @enderror" id="selling_quantity" name="selling_quantity"
                                                    placeholder="Selling Quantity">
                                                    <input type="hidden" value="{{ $data->id }}" class="form-control" name="id">
                                                @error('selling_quantity')
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
            if ($("#sell-edit").length > 0) {
                $("#sell-edit").validate({
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
