@extends('admin.common.master')
@section('title')
    <title>Roaster Manage</title>
@endsection
@section('css')
<style>
    .roaster-button a{
        margin-right: 10px;
    }
</style>
@endsection
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Roaster information</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roaster info </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-end roaster-button">
                                <a href="{{ route('add_csv') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-plus me-2"></i>Import Csv
                                        Roaster</button>
                                </a>
                                <a href="{{ route('add_roaster') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-plus me-2"></i>Add
                                        Roaster</button>
                                </a>
                                <a href="{{ route('add_employee') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-file me-2"></i>Sample Format</button>
                                </a>
                                <a href="{{ route('add_employee') }}">
                                    <button class="btn btn-primary text-right"><i class="fa fa-print me-2"></i>Print</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                {{-- <th class="border-bottom-0">Photo</th> --}}
                                                <th class="border-bottom-0">Employee Id</th>
                                                <th class="border-bottom-0">Employee Name</th>
                                                <th class="border-bottom-0">Start Time</th>
                                                <th class="border-bottom-0">Date</th>
                                                <th class="border-bottom-0">End Time</th>
                                                <th class="border-bottom-0">Action</th>
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
            </div>
        </div>
    @endsection

    @section('js')
        @include('vendor.sweetalert2.sweetalert2_js')
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <script>
            var base_url = 'http://127.0.0.1:8000/';
            $(function() {
                $('#list').DataTable({
                    bAutoWidth: false,
                    processing: true,
                    serverSide: true,
                    iDisplayLength: 10,
                    ajax: {
                        url: "/get-roaster",
                        method: 'post',
                        data: function(d) {
                            d._token = $('input[name="_token"]').val();
                        }
                    },
                    columns: [

                        // {
                        //     data: 'photo',
                        //     name: 'photo',
                        //     render: function(data, type, row) {
                        //         return '<img src="' + base_url + data +
                        //             '" alt="Employee Photo" style="max-width: 100px; max-height: 100px;">';
                        //     }


                        // },
                        
                        {
                            data: 'employee_id',
                            name: 'employee_id'
                        },
                        {
                            data: 'employee_name',
                            name: 'employee_name'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'end_time',
                            name: 'end_time'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],

                    "aaSorting": []
                });
            });

            function deleteEmployee(id, e) {
                e.preventDefault();
                swal.fire({
                    title: "Are you sure?",
                    text: "Are you delete this?!",
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
                            text: 'Seccessfully deleted!',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                            $.ajax({
                                url: "/employee-delete",
                                method: 'POST',
                                data: {
                                    id: id,
                                    "_token": "{{ csrf_token() }}"
                                },
                                dataType: 'json',
                                success: function() {

                                }
                            })
                        })
                    } else if (result.value == false) {
                        swal.fire("cencel", "Not deleted :)", "error");
                    }
                })
            }
        </script>
    @endsection
