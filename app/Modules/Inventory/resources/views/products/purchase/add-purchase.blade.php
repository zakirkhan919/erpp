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
                <h1 class="page-title">Purchase Add</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Product </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Purchase add </li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Purchase information Add</h3>
                        </div>
                        <form action="{{ route('submit-purchase') }}" method="post" id="seller-add" name="seller-add">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"> Product Name</label>
                                            <select class="form-control select2-show-search form-select"
                                                data-placeholder="Choose one" name="product_id" id="product_id">
                                                <option label="Choose one"></option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"> Purchase Date <span
                                                    class="text-red">*</span></label>
                                            <input type="date" value="{{ old('purchase_date') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="purchase_date" name="purchase_date" placeholder="purchase_date">
                                            @error('purchase_date')
                                            <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>





                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Seller Name</label>
                                            <select class="form-control select2-show-search form-select"
                                                data-placeholder="Choose one" name="seller_id" id="seller_id">
                                                <option label="Choose one"></option>
                                                @foreach ($sellers as $seller)
                                                <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"> Purchase Quantity <span
                                                    class="text-red">*</span></label>
                                            <input type="text" value="{{ old('quantity') }}"
                                                class="form-control @error('name') is-invalid @enderror" id="quantity"
                                                name="quantity" placeholder="quantity">
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
