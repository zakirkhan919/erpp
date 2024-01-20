@extends('admin.common.master')
@section('title')
    <title>Sell Add</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Sell Add</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Sell </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sell add </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sell information Add</h3>
                            </div>
                            <form action="{{ route('submit-sell') }}" method="post" id="sell-add" name="sell-add">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"> Seller Name</label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="Choose one" name="seller_id" id="seller_id">
                                                    <option label="Choose one"></option>
                                                    @foreach ($sellers as $seller)
                                                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"> Customer Name</label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="Choose one" name="customer_id" id="customer_id">
                                                    <option label="Choose one"></option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"> Product Name</label>
                                                <select class="form-control select2-show-search form-select"
                                                    data-placeholder="Choose one" name="product_id" id="product_id">
                                                    <option label="Choose one"></option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Selling Date <span class="text-red">*</span></label>
                                                <input type="date" value="{{ old('selling_date')}}" class="form-control @error('selling_date') is-invalid @enderror" id="selling_date" name="selling_date"
                                                    placeholder="Selling Date">
                                                @error('selling_date')
                                                    <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Selling Quantity <span class="text-red">*</span></label>
                                                <input type="number" value="{{ old('selling_quantity')}}" class="form-control @error('selling_quantity') is-invalid @enderror" id="selling_quantity" name="selling_quantity"
                                                    placeholder="Selling Quantity">
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
        <!-- SELECT2 JS -->
        <script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/select2.js') }}"></script>
        <script src="{{ asset('assets/admin/validation/jquery.validate.min.js') }}"></script>
        @include('vendor.sweetalert2.sweetalert2_js')
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <script>
            if ($("#sell-add").length > 0) {
                $("#sell-add").validate({
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
