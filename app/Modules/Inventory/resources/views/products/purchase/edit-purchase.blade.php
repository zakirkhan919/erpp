@extends('admin.common.master')
@section('title')
    <title>Purchase</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Purchase Edit</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Purchase edit </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Purchase information edit</h3>
                            </div>
                            <form action="{{ route('update-purchase') }}" method="post" id="purchase-edit" name="purchase-edit">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Product Name <span class="text-red">*</span></label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="{{ $data->product_id }}" name="product_id" id="product_id" >
                                                    <option label="{{ $data->product_id }}" value="{{ $data->product_id }}"></option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Purchase Date <span class="text-red">*</span></label>
                                                <input type="date" value="{{ $data->purchase_date }}"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="purchase_date" name="purchase_date" placeholder="{{ $data->purchase_date }}">
                                                @error('purchase_date')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Seller Name <span class="text-red">*</span></label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="{{ $data->seller_id }}" name="seller_id" id="seller_id" >
                                                    <option label="{{ $data->seller_id }}" value="{{ $data->seller_id }}"></option>
                                                    @foreach ($sellers as $seller)
                                                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Purchase Quantity <span class="text-red">*</span></label>
                                                <input type="text" value="{{ $data->quantity }}" class="form-control @error('name') is-invalid @enderror" id="quantity" name="quantity"
                                                    placeholder="Quantity">
                                                    <input type="hidden" value="{{ $data->id }}" class="form-control" name="id">
                                                @error('quantity')
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
            if ($("#purchase-edit").length > 0) {
                $("#purchase-edit").validate({
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
