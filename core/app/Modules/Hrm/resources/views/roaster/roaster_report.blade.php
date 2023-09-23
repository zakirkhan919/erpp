@extends('admin.common.master')
@section('title')
    <title>Roaster Manage</title>
@endsection
@section('css')
    <style>
        .roaster-button a {
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
                            <div class="card-body">
                                <form id="SubmitSearch">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label for="">Employee name <span
                                                        class="text-danger">*</span></label>
                                                <select name="employee_id" id="" class="form-control">
                                                    <option value="all">All</option>
                                                    @foreach ($employes as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label for="">From Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="from_date" value=""
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label for="">To Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="to_date" value=""
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <label for="" style="text-align: center;">Action</label>
                                                <button class="form-control btn btn-primary" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row p-3">
                                    <div class="table-responsive">
                                        <div id="responsive-datatable_wrapper"
                                            class="dataTables_wrapper dt-bootstrap5 no-footer">
    
                                            <div class="row">
    
                                                <div class="col-sm-12">
                                                    <div id="tableSearch">
                                                        @include('Hrm::roaster.report_table')
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
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <script type="text/javascript">
                        $('#SubmitSearch').on('submit', function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: "{{ route('report_search') }}",
                                type: "POST",
                                data: $(SubmitSearch).serialize(),
                                success: function(response) {
                                    console.log(response);
                                    $('#tableSearch').html(response);
                                },
                                error: function(response) {
                                    
                                },
                            });
                        });
                    </script>
                @endsection
