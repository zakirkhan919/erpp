@extends('admin.common.master')
@section('title')
    <title>আর্থিক</title>
@endsection
@section('css')
@endsection

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">আর্থিক তথ্য</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">হোম </a></li>
                            <li class="breadcrumb-item active" aria-current="page">আর্থিক তথ্য </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">আর্থিক তালিকা </h3>

                            </div>

                            <div class="card-body">
                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <form method="post" id="submitForm" name="submitForm">
                                    @csrf
                                    <div class='row'>
                                        <div class="col-md-3">
                                            <div class="form-group m-2">
                                                <label for="from_date">তারিখ হইতে</label>
                                                <input type="date" name="from_date" id="from_date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group m-2">
                                                <label for="to_date">তারিখ শেষ</label>
                                                <input type="date" name="to_date" id="to_date"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md--3">
                                            <div class="form-group m-2">
                                                <label for="transection">লেনদেন</label>
                                                <select name="transection" id="transection" class="form-control">
                                                    <option value="1">নগদ গ্রহন</option>
                                                    <option value="2">নগদ খরচ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md--3">
                                            <div class="form-group m-2">
                                                <label for="">#</label>
                                                <button type="submit" id="submit" class="form-control btn btn-primary">সংযক্তি </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id="tableView">

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-2 END -->

                <!-- ROW-3 -->

                <!-- ROW-3 END -->

                <!-- ROW-4 -->


                <!-- ROW-4 END -->
            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content close-->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
   <script>
        if ($("#submitForm").length > 0) {
        $("#submitForm").validate({
                rules: {
                    from_date: {
                        required: true,
                        },
                    to_date: {
                        required: true,
                        },  
                    transection: {
                        required: true,
                    },   
                },
                messages: {
                    from_date: {
                        required: "ফিল্ডটি পুরন করতে হবে!",
                    },
                    to_date: {
                        required: "ফিল্ডটি পুরন করতে হবে!",
                    },   
                    transection: {
                        required: "ফিল্ডটি পুরন করতে হবে!",
                    },
                },
                submitHandler: function(form) {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $('#submit').html('Please Wait...');
                $("#submit"). attr("disabled", true);
                $.ajax({
                url: "{{url('from-submit-financial')}}",
                type: "POST",
                data: $('#submitForm').serialize(),
                success: function( response ) {
                    $('#submit').html('সংযক্তি');
                    $('#tableView').html(response.html);
                    $("#submit"). attr("disabled", false);
                    document.getElementById("contactUsForm").reset(); 
                }
            });
            }
            })
    }
   </script>
@endsection
