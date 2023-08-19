@extends('admin.common.master')
@section('title')
    <title>Holiday</title>
@endsection
@section('css')
<style>
    .daylabel{
        margin-left: 11px;
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
                    <h1 class="page-title">Add Holiday</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Holiday</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Fixed Holiday Add</h3>
                            </div>
                            <form action="{{ route('submit-product') }}" method="post" id="seller-add"
                                name="seller-add">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">If have weekly fixed holiday</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-9">
                                            <div class="form-group d-flex">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Friday</span>
                                                </label>
                                                <label class="custom-control custom-checkbox daylabel">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Saturday</span>
                                                </label>
                                                <label class="custom-control custom-checkbox daylabel">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Sunday</span>
                                                </label>
                                                <label class="custom-control custom-checkbox daylabel">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Tuesday</span>
                                                </label>
                                                <label class="custom-control custom-checkbox daylabel">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Wednesday</span>
                                                </label>
                                                <label class="custom-control custom-checkbox daylabel">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Thursday</span>
                                                </label>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Occasion Holiday Add</h3>
                            </div>
                            <form action="{{ route('submit-product') }}" method="post" id="seller-add"
                                name="seller-add">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Holidays Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" placeholder="" name="holiday_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Occasion <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Write Occasion" name="occasion">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Write Description(optional)"></textarea>
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
