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
                                <div class="table-responsive">
                                    <div id="responsive-datatable_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" id="swapButton" style="display: none;"
                                                    onclick="swapSubmit()"
                                                    class="btn btn-primary mb-2 f-right">Swap</button>
                                                <table
                                                    class="table table-bordered text-nowrap border-bottom dataTable no-footer"
                                                    id="responsive-datatable" role="grid"
                                                    aria-describedby="responsive-datatable_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="wd-15p border-bottom-0 sorting sorting_asc"
                                                                tabindex="0" aria-controls="responsive-datatable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="First name: activate to sort column descending"
                                                                style="width: 83.5729px;">#</th>
                                                            <th class="wd-15p border-bottom-0 sorting sorting_asc"
                                                                tabindex="0" aria-controls="responsive-datatable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="First name: activate to sort column descending"
                                                                style="width: 83.5729px;">Employee name</th>
                                                            <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Last name: activate to sort column ascending"
                                                                style="width: 77.1979px;">Start Time</th>
                                                            <th class="wd-20p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Position: activate to sort column ascending"
                                                                style="width: 159.417px;">Date</th>
                                                            <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Start date: activate to sort column ascending"
                                                                style="width: 80.8438px;">End Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($roasterSwap as $item)
                                                            <tr class="odd">
                                                                <td>
                                                                    <input type="checkbox" name="sortSelect"
                                                                        id="shotrSelect" value="{{ $item->id }}"
                                                                        onclick="roasterChange({{ $item->id }})">
                                                                </td>
                                                                <td class="sorting_1">{{ $item->employee->name }}</td>
                                                                <td>{{ $item->start_time }}</td>
                                                                <td>{{ $item->date }}</td>
                                                                <td>{{ $item->end_time }}</td>
                                                            </tr>
                                                        @endforeach

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
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <script>
                        let roasterId = []

                        function roasterChange(data) {
                            if (roasterId.length < 2) {
                                roasterId.push(data);
                                if (roasterId.length == 2) {
                                    $('#swapButton').show();
                                }
                            } else {
                                alert('There is over of two roaster')
                            }
                        }

                        function swapSubmit() {
                            $.ajax({
                                type:'post',
                                url: "{{ route('swap.submit') }}",
                                headers: {
                                        'X-CSRF-Token': $('input[name="_token"]').val(),
                                },
                                data: {'d': roasterId},
                                success: function(result) {
                                    location.reload();
                                }
                            });
                        }
                    </script>
                @endsection
