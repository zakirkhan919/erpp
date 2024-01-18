@extends('admin.common.master')
@section('title')
    <title>Cash receipt
    </title>
@endsection
@section('css')
@include('vendor.datatable.datatable_css')
@endsection

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <?php $access = config('global.access') ? config('global.access') : [];
 $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false?>
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Cash receipt
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cash receipt
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Cash receipt
                                </h3>

                            </div>

                            <div class="card-body">
                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('add.credit.transection') }}" class="f-right @if(array_search("amount/credit/add",$access) > -1 || $checkAdmin) @else d-none @endif">
                                    <button style="margin-bottom: 15px;"
                                        class="btn btn-primary bg-success-gradient mt-3">Add New Cash receipt
                                    </button>
                                </a>
                                <div class="table-responsive @if(array_search("amount/credit",$access) > -1 || $checkAdmin) @else d-none @endif">
                                    <table id="list" class="table dt-responsive table-bordered table-striped nowrap" id="basic-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No </th>
                                                <th class="wd-15p border-bottom-0">Description </th>
                                                <th class="wd-15p border-bottom-0">Amount of Money </th>
                                                <th class="wd-15p border-bottom-0">Date </th>
                                                {{-- <th class="wd-25p border-bottom-0">অবস্থা </th> --}}
                                                <th class="wd-10 border-bottom-0"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
@include('vendor.sweetalert2.sweetalert2_js')
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
   <script>
       $(function () {
           $('#list').DataTable({
               bAutoWidth: false,
               processing: true,
               serverSide: true,
               iDisplayLength: 10,
               ajax: {
                   url: "/amount/credit/get",
                method: 'post',
                   data: function (d) {
                       d._token = $('input[name="_token"]').val();
                   }
               },
               columns: [
                   {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   {data: 'description', name: 'description'},
                   {data: 'amount', name: 'amount'},
                   {data: 'date', name: 'date'},
                   {data: 'status', name: 'status'},
                   {data: 'action', name: 'action', orderable: false, searchable: false},
               ],

               "aaSorting": []
           });
       });

       function deleteCreditAmount(id,e) {
           e.preventDefault();
           swal.fire({
               title: "Are you sure?",
               text: "Do you want to delete it??!",
               icon: "warning",
               showCloseButton: true,
               // showDenyButton: true,
               showCancelButton: true,
               confirmButtonText: `Delete `,
               cancelButtonText: `Cancel  `,
               // dangerMode: true,
           }).then((result) => {
               if (result.value == true) {
                   swal.fire({
                       title: 'Deleted',
                       text: 'Deleted successfully',
                       icon: 'success'
                   }).then(function () {
                    location.reload();
                       $.ajax({
                           url: "/amount/credit/delete",
                           method: 'POST',
                           data: {id: id, "_token": "{{ csrf_token() }}"},
                           dataType: 'json',
                           success: function () {

                           }
                       })
                   })
               } else if (result.value == false) {
                   swal.fire("Cancel", "Save :)", "error");
               }
           })
       }
    </script>
@endsection
