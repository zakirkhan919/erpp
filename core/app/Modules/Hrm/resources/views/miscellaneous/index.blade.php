@extends('admin.common.master')
@section('title')
    <title>Miscellaneous</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Miscellaneous information</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Miscellaneous info </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-end">
                                <a href="{{ route('add_miscellaneous') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-plus me-2"></i>Add
                                        Miscellaneous</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">Employee</th>
                                                <th class="border-bottom-0">Type</th>
                                                <th class="border-bottom-0">Month</th>
                                                <th class="border-bottom-0">Year</th>
                                                <th class="border-bottom-0">Amount</th>
                                                <th class="border-bottom-0">Comment</th>
                                                <th class="border-bottom-0">Status</th>
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
            $(function() {
                $('#list').DataTable({
                    bAutoWidth: false,
                    processing: true,
                    serverSide: true,
                    iDisplayLength: 10,
                    ajax: {
                        url: "/get-miscellaneous",
                        method: 'post',
                        data: function(d) {
                            d._token = $('input[name="_token"]').val();
                        }
                    },
                    columns: [{
                            data: 'employee_id',
                            name: 'employee_id'
                        }, // Replace 'employee_name' with the actual column name for employee
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'month',
                            name: 'month'
                        },
                        {
                            data: 'year',
                            name: 'year'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'comment',
                            name: 'comment'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data) {
                                return data === 1 ? 'Active' : 'Inactive';
                            }
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

            function deleteMiscellaneous(id, e) {
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
                            try {
                                $.ajax({
                                    url: "miscellaneous-delete",
                                    method: 'POST',
                                    data: {
                                        id: id,
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        console.log("AJAX call successful", data);
                                    },
                                    error: function(xhr, status, error) {
                                        if (xhr.status === 500) {
                                            console.error("Internal Server Error:", error);
                                            console.log(xhr.responseText);
                                        } else if (xhr.status === 404) {
                                            console.error("Resource Not Found:", error);
                                            console.log(xhr.responseText);
                                        } else {
                                            console.error("AJAX error:", error);
                                            console.log(xhr.responseText);
                                        }
                                    }
                                });
                            } catch (exception) {
                                console.error("Exception:", exception);
                            }



                        })
                    } else if (result.value == false) {
                        swal.fire("cencel", "Not deleted :)", "error");
                    }
                })
            }
        </script>
    @endsection
