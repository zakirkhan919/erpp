@extends('admin.common.master')
@section('title')
    <title>Holiday</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Holiday information</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Holiday info </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-end">
                                <a href="{{ route('add_holiday') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-plus me-2"></i>Add
                                        Holiday</button>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="card">
                                        <div class="list-group list-group-transparent mb-0 mail-inbox pb-3">
                                            
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                 January
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                February
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                March
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                April
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                May
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                June
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                July
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                August
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                September
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                October
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                November
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item d-flex align-items-center active mx-4">
                                                December
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="inbox-body">
                                                <div class="table-responsive">
                                                    <h4>Weekend Holiday: <span class="text-danger">Thursday</span> </h4>
                                                    <p>(If you want to update weekend holiday, please add new weekend holiday, previous weekend holiday will be changed)</p> 
                                                    <table class="table table-inbox table-hover text-nowrap mb-0">
                                                        <thead>
                                                            <tr class="">
                                                                <td class="inbox-small-cells">Sl</td>
                                                                <td class="inbox-small-cells">Day</td>
                                                                <td class="view-message dont-show fw-semibold clickable-row">Occasion</td>
                                                                <td class="view-message clickable-row">Description</td>
                                                                <td class="view-message text-end fw-semibold clickable-row">Action</td>
                                                            </tr>
                                                            
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        url: "/get-product",
                        method: 'post',
                        data: function(d) {
                            d._token = $('input[name="_token"]').val();
                        }
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'category',
                            name: 'category'
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

            function deleteProduct(id, e) {
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
                                url: "/delete-product",
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
