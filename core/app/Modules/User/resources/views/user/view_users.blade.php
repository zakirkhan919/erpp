@extends('admin.common.master')
@section('title')
    <title>Users</title>
@endsection
@section('css')
@endsection

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <?php $access = config('global.access') ? config('global.access') : [];
            $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false?>
            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Users </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users  </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users  </h3>

                            </div>

                            <div class="card-body">
                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('add_user') }}" class="f-right @if(array_search("user/entry",$access) > -1 || $checkAdmin) @else d-none @endif">
                                    <button style="margin-bottom: 15px;"
                                        class="btn btn-primary bg-success-gradient mt-3">New User </button>
                                </a>
                                <div id="tableView">
                                    <table id="list" class="table dt-responsive table-bordered table-striped nowrap">
                                        <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th></th>
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
@include('vendor.datatable.datatable_js')
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
                   url: '{{url("user/get_users")}}',
                   method: 'post',
                   data: function (d) {
                       d._token = $('input[name="_token"]').val();
                   }
               },
               columns: [
                   {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   {data: 'name', name: 'name'},
                   {data: 'email', name: 'email'},
                   {data: 'phone', name: 'phone'},
                   {data: 'type', name: 'type'},
                   {data: 'status', name: 'status'},
                   {data: 'action', name: 'action', orderable: false, searchable: false},
               ],
               "aaSorting": []
           });
       });
       function deleteuser(id,e) {
           e.preventDefault();
           swal.fire({
               title: "Are You Sure?",
               text: "Are You want to delete??!",
               icon: "warning",
               showCloseButton: true,
               // showDenyButton: true,
               showCancelButton: true,
               confirmButtonText: `Delete `,
                cancelButtonText: `Cencel  `,
               // dangerMode: true,
           }).then((result) => {
               if (result.value == true) {
                   swal.fire({
                       title: 'Deleted!',
                       text: 'Successfully Deleted!',
                       icon: 'success'
                   }).then(function () {
                       $.ajax({
                           url: '{{url("user/delete_user")}}',
                           method: 'POST',
                           data: {id: id, "_token": "{{ csrf_token() }}"},
                           dataType: 'json',
                           success: function () {
                               location.reload(true);
                           }
                       })
                   })
               } else if (result.value == false) {
                   swal.fire("Cancelled", "User is safe :)", "error");
               }
           })
       }
   </script>
@endsection
